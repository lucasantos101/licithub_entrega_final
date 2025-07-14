<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard do Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .subscription-info {
            padding: 10px;
        }
        .subscription-details {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
        }
        .card-header {
            font-weight: 600;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #f8f9fa;
            padding: 20px 0;
        }
        .nav-link {
            color: #495057;
            padding: 10px 15px;
            margin: 5px 0;
            border-radius: 5px;
        }
        .nav-link:hover, .nav-link.active {
            background-color: #e9ecef;
            color: #0d6efd;
        }
        .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    @php
        $user = auth()->user();
        if (!($user->user_type === 'customer' && $user->hasActiveCashierSubscription())) {
            header('Location: ' . url('/'));
            exit;
        }

        // Obter dados da assinatura
        $cashierSubscription = $user->cashierSubscriptions()
            ->where('stripe_status', 'active')
            ->where(function($query) {
                $query->whereNull('ends_at')
                      ->orWhere('ends_at', '>', now());
            })
            ->first();
            
        if (!$cashierSubscription) {
            $cashierSubscription = $user->cashierSubscriptions()
                ->orderBy('created_at', 'desc')
                ->first();
        }
            
        $plan = null;
        if ($cashierSubscription) {
            $plan = \App\Models\Plan::where('stripe_price_id', $cashierSubscription->stripe_price)->first();
        }

        // Obter próxima data de cobrança
        $nextBillingDate = null;
        if ($cashierSubscription && $cashierSubscription->stripe_status === 'active') {
            try {
                \Stripe\Stripe::setApiKey(config('cashier.secret'));
                $stripeSubscription = \Stripe\Subscription::retrieve($cashierSubscription->stripe_id);
                if (isset($stripeSubscription->current_period_end)) {
                    $nextBillingDate = \Carbon\Carbon::createFromTimestamp(
                        $stripeSubscription->current_period_end
                    );
                }
            } catch (\Exception $e) {
                $nextBillingDate = $cashierSubscription->created_at->addMonth();
            }
        }

        // Obter histórico de pagamentos
        $invoices = [];
        try {
            if ($user->stripe_id) {
                \Stripe\Stripe::setApiKey(config('cashier.secret'));
                $stripeInvoices = \Stripe\Invoice::all([
                    'customer' => $user->stripe_id,
                    'limit' => 5,
                ]);
                $invoices = $stripeInvoices->data;
            }
        } catch (\Exception $e) {
            // Silenciar erros
        }
    @endphp

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="text-center mb-4">
                    <h4>Menu do Cliente</h4>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('client/dashboard*') ? 'active' : '' }}" href="{{ route('client.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('client/chat*') ? 'active' : '' }}" href="{{ route('client.chat') }}">
                            <i class="fas fa-headset"></i>
                            Suporte
                        </a>
                    </li>
                      <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ ('/') }}">
                            <i class="fas fa-home"></i>
                            Página Inicial
                        </a>
                    </li>
                    </li>
                      <li class="nav-item">
                        <a class="nav-link {{ Request::is('profile') ? 'active' : '' }}" href="{{ ('/profile') }}">
                            <i class="fas fa-user"></i>
                            Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            Sair
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 ms-sm-auto px-md-4 py-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard do Cliente</h1>
                </div>

                <div class="alert alert-info">
                    <p class="lead mb-0">Bem-vindo, {{ $user->name }}!</p>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Informações da Assinatura</h5>
                            </div>
                            <div class="card-body">
                                @if($cashierSubscription)
                                    <div class="subscription-info">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="text-primary mb-0">Status da Assinatura</h5>
                                            <span class="badge bg-{{ $cashierSubscription->stripe_status === 'active' ? 'success' : ($cashierSubscription->stripe_status === 'trialing' ? 'info' : 'warning') }} px-3 py-2">
                                                @if($cashierSubscription->stripe_status === 'active')
                                                    Ativa
                                                @elseif($cashierSubscription->stripe_status === 'trialing')
                                                    Em período de teste
                                                @elseif($cashierSubscription->stripe_status === 'past_due')
                                                    Pagamento pendente
                                                @elseif($cashierSubscription->stripe_status === 'canceled')
                                                    Cancelada
                                                @else
                                                    {{ ucfirst($cashierSubscription->stripe_status) }}
                                                @endif
                                            </span>
                                        </div>
                
                                        <div class="subscription-details">
                                            <div class="row mb-2">
                                                <div class="col-md-5 fw-bold">Plano:</div>
                                                <div class="col-md-7">{{ $plan ? $plan->name : 'Plano ' . $cashierSubscription->stripe_price }}</div>
                                            </div>
                                            
                                            <div class="row mb-2">
                                                <div class="col-md-5 fw-bold">Preço:</div>
                                                <div class="col-md-7">
                                                    R$ {{ $plan ? number_format($plan->price, 2, ',', '.') : number_format(0, 2, ',', '.') }}/mês
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-2">
                                                <div class="col-md-5 fw-bold">Data de início:</div>
                                                <div class="col-md-7">{{ $cashierSubscription->created_at->format('d/m/Y') }}</div>
                                            </div>
                                            
                                            @if($cashierSubscription->trial_ends_at)
                                                <div class="row mb-2">
                                                    <div class="col-md-5 fw-bold">Período de teste até:</div>
                                                    <div class="col-md-7">
                                                        {{ $cashierSubscription->trial_ends_at->format('d/m/Y') }}
                                                    </div>
                                                </div>
                                            @endif
                                            
                                            @if($cashierSubscription->ends_at)
                                                <div class="row mb-2">
                                                    <div class="col-md-5 fw-bold">Assinatura expira em:</div>
                                                    <div class="col-md-7">
                                                        {{ $cashierSubscription->ends_at->format('d/m/Y') }}
                                                    </div>
                                                </div>
                                            @elseif($cashierSubscription->stripe_status === 'active' && $nextBillingDate)
                                                <div class="row mb-2">
                                                    <div class="col-md-5 fw-bold">Próxima cobrança:</div>
                                                    <div class="col-md-7">
                                                        {{ $nextBillingDate->format('d/m/Y') }}
                                                        <span class="ms-2 badge bg-info">
                                                            @php
                                                                $dias = (int)now()->diffInDays($nextBillingDate);
                                                            @endphp
                                                            @if($dias > 0)
                                                                Em {{ $dias }} {{ $dias == 1 ? 'dia' : 'dias' }}
                                                            @elseif($dias == 0)
                                                                Hoje!
                                                            @else
                                                                Expirada
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="mt-4">
                                            @if($cashierSubscription->stripe_status === 'active' || $cashierSubscription->stripe_status === 'trialing')
                                         <form id="cancelSubscriptionForm" action="{{ route('subscriptions.cancel') }}" method="POST" class="d-inline">
                                            @csrf

                                            @elseif($cashierSubscription->stripe_status === 'canceled' && $cashierSubscription->ends_at && $cashierSubscription->ends_at->isFuture())
                                                <a href="{{ route('subscriptions.resume') }}" class="btn btn-success">
                                                    Reativar Assinatura
                                                </a>
                                            @else
                                                <a href="{{ route('subscriptions.index') }}" class="btn btn-primary">
                                                    Assinar Novamente
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="alert alert-warning">
                                        <p>Você não possui uma assinatura ativa no momento.</p>
                                        <a href="{{ route('subscriptions.index') }}" class="btn btn-primary mt-2">
                                            Ver Planos Disponíveis
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0">Histórico de Pagamentos</h5>
                            </div>
                            <div class="card-body">
                                @if(count($invoices) > 0)
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Data</th>
                                                    <th>Valor</th>
                                                    <th>Status</th>
                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($invoices as $invoice)
                                                    <tr>
                                                        <td>{{ \Carbon\Carbon::createFromTimestamp($invoice->created)->format('d/m/Y') }}</td>
                                                        <td>R$ {{ number_format($invoice->amount_paid / 100, 2, ',', '.') }}</td>
                                                        <td>
                                                            <span class="badge bg-{{ $invoice->paid ? 'success' : 'warning' }}">
                                                                {{ $invoice->paid ? 'Pago' : 'Pendente' }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p>Nenhum pagamento registrado.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmCancel() {
            if (confirm('Tem certeza que deseja cancelar sua assinatura? Esta ação não pode ser desfeita.')) {
                // Adiciona um event listener para o formulário
                document.getElementById('cancelSubscriptionForm').addEventListener('submit', function(e) {
                    // Adiciona um pequeno atraso para garantir que o cancelamento seja processado
                    setTimeout(function() {
                        alert('Assinatura cancelada com sucesso!');
                        window.location.href = "{{ url('/') }}";
                    }, 1000);
                });
                
                // Submete o formulário
                document.getElementById('cancelSubscriptionForm').submit();
            }
        }

        // Verifica se há uma mensagem de sucesso na sessão
        @if(session('success'))
            alert('{{ session('success') }}');
            window.location.href = "{{ url('/') }}";
        @endif
    </script>
</body>
</html>