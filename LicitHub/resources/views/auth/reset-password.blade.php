@if(session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha - LictHub</title>
    @vite(['resources/css/esqueceu.css'])
    <style>
        .alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}

.alert-success {
    color: #3c763d;
    background-color: #dff0d8;
    border-color: #d6e9c6;
}
    </style>
</head>
<body>
    <div class="forgot-container">

        @if(session('status'))
<div class="alert alert-{{ session('alertType', 'success') }}" 
     style="padding: 15px; margin-bottom: 20px; 
            background-color: #d4edda; color: #155724; 
            border-radius: 4px; border: 1px solid #c3e6cb;">
    {{ session('status') }}
    <button type="button" 
            style="float: right; background: none; border: none; cursor: pointer;" 
            onclick="this.parentElement.style.display='none'">
        ×
    </button>
</div>
@endif

        <h2>Redefinir Senha</h2>
        
        @if(session('status'))
            <div class="alert success">
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert error">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif
        
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            <!-- Email Address -->
            <div>
                <label for="email">Email</label>
                <input id="email" class="input-field" type="email" name="email" 
                       value="{{ old('email', request()->email) }}" required autofocus>
            </div>

            <!-- Password -->
            <div style="margin-top: 1rem;">
                <label for="password">Nova Senha</label>
                <input id="password" class="input-field" type="password" 
                       name="password" required>
            </div>

            <!-- Confirm Password -->
            <div style="margin-top: 1rem;">
                <label for="password_confirmation">Confirmar Nova Senha</label>
                <input id="password_confirmation" class="input-field" 
                       type="password" name="password_confirmation" required>
            </div>

            <div class="button-container">
                <button type="submit" class="forgot-button">
                    Redefinir Senha
                </button>
            </div>
        </form>
        
        <p class="back-to-login">Lembrou sua senha? <a href="{{ route('login') }}">Voltar ao Login</a></p>
    </div>
</body>
</html>