<?php
  require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php'; // Adjusted path to db_connect.php
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>CLIS - Página Principal</title>
  <link rel="stylesheet" href="/ProjetoEstagio/FrontEnd/CSS/mainPage.css">
  <script src='/ProjetoEstagio/BackEnd/MainPageDropdown/DropdownMain.js'></script>
</head>
<body>
  <div class="top-bar">
    <div class="logo" style="padding: 10px; border-radius: 5px;">
      <img src="../../Imagens/CLIS.png">
    </div>
    <div class="user-info">
      <?php
        session_start();
        $username = isset($_SESSION['user']) ? $_SESSION['user'] : null;

        if ($username) {
          // Se o utilizador estiver autenticado, mostrar "Bem-vindo"
          $userImg = '../../Icons/user.png'; // Imagem por defeito

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
          // Se não estiver autenticado, mostrar botões de Login e Registo
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
  <div class="contact-bar">
      
  </div>
  <div class="menu-container">
    <?php
      $menuItems = [
        ["href" => "entidades.php", "icon" => "../../Icons/Entidades.png", "alt" => "Entidades", "label" => "Entidades"],
        ["href" => "././Beneficiario/SubPageBeneficiario.php", "icon" => "../../Icons/Beneficiario.png", "alt" => "Beneficiários", "label" => "Beneficiários"],
        ["href" => "documentacao.php", "icon" => "../../Icons/Documentos.png", "alt" => "Documentação", "label" => "Documentação"],
        ["href" => "comunicacao.php", "icon" => "../../Icons/comunicacao.png", "alt" => "Comunicação", "label" => "Comunicação"],
        ["href" => "resultados.php", "icon" => "../../Icons/resultados.svg", "alt" => "Resultados", "label" => "Resultados"]
      ];

      foreach ($menuItems as $item) {
        echo '<a href="' . $item["href"] . '" class="menu-btn">';
        echo '<img src="' . $item["icon"] . '" alt="' . $item["alt"] . '">';
        echo '<span>' . $item["label"] . '</span>';
        echo '</a>';
      }
    ?>
  </div>

  <footer>
    <p>Contacto: geral@clis.jfe.pt | Tel: 227 344 418</p>
    <div class="redes">
      <a href="https://www.facebook.com/Freguesia.de.Ermesinde/?locale=pt_PT">Facebook</a> | <a href="https://www.instagram.com/jfermesinde/">Instagram</a>
    </div>
    <div class="logos">
      <img src="../../Imagens/logo_adice.png" alt="ADICE">
      <img src="../../Imagens/LogotipoJunta.png" alt="JFE" style="background-color: white; border-radius: 5px; padding: 5px;">
      <img src="../../Imagens/rfe.png" alt="Refood">
    </div>
  </footer>
</body>
</html>
