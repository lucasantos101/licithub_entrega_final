<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use App\Models\Subscription;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. Estatísticas de Usuários
        $userStats = [
            'total' => User::count(),
            'new_this_month' => User::whereMonth('created_at', Carbon::now()->month)
                                ->whereYear('created_at', Carbon::now()->year)
                                ->count(),
            'admins' => User::where('user_type', 'admin')->count(),
            'customers' => User::where('user_type', 'customer')->count()
        ];

        // 2. Estatísticas de Assinaturas
        $subscriptionStats = [
            'active' => Subscription::where('status', 'active')->count(),
            'trials' => Subscription::where('status', 'trial')->count(),
            'canceled' => Subscription::where('status', 'canceled')->count(),
            'total_revenue' => Subscription::with('plan')
                                    ->where('status', 'active')
                                    ->get()
                                    ->sum(function($sub) {
                                        return $sub->plan->price;
                                    })
        ];

        // 3. Distribuição de Planos
        $planDistribution = Plan::withCount(['subscriptions' => function($query) {
                                $query->where('status', 'active');
                            }])
                            ->get()
                            ->map(function($plan) {
                                return [
                                    'name' => $plan->name,
                                    'subscribers' => $plan->subscriptions_count
                                ];
                            });

        // 4. Receita Mensal
        $monthlyRevenue = Subscription::with('plan')
                                ->selectRaw('
                                    plans.name as plan_name,
                                    SUM(plans.price) as revenue,
                                    DATE_FORMAT(subscriptions.starts_at, "%Y-%m") as month
                                ')
                                ->join('plans', 'subscriptions.plan_id', '=', 'plans.id')
                                ->where('status', 'active')
                                ->groupBy('plans.name', 'month')
                                ->orderBy('month')
                                ->get();

        // 5. Atividade Recente (Mensagens)
        $recentActivity = ChatMessage::with(['sender', 'receiver'])
                                ->latest()
                                ->take(5)
                                ->get();

        // 6. Taxa de Conversão
        $conversionStats = [
            'trials' => Subscription::where('status', 'trial')->count(),
            'converted' => Subscription::where('status', 'active')
                                    ->whereNotNull('trial_ends_at')
                                    ->where('trial_ends_at', '<', Carbon::now())
                                    ->count(),
            'rate' => Subscription::where('status', 'trial')->count() > 0 ?
                        round((Subscription::where('status', 'active')
                                        ->whereNotNull('trial_ends_at')
                                        ->where('trial_ends_at', '<', Carbon::now())
                                        ->count() / 
                              Subscription::where('status', 'trial')->count() * 100), 2) : 0
        ];  

        return view('admin.dashboard', compact(
            'userStats',
            'subscriptionStats',
            'planDistribution',
            'monthlyRevenue',
            'recentActivity',
            'conversionStats'
        ));
    }
}