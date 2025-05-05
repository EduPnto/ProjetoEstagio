<?php
define('BASE_URL', 'http://localhost/ProjetoEstagio/');
include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';
session_start();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>CLIS - Login</title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>FrontEnd/CSS/Login/Login.css">
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('loginForm').addEventListener('submit', function(event) {
      event.preventDefault();

      const name = document.getElementById('name').value;
      const password = document.getElementById('password').value;

      fetch('<?php echo BASE_URL; ?>BackEnd/Login/LoginVerify.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `name=${encodeURIComponent(name)}&password=${encodeURIComponent(password)}`
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          window.location.replace('<?php echo BASE_URL; ?>FrontEnd/Paginas/MainPage.php');
        } else {
          alert(data.message || 'Login falhou.');
        }
      })
      .catch(error => console.error('Erro na requisição:', error));
    });
  });
  </script>
</head>
<body>
  <div class="header">
    <img src="../../Imagens/LogotipoJunta.png" alt="Logotipo Ermesinde" class="logo">
  </div>
  <main>
    <div class="login-box">
      <h2>Login</h2>
      <form id="loginForm" method="POST">
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" required>

        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required>

        <div class="options">
          <label>
            <input type="checkbox" id="remember"> Lembrar senha
          </label>
          <a href="../Login/EsqueceuSenha/ForgotPassword.php">Esqueceu-se da senha?</a>
        </div>

        <button type="submit">Entrar</button>
      </form>
    </div>
  </main>
  <footer>
        <p>Contacto: geral@clis.jfe.pt | Tel: +351 227 344 418</p>
        <div class="redes">
            <a href="https://www.facebook.com/Freguesia.de.Ermesinde/?locale=pt_PT">Facebook</a> | <a href="#">Instagram</a> | <a href="#">LinkedIn</a>
        </div>
        <div class="logos">
            <img src="logo-adice.png" alt="ADICE">
            <img src="logo-jfe.png" alt="JFE">
            <img src="logo-refood.png" alt="Refood">
        </div>
    </footer>
</body>
</html>