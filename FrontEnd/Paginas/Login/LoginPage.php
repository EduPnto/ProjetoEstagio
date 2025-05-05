<?php
define('BASE_URL', 'http://localhost/ProjetoEstagio/');
include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';
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

    fetch('<?php echo BASE_URL; ?>Login/LoginVerify.php', { // Caminho para o novo ficheiro PHP
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: `name=${encodeURIComponent(name)}&password=${encodeURIComponent(password)}`
    })

    .then(response => response.json())
    .then(data => {
      console.log(data); // <-- Check what is being received
      if (data.success) {
        window.location.href = '/ProjetoEstagio/FrontEnd/Paginas/MainPage.php';
      } else {
        alert(data.message);
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
</body>
</html>