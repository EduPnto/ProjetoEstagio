<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>CLIS - Página Principal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/ProjetoEstagio/FrontEnd/CSS/mainPage.css">
  <script src='/ProjetoEstagio/BackEnd/MainPageDropdown/DropdownMain.js'></script>
  <link rel="icon" href="/ProjetoEstagio/FrontEnd/Imagens/CLIS.png" type="image/png">
</head>
<body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/MainPageDropdown/topbar.php'; ?>
  
  <div class="menu-container">
    <?php
      if (isset($_SESSION['user'])) {
        $menuItems = [
          ["href" => "Entidades/MostrarEntidades.php", "icon" => "../../Icons/Entidades.png", "alt" => "Entidades", "label" => "Entidades"],
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
      } else {
        $menuItems = [
          ["href" => "Entidades/MostrarEntidades.php", "icon" => "../../Icons/Entidades.png", "alt" => "Entidades", "label" => "Entidades"],
          ["href" => "#", "icon" => "../../Icons/Beneficiario.png", "alt" => "Beneficiários", "label" => "Beneficiários"],
          ["href" => "#", "icon" => "../../Icons/Documentos.png", "alt" => "Documentação", "label" => "Documentação"],
          ["href" => "#", "icon" => "../../Icons/comunicacao.png", "alt" => "Comunicação", "label" => "Comunicação"],
          ["href" => "#", "icon" => "../../Icons/resultados.svg", "alt" => "Resultados", "label" => "Resultados"]
        ];

        foreach ($menuItems as $item) {
          echo '<a href="' . $item["href"] . '" class="menu-btn">';
          echo '<img src="' . $item["icon"] . '" alt="' . $item["alt"] . '">';
          echo '<span>' . $item["label"] . '</span>';
          echo '</a>';
        }
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
