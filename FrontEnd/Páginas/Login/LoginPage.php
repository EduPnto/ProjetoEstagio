<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Login - Ermesinde</title>
  <link rel="stylesheet" href="../../CSS/Login.css">
</head>
<body>
  <div class="header">
    <img src="../../Imagens/LogotipoJunta.png" alt="Ermesinde Logo" class="logo">
  </div>

  <div class="login-box">
    <h2>Login</h2>
    <form id="loginForm">
      <label for="name">Nome:</label>
      <input type="text" id="name" name="name" required>

      <label for="password">Senha:</label>
      <input type="password" id="password" name="password" required>

      <div class="options">
        <label>
          <input type="checkbox" id="remember"> Lembrar senha
        </label>
        <a href="../EsqueceuSenha/ForgotPassword.php">Esqueceu-se da senha?</a>
      </div>

      <button type="submit">Entrar</button>
    </form>
  </div>

  <script src="../Login.js"></script>
</body>
</html>
