<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>CLIS - Entidades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/ProjetoEstagio/FrontEnd/CSS/Entidades/MostrarEntidades.css">
    <script src="/ProjetoEstagio/BackEnd/Public/Entidade/MostrarEntidadesPublic.js"></script>
    <script src="/ProjetoEstagio/BackEnd/MainPageDropdown/DropdownMain.js"></script>
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
            <li><a href="#about">Sobre nós</a></li>
        </ul>
    </div>

    <main>
        <div class="menu-container">
            <input type="text" id="search-entidade" placeholder="Pesquisar por nome ou sigla..." style="width: 100%; padding: 10px; margin-bottom: 20px; font-size: 16px; border-radius: 5px; border: 1px solid #ccc;">
            <div id="cards-container"></div>
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
