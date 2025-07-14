<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Detalhes do Plano</title>
    @vite(['resources/css/admin.css'])
</head>
<body class="light-mode">
    <main class="content-wrapper">
        <div class="page-header" style="justify-content: space-between;">
            <h1 class="page-title">Detalhes do Plano: {{ $plan->name }}</h1>
            <a href="{{ route('plans.edit', $plan) }}" class="btn btn-warning">Editar Plano</a>
        </div>

        <div class="cards-grid">
            <div class="card">
                <div class="card-info">
                    <h3>Informações Básicas</h3>
                    <ul class="list-group mt-2">
                        <li class="list-group-item"><strong>Nome:</strong> {{ $plan->name }}</li>
                        <li class="list-group-item"><strong>Slug:</strong> {{ $plan->slug }}</li>
                        <li class="list-group-item"><strong>Preço:</strong> R$ {{ number_format($plan->price, 2, ',', '.') }}</li>
                        <li class="list-group-item"><strong>Intervalo:</strong> {{ $plan->interval === 'month' ? 'Mensal' : 'Anual' }}</li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Configurações</h3>
                    <ul class="list-group mt-2">
                        <li class="list-group-item">
                            <strong>Status:</strong>
                            <span class="badge {{ $plan->is_active ? 'badge-success' : 'badge-secondary' }}">
                                {{ $plan->is_active ? 'Ativo' : 'Inativo' }}
                            </span>
                        </li>
                        <li class="list-group-item"><strong>Trial:</strong> {{ $plan->trial_days }} dias</li>
                        <li class="list-group-item"><strong>ID Stripe:</strong> {{ $plan->stripe_price_id ?? 'Não configurado' }}</li>
                        <li class="list-group-item">
                            <strong>Assinantes:</strong>
                            <span class="badge badge-primary">{{ $plan->subscriptions()->count() }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card mt-6">
            <div class="card-info">
                <h3>Descrição</h3>
                <p class="mt-2">{{ $plan->description ?? 'Nenhuma descrição fornecida.' }}</p>
            </div>
        </div>

        @php
            $features = is_array($plan->features) ? $plan->features : json_decode($plan->features, true) ?? [];
            $featuresOff = is_array($plan->features_off) ? $plan->features_off : json_decode($plan->features_off, true) ?? [];
        @endphp

        @if(count($features) > 0)
        <div class="card mt-6">
            <div class="card-info">
                <h3>Recursos Ativos</h3>
                <ul class="list-group mt-2">
                    @foreach($features as $feature)
                        <li class="list-group-item">
                            ✅ {{ $feature }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        @if(count($featuresOff) > 0)
        <div class="card mt-6">
            <div class="card-info">
                <h3>Recursos Bloqueados</h3>
                <ul class="list-group mt-2">
                    @foreach($featuresOff as $feature)
                        <li class="list-group-item text-muted">
                            ❌ {{ $feature }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <div class="card-footer mt-6">
            <small class="text-muted">Criado em: {{ $plan->created_at->format('d/m/Y H:i') }}</small>
        </div>
    </main>
</body>
</html>
