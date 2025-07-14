<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  @vite(['resources/css/login.css'])
</head>
<body>
  
  <div class="container">
  <!--botao para voltar ao site -->
    
    
    <div class="login-panel">
      
      <h2>Faça seu login</h2>
      <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="email">Email</label>
        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
        @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror

        <label for="password">Senha</label>
        <div class="password-container">
          <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Senha">
          <span class="toggle-password" onclick="togglePasswordVisibility()"></span>
        </div>
        @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
        
        <a href="{{ route('password.request') }}" class="forgot">Esqueci minha senha</a>
        <button type="submit" class="login-btn">Entrar</button>
      </form>
      <a href="{{ route('register') }}" class="register">Ainda não tenho uma conta</a>
    </div>
    <div class="image-panel"></div>
  </div>

  <script>
    function togglePasswordVisibility() {
      const passwordInput = document.getElementById('password');
      const toggleIcon = document.querySelector('.toggle-password');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.add('show');
      } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('show');
      }
    }
  </script>
</body>
</html>