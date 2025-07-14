<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientDashboardController extends Controller
{
    public function cancel(Request $request)
    {
        $user = $request->user();
        
        // Busca a assinatura ativa corretamente
        $subscription = $user->cashier_subscriptions()
            ->where('stripe_status', 'active')
            ->where(function($query) {
                $query->whereNull('ends_at')
                      ->orWhere('ends_at', '>', now());
            })
            ->first();
        
        if (!$subscription) {
            return back()->withErrors(['error' => 'Nenhuma assinatura ativa encontrada para cancelar.']);
        }
        
        try {
            // Cancela imediatamente a assinatura
            $subscription->cancelNow();
            
            // Redireciona para a página pública com mensagem de sucesso
            return redirect('/')->with('success', 'Assinatura cancelada com sucesso!');
            
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Erro ao cancelar assinatura: ' . $e->getMessage()]);
        }
    }
}