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


// Validação do formulário no lado do cliente
document.getElementById('register-form').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;
    const email = document.getElementById('email').value;
    
    // Validação básica de email
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        e.preventDefault();
        alert('Por favor, insira um e-mail válido.');
        return false;
    }
    
    // Validação de senha
    if (password.length < 8) {
        e.preventDefault();
        alert('A senha deve ter pelo menos 8 caracteres!');
        return false;
    }
    
    if (password !== confirmPassword) {
        e.preventDefault();
        alert('As senhas não coincidem!');
        return false;
    }
    
    return true;
});