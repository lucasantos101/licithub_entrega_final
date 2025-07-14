<?php

namespace App\Listeners;

use Laravel\Cashier\Events\WebhookReceived;
use App\Services\SubscriptionSyncService;

class StripeEventListener
{
    protected $syncService;

    public function __construct(SubscriptionSyncService $syncService)
    {
        $this->syncService = $syncService;
    }

    public function handle(WebhookReceived $event)
    {
        if ($event->payload['type'] === 'customer.subscription.created' ||
            $event->payload['type'] === 'customer.subscription.updated') {
            
            // Obtenha o ID da assinatura do Stripe
            $stripeId = $event->payload['data']['object']['id'];
            
            // Encontre a assinatura do Cashier
            $cashierSubscription = \Laravel\Cashier\Subscription::where('stripe_id', $stripeId)->first();
            
            if ($cashierSubscription) {
                // Sincronize com suas tabelas personalizadas
                $this->syncService->syncSubscriptionData($cashierSubscription);
            }
        }
    }
}
