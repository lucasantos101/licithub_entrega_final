<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha - LictHub</title>
    @vite(['resources/css/esqueceu.css'])
    <style>
        .alert {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="forgot-container">
        <h2>Recuperar Senha</h2>
        
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
        
        <p>Insira aqui o seu e-mail para receber um link de redefinição de senha.</p>
        
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div>
                <input id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="button-container">
                <button type="submit" class="forgot-button">Enviar Link</button>
            </div>
        </form>
        
        <p class="back-to-login">Lembrou sua senha? <a href="{{ route('login') }}">Voltar ao Login</a></p>
    </div>
</body>
</html>