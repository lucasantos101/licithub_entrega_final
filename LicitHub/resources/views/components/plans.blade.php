@props(['plans' => []])

<div class="plans-section">
    <h2>Planos Disponíveis</h2>
    
    @if(count($plans) > 0)
    <div class="plans-grid">
        @foreach($plans as $plan)
        <div class="plan-card">
            <h3>{{ $plan->name }}</h3>
            <div class="plan-price">
                R$ {{ number_format($plan->price, 2, ',', '.') }} / {{ $plan->interval }}
            </div>
            <p class="plan-description">{{ $plan->description }}</p>

            @php
                $features = is_array($plan->features) ? $plan->features : explode("\n", $plan->features);
            @endphp
            
            <ul class="plan-features">
                @foreach($features as $feature)
                    @if(trim($feature))
                        <li>{{ $feature }}</li>
                    @endif
                @endforeach
            </ul>
            
            <a href="{{ route('subscriptions.checkout', $plan->id) }}" class="btn-subscribe">
                Assinar
            </a>
        </div>
        @endforeach
    </div>
    @else
    <p class="no-plans">Nenhum plano disponível no momento.</p>
    @endif
</div>
