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
      <div class="logo" style="background-color: white; display: flex; align-items: center; justify-content: center; padding: 10px; border-radius: 5px;">
        <img src="../Imagens/LogotipoJunta.png">
      </div>
      <div class="title">CLIS - Comissão Local de Intervenção Social</div>
      <div class="user-info">
        <?php 
          session_start();
          $username = isset($_SESSION['user']) ? $_SESSION['user'] : 'Visitante';
        ?>
        <div class="user-dropdown" style="background-color: #ccc; padding: 5px 15px 10px 15px; border-radius: 10px; border: 1px solid #111111;">
          <div class="user-trigger">
            <div>Bem-Vindo,<br><strong><?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></strong></div>
            <img src="../Imagens/logo_adice.png" alt="User" class="user-img">
          </div>
          <div class="dropdown-menu">
            <a href="../Perfil/detalhesConta.php">Ver Detalhes da Conta</a>
            <a href="../../BackEnd/Login/Logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <div class="menu-container">
        <?php
        $menuItems = [
            ["href" => "entidades.php", "icon" => "../Icons/Entidades.png", "alt" => "Entidades", "label" => "Entidades"],
            ["href" => "servicos.php", "icon" => "../Icons/servicos.png", "alt" => "Serviços", "label" => "Serviços"],
            ["href" => "../Paginas/Beneficiario/SubPageBeneficiario.php", "icon" => "../Icons/Beneficiario.png", "alt" => "Beneficiários", "label" => "Beneficiários"],
            ["href" => "documentacao.php", "icon" => "../Icons/Documentos.png", "alt" => "Documentação", "label" => "Documentação"],
            ["href" => "comunicacao.php", "icon" => "../Icons/comunicacao.png", "alt" => "Comunicação", "label" => "Comunicação"],
            ["href" => "resultados.php", "icon" => "../Icons/resultados.svg", "alt" => "Resultados", "label" => "Resultados"]
        ];

        foreach ($menuItems as $item) {
            echo '<a href="' . $item["href"] . '" class="menu-btn">';
            echo '<img src="' . $item["icon"] . '" alt="' . $item["alt"] . '">';
            echo '<span>' . $item["label"] . '</span>';
            echo '</a>';
        }
        ?>
        <br>
        <div class="submenu-container">
          <label>adadadasdas</label>
        </div>
    </div>
    
    <footer>
        <p>Contacto: geral@clis.jfe.pt | Tel: 227 344 418</p>
        <div class="redes">
            <a href="https://www.facebook.com/Freguesia.de.Ermesinde/?locale=pt_PT">Facebook</a> | <a href="https://www.instagram.com/jfermesinde/">Instagram</a>
        </div>
        <div class="logos">
            <img src="../Imagens/logo_adice.png" alt="ADICE">
            <img src="../Imagens/LogotipoJunta.png" alt="JFE" style="background-color: white; border-radius: 5px; padding: 5px;">
            <img src="../Imagens/rfe.png" alt="Refood">
        </div>
    </footer>
</body>
</html>
