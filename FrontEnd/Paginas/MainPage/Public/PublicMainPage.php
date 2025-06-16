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
    <div class="Top-Img">
        <img src="/ProjetoEstagio/FrontEnd/Imagens/CLIS.png">
    </div>
    <div class="top-bar">
        <div class="logo" style="padding: 5px; border-radius: 5px;">
            <img src="/ProjetoEstagio/FrontEnd/Imagens/CLIS.png">
        </div>
    </div>
    <div class="contact-bar" style="display: center;">
        <ul>
            <li><a href="/ProjetoEstagio/FrontEnd/Paginas/MainPage/Public/PublicMainPage.php" style="border-right: 1px solid;">Início</a></li>
            <li><a style="border-right: 1px solid;">Entidades e Parceiros</a></li>
            <li><a href="#about">Sobre nós</a></li>
        </ul>
    </div>

    <div class="menu-container">
        <?php
            $menuItems = [
                ["href" => "EntidadesPublic/MostrarEntidadePublic.php", "icon" => "../../../Icons/Entidades.png", "alt" => "Entidades", "label" => "Entidades"],
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
    </footer>
    <script>
        window.addEventListener("scroll", function () {
            const navbar = document.querySelector(".contact-bar");
            const logo = document.querySelector(".logo");

            if (window.scrollY > 50) {
                navbar.classList.add("scrolled");
                logo.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
                logo.classList.remove("scrolled");
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
