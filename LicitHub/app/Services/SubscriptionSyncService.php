<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Payment;
use Laravel\Cashier\Subscription as CashierSubscription;
use Illuminate\Support\Str;

class SubscriptionSyncService
{
    /**
     * Sincroniza uma assinatura do Cashier com o sistema personalizado
     */
    public function syncSubscriptionData(CashierSubscription $cashierSubscription)
    {
        // Encontre ou crie um plano correspondente
        $plan = Plan::firstOrCreate(
            ['stripe_price_id' => $cashierSubscription->stripe_price],
            [
                'name' => 'Plano ' . $cashierSubscription->stripe_price,
                'slug' => Str::slug('plano-' . $cashierSubscription->stripe_price),
                'price' => 0, // Você precisará obter o preço do Stripe
                'interval' => 'monthly', // Você precisará determinar isso
                'is_active' => true,
                'trial_days' => 0
            ]
        );

        // Atualize ou crie a assinatura personalizada
        $subscription = Subscription::updateOrCreate(
            ['user_id' => $cashierSubscription->user_id, 'gateway_id' => $cashierSubscription->stripe_id],
            [
                'plan_id' => $plan->id,
                'status' => $this->mapStripeStatus($cashierSubscription->stripe_status),
                'trial_ends_at' => $cashierSubscription->trial_ends_at,
                'starts_at' => $cashierSubscription->created_at,
                'ends_at' => $cashierSubscription->ends_at ?? now()->addMonth(),
                'canceled_at' => $cashierSubscription->ends_at ? now() : null,
                'gateway' => 'stripe',
            ]
        );

        return $subscription;
    }

    /**
     * Mapeia status do Stripe para status do sistema
     */
    private function mapStripeStatus($stripeStatus)
    {
        $statusMap = [
            'active' => 'active',
            'past_due' => 'active',
            'canceled' => 'canceled',
            'unpaid' => 'expired',
            'trialing' => 'trial',
        ];

        return $statusMap[$stripeStatus] ?? 'active';
    }
}
