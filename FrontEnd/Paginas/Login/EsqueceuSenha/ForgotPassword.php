<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Recuperar Senha - Ermesinde</title>
  <link rel="stylesheet" href="/ProjetoEstagio/FrontEnd/CSS/Login/ForgotPassword.css">
</head>
<body>
  <div class="header">
    <img src="../../../Imagens/LogotipoJunta.png" alt="Ermesinde Logo" class="logo">
  </div>

  <div class="Recover-box" id="recoveryBox">
    <h2>Recuperar Senha</h2>

    <div id="stepEmail">
      <label for="email">Digite seu e-mail:</label>
      <input type="email" id="email" required>
      <button onclick="sendRecoveryCode()">Enviar Código</button>
    </div>

    <div id="stepCode" style="display: none;">
      <label for="code">Digite o código que recebeu por e-mail:</label>
      <input type="text" id="code" required>
      <button onclick="verifyCode()">Verificar Código</button>
    </div>

    <div id="stepNewPassword" style="display: none;">
      <label for="newPassword">Nova senha:</label>
      <input type="password" id="newPassword" required>

      <label for="confirmPassword">Confirmar nova senha:</label>
      <input type="password" id="confirmPassword" required>

      <button onclick="updatePassword()">Alterar Senha</button>
    </div>
  </div>

  <script>
    function sendRecoveryCode() {
      const email = document.getElementById('email').value;
      if (email) {
        // Simulate sending the recovery code
        alert('Código de recuperação enviado para o e-mail fornecido.');
        document.getElementById('stepEmail').style.display = 'none';
        document.getElementById('stepCode').style.display = 'block';
      } else {
        alert('Por favor, insira um e-mail válido.');
      }
    }

    function verifyCode() {
      const code = document.getElementById('code').value;
      if (code) {
        // Simulate verifying the code
        alert('Código verificado com sucesso.');
        document.getElementById('stepCode').style.display = 'none';
        document.getElementById('stepNewPassword').style.display = 'block';
      } else {
        alert('Por favor, insira o código recebido.');
      }
    }

    function updatePassword() {
      const newPassword = document.getElementById('newPassword').value;
      const confirmPassword = document.getElementById('confirmPassword').value;

      if (newPassword && confirmPassword) {
        if (newPassword === confirmPassword) {
          // Simulate updating the password
          alert('Senha alterada com sucesso.');
          window.location.href = '../Login/LoginPage.php';
        } else {
          alert('As senhas não coincidem.');
        }
      } else {
        alert('Por favor, preencha todos os campos.');
      }
    }
  </script>
</body>
</html>