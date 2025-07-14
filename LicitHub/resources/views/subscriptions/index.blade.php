@php
    $user = auth()->user();
    if (!($user->user_type === 'admin')) {
        header('Location: ' . url('/#planos'));
        exit;
    }
@endphp
{{-- resources/views/subscriptions/index.blade.php --}}
@isset($plans)
<style>
    :root {
        --primary-color: #6c5ce7;
        --secondary-color: #a29bfe;
        --accent-color: #fd79a8;
        --dark-color: #2d3436;
        --light-color: #f5f6fa;
        --success-color: #00b894;
        --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }
    
    .plans-section {
        padding: 5rem 0;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .section-title {
        text-align: center;
        font-size: 2.5rem;
        color: var(--dark-color);
        margin-bottom: 3rem;
        position: relative;
        font-weight: 700;
    }
    
    .section-title::after {
        content: '';
        display: block;
        width: 80px;
        height: 4px;
        background: var(--primary-color);
        margin: 15px auto 0;
        border-radius: 2px;
    }
    
    .plans-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }
    
    .plan-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
        position: relative;
    }
    
    .plan-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }
    
    .plan-card:nth-child(2) {
        border-top: 4px solid var(--accent-color);
    }
    
    .plan-card:nth-child(2) .plan-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
    }
    
    .plan-header {
        padding: 2rem;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        text-align: center;
    }
    
    .plan-card h3 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 600;
    }
    
    .plan-price {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 1rem 0 0;
    }
    
    .plan-price span {
        font-size: 1rem;
        font-weight: 400;
        opacity: 0.8;
    }
    
    .plan-body {
        padding: 2rem;
    }
    
    .plan-description {
        color: var(--dark-color);
        opacity: 0.8;
        text-align: center;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }
    
    .plan-features {
        list-style: none;
        padding: 0;
        margin: 0 0 2rem;
    }
    
    .plan-features li {
        padding: 0.8rem 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
    }
    
    .plan-features li::before {
        content: '✓';
        color: var(--success-color);
        font-weight: bold;
        margin-right: 10px;
    }
    
    .plan-features li.text-muted {
        opacity: 0.5;
    }
    
    .plan-features li.text-muted::before {
        content: '✕';
        color: #ff7675;
    }
    
    .plan-footer {
        padding: 0 2rem 2rem;
        text-align: center;
    }
    
    .btn-subscribe {
        display: inline-block;
        padding: 12px 30px;
        background: var(--primary-color);
        color: white;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
        border: none;
        cursor: pointer;
        width: 100%;
        box-shadow: 0 4px 15px rgba(108, 92, 231, 0.3);
    }
    
    .btn-subscribe:hover {
        background: var(--accent-color);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(253, 121, 168, 0.4);
    }
    
    .plan-card:nth-child(2) .btn-subscribe {
        background: var(--accent-color);
        box-shadow: 0 4px 15px rgba(253, 121, 168, 0.3);
    }
    
    .plan-card:nth-child(2) .btn-subscribe:hover {
        background: var(--primary-color);
        box-shadow: 0 6px 20px rgba(108, 92, 231, 0.4);
    }
    
    @media (max-width: 768px) {
        .plans-grid {
            grid-template-columns: 1fr;
        }
        
        .section-title {
            font-size: 2rem;
        }
    }
</style>

<div class="plans-section">
    <div class="container">
        <h2 class="section-title">Escolha o Plano Perfeito</h2>
        
        <div class="plans-grid">
            @foreach ($plans as $plan)
            <div class="plan-card">
                <div class="plan-header">
                    <h3>{{ $plan->name }}</h3>
                    <div class="plan-price">
                        R$ {{ number_format($plan->price, 2, ',', '.') }} 
                        <span>/{{ $plan->interval }}</span>
                    </div>
                </div>
                
                <div class="plan-body">
                    <p class="plan-description">{{ $plan->description }}</p>

                    @php
                        $features = is_array($plan->features) ? $plan->features : json_decode($plan->features, true) ?? [];
                        $features_off = is_array($plan->features_off) ? $plan->features_off : json_decode($plan->features_off, true) ?? [];
                    @endphp

                    <ul class="plan-features">
                        @foreach($features as $feature)
                            @if(trim($feature))
                                <li>{{ $feature }}</li>
                            @endif
                        @endforeach

                        @foreach($features_off as $feature_off)
                            @if(trim($feature_off))
                                <li class="text-muted">{{ $feature_off }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                
                <div class="plan-footer">
                        <a href="{{ route('subscriptions.checkout', $plan->id) }}" class="btn btn-subscribe">
                        Assinar Agora
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endisset