 // Função para mostrar/esconder senha
 function togglePasswordVisibility() {
    const passwordField = document.getElementById('password');
    const toggleIcon = document.querySelector('.toggle-password');
    
    if (passwordField.type === "password") {
      passwordField.type = "text";
      toggleIcon.classList.add("visible");
    } else {
      passwordField.type = "password";
      toggleIcon.classList.remove("visible");
    }
  }

  // Validação básica no cliente
  document.querySelector('form').addEventListener('submit', function(e) {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    
    if (!email.includes('@')) {
      e.preventDefault();
      alert('Por favor, insira um e-mail válido.');
      return false;
    }
    
    if (password.length < 1) {
      e.preventDefault();
      alert('Por favor, insira sua senha.');
      return false;
    }
  });