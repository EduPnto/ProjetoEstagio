<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>CLIS - Página Principal</title>
    <link rel="stylesheet" href="/ProjetoEstagio/FrontEnd/CSS/mainPage.css">
    <script>
  document.addEventListener('DOMContentLoaded', function() {
    const trigger = document.querySelector('.user-trigger');
    const menu = document.querySelector('.dropdown-menu');

    trigger.addEventListener('click', function() {
      menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    });

    window.addEventListener('click', function(e) {
      if (!trigger.contains(e.target)) {
        menu.style.display = 'none';
      }
    });
  });
</script>

</head>
<body>
    <div class="top-bar">
      <div class="logo" style="background-color: white; display: flex; align-items: center; justify-content: center; padding: 10px;">
        <img src="../Imagens/LogotipoJunta.png">
      </div>
      <div class="title">CLIS - Comissão Local de Intervenção Social</div>
      <div class="user-info">
        <?php $username = "Refood"; ?>
        <div class="user-dropdown">
          <div class="user-trigger">
            <div>Bem-Vindo,<br><strong><?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></strong></div>
            <img src="../Imagens/default-user.png" alt="User" class="user-img">
          </div>
          <div class="dropdown-menu">
            <a href="detalhesConta.php">Ver Detalhes da Conta</a>
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
            ["href" => "../Paginas/Beneficiario/Beneficiario.php", "icon" => "../Icons/Beneficiario.png", "alt" => "Beneficiários", "label" => "Beneficiários"],
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
    </div>
    <footer>
        <p>Contacto: geral@clis.jfe.pt | Tel: +351 227 344 418</p>
        <div class="redes">
            <a href="https://www.facebook.com/Freguesia.de.Ermesinde/?locale=pt_PT">Facebook</a> | <a href="#">Instagram</a> | <a href="#">LinkedIn</a>
        </div>
        <div class="logos">
            <img src="logo-adice.png" alt="ADICE">
            <img src="logo-jfe.png" alt="JFE">
            <img src="logo-refood.png" alt="Refood">
        </div>
    </footer>
</body>
</html>
