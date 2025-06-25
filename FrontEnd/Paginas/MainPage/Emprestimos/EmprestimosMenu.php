<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>CLIS - Emprestimos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/ProjetoEstagio/FrontEnd/CSS/Beneficiario/BeneficiarioSubPage.css">
    <script src="/ProjetoEstagio/BackEnd/MainPageDropdown/DropdownMain.js" defer></script>
    <link rel="icon" href="/ProjetoEstagio/FrontEnd/Imagens/CLIS.png" type="image/png">
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/MainPageDropdown/topbar.php'; ?>

    <main>
        <div class="menu-container">
            <?php
                $menuItems = [
                    ["href" => "VerEmprestimos/VerEmprestimos.php", "icon" => "../../../Icons/produto.png", "alt" => "Ver Emprestimos", "label" => "Ver Emprestimos"],
                    ["href" => "Register/CriarEmprestimo.php", "icon" => "../../../Icons/View.png", "alt" => "Registar Emprestimos", "label" => "Registar Emprestimos"]
                ];

                foreach ($menuItems as $item) {
                    echo '<a href="' . $item["href"] . '" class="menu-btn">';
                    echo '<img src="' . $item["icon"] . '" alt="' . $item["alt"] . '">';
                    echo '<span>' . $item["label"] . '</span>';
                    echo '</a>';
                }
            ?>
        </div>
    </main>

    <footer>
        <p>Contacto: geral@clis.jfe.pt | Tel: 227 344 418</p>
        <div class="redes">
            <a href="https://www.facebook.com/Freguesia.de.Ermesinde/?locale=pt_PT">Facebook</a> | <a href="https://www.instagram.com/jfermesinde/">Instagram</a>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
