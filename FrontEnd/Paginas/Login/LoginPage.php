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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            window.location.replace('<?php echo BASE_URL; ?>FrontEnd/Paginas/MainPage/MainPage.php');
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
  <div class="top-bar">
    <div class="logo" style="padding: 5px; border-radius: 5px;">
      <img src="/ProjetoEstagio/FrontEnd/Imagens/CLIS.png">
    </div>
  </div>
  <div class="contact-bar" style="display: center;">
      <ul>
          <li><a href="/ProjetoEstagio/FrontEnd/Paginas/MainPage/MainPage.php" style="border-right: 1px solid;">Início</a></li>
          <li><a href="#contact" style="border-right: 1px solid;">Entidades e Parceiros</a></li>
          <li><a href="#about">Sobre nós</a></li>
      </ul>
  </div>
  <main>
    <div class="login-box">
      <h2>Login</h2>
      <form id="loginForm" method="POST">
        <label for="name">Nome/Email:</label>
        <input type="text" id="name" name="name" required>

        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required oninput="this.value = this.value.trim()">

        <div class="options">
          <label>
            <input type="checkbox" id="remember"> Lembrar senha
          </label>
          <a href="../Login/EsqueceuSenha/ForgotPassword.php">Esqueceu-se da senha?</a>
        </div>

        <button type="submit" class="Entrar">Entrar</button>
        <button type="button" class="Registar" onclick="window.location.href='<?php echo BASE_URL; ?>FrontEnd/Paginas/Login/Register/RegisterPage.php'">Não tem conta..</button>
      </form>
    </div>
  </main>
  <footer>
    <p>Contacto: geral@clis.jfe.pt | Tel: 227 344 418</p>
    <br>
    <div class="redes">
      <a href="https://www.facebook.com/Freguesia.de.Ermesinde/?locale=pt_PT">Facebook</a> | <a href="https://www.instagram.com/jfermesinde/">Instagram</a>
    </div>
    <div class="logos">
      <img src="../../Imagens/logo_adice.png" alt="ADICE">
      <img src="../../Imagens/LogotipoJunta.png" alt="JFE" style="background-color: white; border-radius: 5px; padding: 5px;">
      <img src="../../Imagens/rfe.png" alt="Refood">
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>