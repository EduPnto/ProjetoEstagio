<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>CLIS</title>
  <link rel="stylesheet" href="../../CSS/MainPage.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <div class="top-bar">
    <div class="logo">
      <img src="assets/logo.png" alt="Ermesinde Logo">
      <div>
        <strong>ermesinde</strong><br>
        junta de freguesia
      </div>
    </div>
    <h1>CLIS</h1>
    <div class="user">
      <span>Bem-Vindo,<br><strong>Refood</strong></span>
      <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="User">
    </div>
  </div>

  <div class="menu">
    <button onclick="loadPage('entidades')">Entidades</button>
    <button onclick="loadPage('servicos')">Serviços</button>
    <button onclick="loadPage('beneficiarios')">Beneficiários</button>
    <button onclick="loadPage('documentacao')">Documentação</button>
    <button onclick="loadPage('comunicacao')">Comunicação</button>
    <button class="empty"></button>
  </div>

  <div id="content"></div>

  <script src="js/main.js"></script>
</body>
</html>
