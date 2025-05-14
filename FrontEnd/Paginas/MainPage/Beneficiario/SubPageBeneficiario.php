<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>CLIS - Beneficiário</title>
    <link rel="stylesheet" href="/ProjetoEstagio/FrontEnd/CSS/Beneficiario/BeneficiarioSubPage.css">
    <script src='/ProjetoEstagio/BackEnd/Beneficiario/Beneficiario.js'></script>
</head>
<body>
    <div class="top-bar">
        <div class="logo" style="background-color: white; display: flex; align-items: center; justify-content: center; padding: 10px; border-radius: 5px;">
            <img src="/ProjetoEstagio/FrontEnd/Imagens/LogotipoJunta.png">
        </div>
        <div class="title">CLIS - Comissão Local de Intervenção Social</div><br>
    </div>

    <main>
        <div class="menu-container">
            <?php
                $menuItems = [
                    ["href" => "/ProjetoEstagio/FrontEnd/Paginas/MainPage/Beneficiario/VerBeneficiarios/VerBeneficiarios.php", "icon" => "../../../Icons/View.png", "alt" => "Ver Beneficiários", "label" => "Ver Beneficiários"],
                    ["href" => "/ProjetoEstagio/FrontEnd/Paginas/MainPage/Beneficiario/Register/Beneficiario.php", "icon" => "../../../Icons/Beneficiario.png", "alt" => "Registar Beneficiários", "label" => "Registar Beneficiários"]
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
        <br>
        <div class="logos">
            <img src="../../../Imagens/logo_adice.png" alt="ADICE">
            <img src="../../../Imagens/LogotipoJunta.png" alt="JFE" style="background-color: white; border-radius: 5px; padding: 5px;">
            <img src="../../../Imagens/rfe.png" alt="Refood">
        </div>
    </footer>
</body>
</html>
