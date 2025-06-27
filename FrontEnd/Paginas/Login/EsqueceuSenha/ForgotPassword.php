<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Recuperar Senha - Ermesinde</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/ProjetoEstagio/FrontEnd/CSS/Login/ForgotPassword.css">
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
    <div class="Recover-box" id="recoveryBox">
      <h2>Recuperar Senha</h2>

      <div id="stepEmail">
        <label for="email">Digite seu e-mail:</label>
        <input type="email" id="email" required>
        <br>
        <br>
        <button style="width: 100px;" onclick="verifyEmail()">Enviar</button>
        <div id="errorBox" style="color: red; margin-top: 10px;"></div>
      </div>

      <div id="stepNewPassword" style="display: none;">
        <label for="newPassword">Nova senha:</label>
        <input type="password" id="newPassword" required>

        <label for="confirmPassword">Confirmar nova senha:</label>
        <input type="password" id="confirmPassword" required>

        <button style="width: 500px;" onclick="updatePassword()">Alterar Senha</button>
      </div>
    </div>
  </main>
  <footer>
    <p>Contacto: geral@clis.jfe.pt | Tel: 227 344 418</p>
    <br>
    <div class="redes">
      <a href="https://www.facebook.com/Freguesia.de.Ermesinde/?locale=pt_PT">Facebook</a> | <a href="https://www.instagram.com/jfermesinde/">Instagram</a>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src='/ProjetoEstagio/BackEnd/ForgotPassword/StepNewpassword.js'></script>
</body>
</html>