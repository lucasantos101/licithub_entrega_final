<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Plan;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;


class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Configuração do Stripe
        Stripe::setApiKey(config('services.stripe.secret'));
        $endpointSecret = config('services.stripe.webhook_secret');

        // Validação do evento
        try {
            $event = Webhook::constructEvent(
                $request->getContent(),
                $request->header('Stripe-Signature'),
                $endpointSecret
            );
        } catch (SignatureVerificationException $e) {
            Log::error('Webhook Stripe inválido: ' . $e->getMessage());
            return response()->json(['error' => 'Assinatura inválida'], 403);
        }

        Log::info('Evento Stripe recebido: ' . $event->type);

        // Processamento dos eventos
        switch ($event->type) {
            case 'checkout.session.completed':
                $this->handleCheckoutSessionCompleted($event->data->object);
                break;

            case 'payment_intent.succeeded':
                $this->handlePaymentIntentSucceeded($event->data->object);
                break;

            default:
                Log::info('Evento não tratado: ' . $event->type);
        }

        return response()->json(['status' => 'success']);
    }

    protected function handleCheckoutSessionCompleted($session)
    {
        $email = $session->customer_email ?? null;
        $subscriptionId = $session->subscription ?? null;

        if (!$email || !$subscriptionId) {
            Log::error('Dados faltando no checkout.session.completed');
            return;
        }

        $user = User::where('email', $email)->first();
        if (!$user) {
            Log::error('Usuário não encontrado para email: ' . $email);
            return;
        }

        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
        $stripeSub = $stripe->subscriptions->retrieve($subscriptionId, ['expand' => ['latest_invoice']]);

        $priceId = $stripeSub->items->data[0]->price->id;
        $plan = Plan::where('stripe_price_id', $priceId)->first();

        if (!$plan) {
            Log::error('Plano não encontrado para price_id: ' . $priceId);
            return;
        }

        DB::transaction(function () use ($user, $plan, $stripeSub, $subscriptionId) {
            $subscription = $user->subscriptions()->create([
                'plan_id' => $plan->id,
                'status' => 'active',
                'starts_at' => now(),
                'ends_at' => now()->addMonth(),
                'gateway' => 'stripe',
                'gateway_id' => $subscriptionId,
            ]);

            $invoice = $stripeSub->latest_invoice;

            $user->payments()->create([
                'subscription_id' => $subscription->id,
                'amount' => $invoice ? ($invoice->amount_paid / 100) : 0,
                'currency' => 'BRL',
                'gateway' => 'stripe',
                'gateway_id' => $invoice ? $invoice->id : null,
                'status' => 'paid',
                'paid_at' => now(),
                'metadata' => json_encode($stripeSub),
            ]);
        });
    }

    protected function handlePaymentIntentSucceeded($paymentIntent)
    {
        $userId = $paymentIntent->metadata->user_id ?? null;
        $planId = $paymentIntent->metadata->plan_id ?? null;

        if (!$userId || !$planId) {
            Log::error('Metadata faltando no payment_intent.succeeded');
            return;
        }

        $user = User::find($userId);
        $plan = Plan::find($planId);

        if (!$user || !$plan) {
            Log::error('Usuário ou Plano não encontrado');
            return;
        }

        DB::transaction(function () use ($paymentIntent, $user, $plan) {
            $subscription = $user->subscriptions()->create([
                'plan_id' => $plan->id,
                'status' => 'active',
                'starts_at' => now(),
                'ends_at' => now()->addMonth(),
                'gateway' => 'stripe',
                'gateway_id' => $paymentIntent->id,
            ]);

            $user->payments()->create([
                'subscription_id' => $subscription->id,
                'amount' => $paymentIntent->amount / 100,
                'currency' => $paymentIntent->currency,
                'gateway' => 'stripe',
                'gateway_id' => $paymentIntent->id,
                'status' => 'paid',
                'paid_at' => now(),
                'metadata' => json_encode($paymentIntent),
            ]);
        });
    }
}