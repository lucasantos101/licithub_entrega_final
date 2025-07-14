@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Checkout - {{ $plan->name }}</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="payment-form" action="{{ route('subscriptions.process', $plan->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="card-element" class="form-label">Cartão de Crédito</label>
                            <div id="card-element" class="form-control"></div>
                            <div id="card-errors" class="invalid-feedback d-block"></div>
                        </div>

                        <input type="hidden" name="payment_method" id="payment-method">
                        
                        <div class="d-grid gap-2">
                            <button id="card-button" class="btn btn-primary" type="submit" data-secret="{{ $intent->client_secret }}">
                                Pagar R$ {{ number_format($plan->price, 2, ',', '.') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ $stripeKey }}');
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    
    cardElement.mount('#card-element');
    
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;
    
    cardElement.addEventListener('change', function(event) {
        const displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
    
    const form = document.getElementById('payment-form');
    
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        cardButton.disabled = true;
        
        const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: '{{ auth()->user()->name }}'
                    }
                }
            }
        );
        
        if (error) {
            cardButton.disabled = false;
            const errorElement = document.getElementById('card-errors');
            errorElement.textContent = error.message;
        } else {
            const paymentMethodInput = document.getElementById('payment-method');
            paymentMethodInput.value = setupIntent.payment_method;
            form.submit();
        }
    });
</script>
@endpush    
@endsection
