<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>CLIS - Recuperar Senha</title>
  <link rel="stylesheet" href="../../../../CSS/ForgotPassword.css">
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

  <script src="../BackEnd/recoverPassword.js"></script>
</body>
</html>
