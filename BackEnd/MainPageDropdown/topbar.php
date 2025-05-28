<?php
  session_start();
  require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>
<div class="top-bar">
    <div class="logo" style="padding: 5px; border-radius: 5px;">
      <img src="/ProjetoEstagio/FrontEnd/Imagens/CLIS.png">
    </div>
    <div class="user-info">
      <?php
        $username = isset($_SESSION['user']) ? $_SESSION['user'] : null;

        if ($username) {
          $userImg = '../../Icons/user.png';

          $query = "SELECT foto_perfil FROM users WHERE nome = ?";
          $stmt = $conn->prepare($query);
          $stmt->bind_param("s", $username);
          $stmt->execute();
          $stmt->store_result();
          $stmt->bind_result($profileImage);

          if ($stmt->fetch() && !empty($profileImage)) {
            $userImg = 'data:image/png;base64,' . base64_encode($profileImage);
          }

          $stmt->close();
      ?>
      <div class="user-dropdown">
        <div class="user-trigger" >
          <div>Bem-Vindo,<br><strong><?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></strong></div>
          <img src="<?php echo $userImg; ?>" alt="User" class="user-img" onclick="toggleDropdown()">
        </div>
          <div class="dropdown-menu" id="dropdownMenu">
            <a href="/ProjetoEstagio/FrontEnd/Perfil/detalhesConta.php">Ver Detalhes da Conta</a>
            <a href="/ProjetoEstagio/BackEnd/Login/Logout.php">Logout</a>
          </div>
        </div>
      </div>
      <?php
        } else {
      ?>
          <div class="auth-buttons" style="display: flex; gap: 10px;">
            <a href="/ProjetoEstagio/FrontEnd/Paginas/Login/LoginPage.php" class="btn-login">Login</a>
            <a href="/ProjetoEstagio/FrontEnd/Paginas/Login/Register/RegisterPage.php" class="btn-register">Registar</a>
          </div>
      <?php
        }
      ?>
    </div>
  </div>
  <div class="contact-bar" style="display: center;">
      <ul>
          <li><a href="/ProjetoEstagio/FrontEnd/Paginas/MainPage/MainPage.php" style="border-right: 1px solid;">Início</a></li>
          <li><a href="#contact" style="border-right: 1px solid;">Entidades e Parceiros</a></li>
          <li><a href="#about">Sobre nós</a></li>
      </ul>
  </div>