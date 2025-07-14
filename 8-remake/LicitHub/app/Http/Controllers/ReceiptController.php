<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Plan;
use App\Models\CashierSubscription;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReceiptController extends Controller
{
    public function show($subscriptionId)
    {
        $user = Auth::user();
        $subscription = $user->cashierSubscriptions()->findOrFail($subscriptionId);
        $plan = Plan::where('stripe_price_id', $subscription->stripe_price)->first();
        
        // Obter histórico de pagamentos
        $payments = $this->getPaymentHistory($subscription);
        
        return view('client.receipt', compact('user', 'subscription', 'plan', 'payments'));
    }

    public function download($subscriptionId)
    {
        $user = Auth::user();
        $subscription = $user->cashierSubscriptions()->findOrFail($subscriptionId);
        $plan = Plan::where('stripe_price_id', $subscription->stripe_price)->first();
        $payments = $this->getPaymentHistory($subscription);
        
        $pdf = PDF::loadView('client.receipt', compact('user', 'subscription', 'plan', 'payments'));
        
        return $pdf->download("recibo-assinatura-{$subscription->id}.pdf");
    }

    private function getPaymentHistory($subscription)
    {
        return \App\Models\Payment::where('subscription_id', $subscription->id)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
    }

    private function getNextBillingDate($subscription)
    {
        if ($subscription->stripe_status === 'active') {
            try {
                \Stripe\Stripe::setApiKey(config('cashier.secret'));
                $stripeSubscription = \Stripe\Subscription::retrieve($subscription->stripe_id);
                if (isset($stripeSubscription->current_period_end)) {
                    return Carbon::createFromTimestamp($stripeSubscription->current_period_end);
                }
            } catch (\Exception $e) {
                return $subscription->created_at->addMonth();
            }
        }
        return null;
    }
}