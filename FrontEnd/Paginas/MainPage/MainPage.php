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
      if (session_status() === PHP_SESSION_NONE) {
        session_start();
      }

      if (isset($_SESSION['user'])) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/Database/db_connect.php';
        $userName = $_SESSION['user'];
        $stmt = $conn->prepare("SELECT Id_Enti FROM users WHERE nome = ?");
        $stmt->bind_param("s", $userName);
        $stmt->execute();
        $stmt->bind_result($idEnti);
        $stmt->fetch();
        $stmt->close();

        if ($idEnti == 0) {
          $menuItems = [
            ["href" => "Entidades/MostrarEntidades.php", "icon" => "../../Icons/Entidades.png", "alt" => "Entidades", "label" => "Entidades"],
            ["href" => "Beneficiario/SubPageBeneficiario.php", "icon" => "../../Icons/Beneficiario.png", "alt" => "Beneficiários", "label" => "Beneficiários"],
            ["href" => "Produtos/ProdutosMenu.php", "icon" => "../../Icons/Produtos.png", "alt" => "Produtos", "label" => "Produtos"],
            ["href" => "Emprestimos/EmprestimosMenu.php", "icon" => "../../Icons/Emprestimos.png", "alt" => "Empréstimos", "label" => "Empréstimos"],
            ["href" => "documentacao.php", "icon" => "../../Icons/Documentos.png", "alt" => "Documentação", "label" => "Documentação"],
            ["href" => "comunicacao.php", "icon" => "../../Icons/comunicacao.png", "alt" => "Ajuda e Suporte", "label" => "Ajuda e Suporte"]
          ];
        } else {
          $menuItems = [
            ["href" => "Entidades/Mostrar/MostrarEntidades.php", "icon" => "../../Icons/Entidades.png", "alt" => "Entidades", "label" => "Entidades"],
            ["href" => "Beneficiario/SubPageBeneficiario.php", "icon" => "../../Icons/Beneficiario.png", "alt" => "Beneficiários", "label" => "Beneficiários"],
            ["href" => "Produtos/ProdutosMenu.php", "icon" => "../../Icons/Produtos.png", "alt" => "Produtos", "label" => "Produtos"],
            ["href" => "Emprestimos/EmprestimosMenu.php", "icon" => "../../Icons/Emprestimos.png", "alt" => "Empréstimos", "label" => "Empréstimos"],
            ["href" => "documentacao.php", "icon" => "../../Icons/Documentos.png", "alt" => "Documentação", "label" => "Documentação"],
            ["href" => "comunicacao.php", "icon" => "../../Icons/comunicacao.png", "alt" => "Ajuda e Suporte", "label" => "Ajuda e Suporte"]
          ];
        }

        foreach ($menuItems as $item) {
          echo '<a href="' . $item["href"] . '" class="menu-btn"' . (empty($item["href"]) ? ' style="pointer-events:none;opacity:0.5;"' : '') . '>';
          echo '<img src="' . $item["icon"] . '" alt="' . $item["alt"] . '">';
          echo '<span>' . $item["label"] . '</span>';
          echo '</a>';
        }
      } else {
        $menuItems = [
          ["href" => "Entidades/Mostrar/MostrarEntidades.php", "icon" => "../../Icons/Entidades.png", "alt" => "Entidades", "label" => "Entidades"]
        ];

        foreach ($menuItems as $item) {
          echo '<a href="' . $item["href"] . '" class="menu-btn"' . (empty($item["href"]) ? ' style="pointer-events:none;opacity:0.5;"' : '') . '>';
          echo '<img src="' . $item["icon"] . '" alt="' . $item["alt"] . '">';
          echo '<span>' . $item["label"] . '</span>';
          echo '</a>';
        }
      }
    ?>
    <hr style="width: 90%; margin: 20px auto; border-top: 2px solid black; opacity: 15%;">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/MainPageDropdown/SubContainerPres.php'; ?>
  </div>

  <footer>
    <p>Contacto: geral@clis.jfe.pt | Tel: 227 344 418</p>
    <div class="redes">
      <a href="https://www.facebook.com/Freguesia.de.Ermesinde/?locale=pt_PT">Facebook</a> | <a href="https://www.instagram.com/jfermesinde/">Instagram</a>
    </div>
    <hr>
    <p style="font-size: 12px;">© 2023 CLIS. Todos os direitos reservados.</p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
