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
      <button onclick="verifyEmail()">Enviar</button>
      <div id="errorBox" style="color: red; margin-top: 10px;"></div>
    </div>

    <div id="stepNewPassword" style="display: none;">
      <label for="newPassword">Nova senha:</label>
      <input type="password" id="newPassword" required>

      <label for="confirmPassword">Confirmar nova senha:</label>
      <input type="password" id="confirmPassword" required>

      <button onclick="updatePassword()">Alterar Senha</button>
    </div>
  </div>

  <script src='/ProjetoEstagio/BackEnd/ForgotPassword/StepNewpassword.js'></script>
</body>
</html>