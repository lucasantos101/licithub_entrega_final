<?php

namespace App\Listeners;

use Laravel\Cashier\Events\WebhookReceived;
use App\Models\Subscription;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class StripeWebhookListener
{
    public function handleWebhook(WebhookReceived $event)
    {
        Log::info('Webhook recebido: ' . $event->payload['type']);
        
        if ($event->payload['type'] === 'customer.subscription.created' ||
            $event->payload['type'] === 'customer.subscription.updated') {
            
            $this->handleSubscriptionUpdate($event->payload['data']['object']);
        }
        
        if ($event->payload['type'] === 'invoice.payment_succeeded') {
            $this->handlePaymentSuccess($event->payload['data']['object']);
        }
    }
    
    protected function handleSubscriptionUpdate($stripeSubscription)
    {
        // Encontre o usuário pelo stripe_id
        $user = User::where('stripe_id', $stripeSubscription['customer'])->first();
        
        if (!$user) {
            Log::error('Usuário não encontrado para Stripe ID: ' . $stripeSubscription['customer']);
            return;
        }
        
        // Encontre o plano pelo stripe_price_id
        $plan = Plan::where('stripe_price_id', $stripeSubscription['items']['data'][0]['price']['id'])->first();
        
        if (!$plan) {
            Log::error('Plano não encontrado para Stripe Price ID: ' . $stripeSubscription['items']['data'][0]['price']['id']);
            return;
        }
        
        // Atualize ou crie a assinatura no seu banco de dados
        Subscription::updateOrCreate(
            ['user_id' => $user->id, 'gateway_id' => $stripeSubscription['id']],
            [
                'plan_id' => $plan->id,
                'status' => $this->mapStripeStatus($stripeSubscription['status']),
                'trial_ends_at' => isset($stripeSubscription['trial_end']) ? 
                    date('Y-m-d H:i:s', $stripeSubscription['trial_end']) : null,
                'starts_at' => date('Y-m-d H:i:s', $stripeSubscription['start_date']),
                'ends_at' => isset($stripeSubscription['cancel_at']) ? 
                    date('Y-m-d H:i:s', $stripeSubscription['cancel_at']) : null,
                'canceled_at' => isset($stripeSubscription['canceled_at']) ? 
                    date('Y-m-d H:i:s', $stripeSubscription['canceled_at']) : null,
                'gateway' => 'stripe',
            ]
        );
        
        Log::info('Assinatura atualizada/criada com sucesso: ' . $stripeSubscription['id']);
    }
    
    protected function handlePaymentSuccess($invoice)
    {
        // Encontre o usuário pelo stripe_id
        $user = User::where('stripe_id', $invoice['customer'])->first();
        
        if (!$user) {
            Log::error('Usuário não encontrado para Stripe ID: ' . $invoice['customer']);
            return;
        }
        
        // Encontre a assinatura pelo stripe_id
        $subscription = Subscription::where('gateway_id', $invoice['subscription'])->first();
        
        if (!$subscription && isset($invoice['subscription'])) {
            Log::error('Assinatura não encontrada para Stripe ID: ' . $invoice['subscription']);
            return;
        }
        
        // Registre o pagamento
        Payment::create([
            'user_id' => $user->id,
            'subscription_id' => $subscription ? $subscription->id : null,
            'amount' => $invoice['amount_paid'] / 100, // Stripe armazena em centavos
            'currency' => $invoice['currency'],
            'gateway' => 'stripe',
            'gateway_id' => $invoice['id'],
            'status' => 'paid',
            'paid_at' => date('Y-m-d H:i:s', $invoice['created']),
            'metadata' => json_encode([
                'invoice_pdf' => $invoice['invoice_pdf'] ?? null,
                'hosted_invoice_url' => $invoice['hosted_invoice_url'] ?? null,
            ]),
        ]);
        
        Log::info('Pagamento registrado com sucesso: ' . $invoice['id']);
    }
    
    protected function mapStripeStatus($stripeStatus)
    {
        $statusMap = [
            'active' => 'active',
            'past_due' => 'active', // Você pode tratar isso como quiser
            'canceled' => 'canceled',
            'unpaid' => 'expired',
            'trialing' => 'trial',
        ];
        
        return $statusMap[$stripeStatus] ?? 'active';
    }
}
