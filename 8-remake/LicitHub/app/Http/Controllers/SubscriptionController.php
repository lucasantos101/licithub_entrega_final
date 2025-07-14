<?php

namespace App\Http\Controllers;

use Laravel\Cashier\Cashier;
use Illuminate\Http\Request;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    public function index()
    {
        $plans = Plan::where('is_active', true)->get();
        return view('subscriptions.index', compact('plans'));
    }

    public function checkout($planId)
    {
        $plan = Plan::findOrFail($planId);
        $user = Auth::user();

        // Configuração do Stripe
        Stripe::setApiKey(config('services.stripe.secret'));

        // Verifica se o usuário já tem um customer ID no Stripe
        if (!$user->stripe_id) {
            // Cria um novo customer no Stripe se não existir
         $user->createAsStripeCustomer(); // já salva internamente
        }

        // Cria a sessão de checkout
        $session = Session::create([
            'customer' => $user->stripe_id,
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price' => $plan->stripe_price_id, // Usa o price_id do Stripe
                'quantity' => 1,
            ]],
            'mode' => 'subscription', // Modo subscription para pagamentos recorrentes
            'success_url' => route('subscriptions.success', [], true).'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('subscriptions.cancel', [], true),
            'metadata' => [
                'plan_id' => $plan->id,
                'user_id' => $user->id
            ],
        ]);

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        try {
            // Verifica se temos o session_id
            if (!$request->has('session_id')) {
                throw new \Exception('ID da sessão não encontrado');
            }

            $sessionId = $request->get('session_id');
            Stripe::setApiKey(config('services.stripe.secret'));

            // Recupera a sessão do Stripe
            $session = Session::retrieve($sessionId);

            // Verifica se a sessão foi paga
            if ($session->payment_status !== 'paid') {
                throw new \Exception('Pagamento não foi concluído');
            }

            // Recupera a assinatura do Stripe
            $subscription = \Stripe\Subscription::retrieve($session->subscription);

            // Atualiza o usuário com os dados do Stripe
            $user = Auth::user();
            $user->stripe_id = $session->customer;
            $user->save();

            // Cria ou atualiza a assinatura no banco de dados
            DB::table('cashier_subscriptions')->updateOrInsert(
                ['stripe_id' => $subscription->id],
                [
                    'user_id' => $user->id,
                    'name' => 'default',
                    'stripe_status' => $subscription->status,
                    'stripe_price' => $subscription->items->data[0]->price->id,
                    'quantity' => 1,
                    'trial_ends_at' => $subscription->trial_end ? Carbon::createFromTimestamp($subscription->trial_end) : null,
                    'ends_at' => $subscription->cancel_at ? Carbon::createFromTimestamp($subscription->cancel_at) : null,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );

            // Registra o pagamento
            if ($subscription->latest_invoice) {
                $invoice = \Stripe\Invoice::retrieve($subscription->latest_invoice);
                
                if ($invoice && $invoice->status === 'paid') {
                    DB::table('payments')->insert([
                        'user_id' => $user->id,
                        'subscription_id' => DB::table('cashier_subscriptions')
                            ->where('stripe_id', $subscription->id)
                            ->value('id'),
                        'amount' => $invoice->amount_paid / 100,
                        'currency' => $invoice->currency,
                        'gateway' => 'stripe',
                        'gateway_id' => $invoice->id,
                        'status' => 'paid',
                        'paid_at' => Carbon::createFromTimestamp($invoice->created),
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }

            Log::info('Assinatura criada com sucesso', [
                'user_id' => $user->id,
                'subscription_id' => $subscription->id
            ]);

            return redirect()->route('receipt.generate', [
                'subscription' => DB::table('cashier_subscriptions')
                    ->where('stripe_id', $subscription->id)
                    ->value('id')
            ]);

        } catch (\Exception $e) {
            Log::error('Erro ao processar assinatura: ' . $e->getMessage());
            return redirect()->route('subscriptions.index')
                ->with('error', 'Erro ao processar sua assinatura: ' . $e->getMessage());
        }
    }

    public function cancel(Request $request): RedirectResponse
    {
        return redirect()->route('subscriptions.index')
            ->with('info', 'Você cancelou o processo de assinatura.');
    }
}