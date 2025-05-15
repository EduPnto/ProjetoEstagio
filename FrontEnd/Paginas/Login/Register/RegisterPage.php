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
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>FrontEnd/CSS/Login/Login.css">
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('RegisterForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const form = document.getElementById('RegisterForm');
        const formData = new FormData(form);

        fetch('<?php echo BASE_URL; ?>BackEnd/Login/Register/RegisterAccount.php', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            window.location.replace('<?php echo BASE_URL; ?>FrontEnd/Paginas/Login/LoginPage.php');
          } else {
            alert(data.message || 'Registo falhou.');
          }
        })
        .catch(error => console.error('Erro na requisição:', error));
      });
    });
  </script>
</head>
<body>
  <div class="header">
    <img src="../../../Imagens/LogotipoJunta.png" alt="Logotipo Ermesinde" class="logo">
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

        <script>
          function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('foto_perfil_preview');
            if (input.files && input.files[0]) {
              const reader = new FileReader();
              reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
              }
              reader.readAsDataURL(input.files[0]);
            } else {
              preview.src = '#';
              preview.style.display = 'none';
            }
          }
        </script>

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