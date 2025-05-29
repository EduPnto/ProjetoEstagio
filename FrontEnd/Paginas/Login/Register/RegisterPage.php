<?php
define('BASE_URL', 'http://localhost/ProjetoEstagio/');
include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';
session_start();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>CLIS - Registar</title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>FrontEnd/CSS/Login/register.css">
  <script src="/ProjetoEstagio/BackEnd/Login/Register/resgiter.js"></script>
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
      <h2>Registar</h2>
      <form id="RegisterForm" method="POST" enctype="multipart/form-data">
        <label for="name">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <label for="name">Email:</label>
        <input type="text" id="email" name="email" required>

        <label for="password">Senha:</label>
        <input type="password" id="senha" name="senha" required oninput="this.value = this.value.trim()">

        <label for="foto_perfil">Foto de Perfil:</label>
        <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*" onchange="previewImage(event)">
        <br>
        <img id="foto_perfil_preview" src="#" alt="Pré-visualização da Foto de Perfil" style="display:none; max-width:150px; max-height:150px; margin-top:10px;"/>
        <br>
        <button type="submit">Registar</button>
      </form>
    </div>
    </main>
    <footer>
        <p>Contacto: geral@clis.jfe.pt | Tel: 227 344 418</p>
        <div class="redes">
            <a href="https://www.facebook.com/Freguesia.de.Ermesinde/?locale=pt_PT">Facebook</a> | <a href="https://www.instagram.com/jfermesinde/">Instagram</a>
        </div>
        <div class="logos">
            <img src="../../../Imagens/logo_adice.png" alt="ADICE">
            <img src="../../../Imagens/LogotipoJunta.png" alt="JFE" style="background-color: white; border-radius: 5px; padding: 5px;">
            <img src="../../../Imagens/rfe.png" alt="Refood">
        </div>
    </footer>
</body>
</html>