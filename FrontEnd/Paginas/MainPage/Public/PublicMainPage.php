<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <title>CLIS - Página Principal</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="/ProjetoEstagio/FrontEnd/CSS/mainPage.css">
        <link rel="icon" href="/ProjetoEstagio/FrontEnd/Imagens/CLIS.png" type="image/png">
    </head>
    <body>
        <div class="top-bar">
            <div class="logo" style="padding: 5px; border-radius: 5px;">
                <img src="/ProjetoEstagio/FrontEnd/Imagens/CLIS.png">
            </div>
        </div>
        <div class="contact-bar" style="display: center;">
            <ul>
                <li><a href="/ProjetoEstagio/FrontEnd/Paginas/MainPage/Public/PublicMainPage.php" style="border-right: 1px solid;">Início</a></li>
                <li><a style="border-right: 1px solid;">Entidades e Parceiros</a></li>
                
            </ul>
        </div>

        <div class="menu-container">
            <?php
                $menuItems = [
                    ["href" => "EntidadesPublic/MostrarEntidadePublic.php", "icon" => "../../../Icons/Entidades.png", "alt" => "Entidades", "label" => "Entidades"],
                    ["href" => "https://www.jf-ermesinde.pt/pages/589", "icon" => "../../../Icons/Documentos.png", "alt" => "Documentação", "label" => "Documentação"]
                ];

                foreach ($menuItems as $item) {
                    echo '<a href="' . $item["href"] . '" class="menu-btn">';
                    echo '<img src="' . $item["icon"] . '" alt="' . $item["alt"] . '">';
                    echo '<span>' . $item["label"] . '</span>';
                    echo '</a>';
                }
            ?>
            <hr style="width: 90%; margin: 20px auto; border-top: 2px solid black; opacity: 15%;">
            <div style="text-align: center;">
                <h2 style="color: white; border-radius: 5px; background-color: #5CC535; padding: 5px 10px; width: 250px; min-height: 40px; display: inline-block;">Presidentes</h2>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/MainPageDropdown/SubContainerPres.php'; ?>
            </div>
        </div>
        <footer>
            <p>Contacto: geral@clis.jfe.pt | Tel: 227 344 418</p>
            <div class="redes">
                <a href="https://www.facebook.com/Freguesia.de.Ermesinde/?locale=pt_PT">Facebook</a> | <a href="https://www.instagram.com/jfermesinde/">Instagram</a>
            </div>
            <hr>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
