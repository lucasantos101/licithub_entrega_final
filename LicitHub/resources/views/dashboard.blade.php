@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Você está logado!') }}
                    
                    <div class="mt-3">
                        <h4>Bem-vindo, {{ Auth::user()->name }}!</h4>
                        <p>Tipo de usuário: {{ Auth::user()->user_type }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
