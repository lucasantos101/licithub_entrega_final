<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastro</title>
    @vite(['resources/css/cadastro.css'])
</head>
<body>
    <div class="register-container">
        <div class="register-left">
            <h2>Bem-vindo de volta!</h2>
            <p>Grandes oportunidades nascem de boas escolhas. Faça parte da melhor licitação hoje!</p>
            <a class="signin-button" href="{{ route('login') }}">Entrar</a>
        </div>

        <div class="register-right">
            <h2>Crie Sua Conta</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <input id="name" type="text" name="name" placeholder="Nome Completo" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <input id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <div class="password-container">
                    <input id="password" type="password" name="password" placeholder="Senha" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility('password')"></span>
                </div>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <div class="password-container">
                    <input id="confirm-password" type="password" name="password_confirmation" placeholder="Confirmar Senha" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility('confirm-password')"></span>
                </div>

                <button class="register-button" type="submit">Criar Conta</button>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(id) {
            const input = document.getElementById(id);
            const toggle = input.nextElementSibling;

            if (input.type === 'password') {
                input.type = 'text';
                toggle.classList.add('show');
            } else {
                input.type = 'password';
                toggle.classList.remove('show');
            }
        }
    </script>
</body>
</html>
