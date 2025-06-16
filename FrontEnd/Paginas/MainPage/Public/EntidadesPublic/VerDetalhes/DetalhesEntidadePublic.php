<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>CLIS - Entidades</title>
    <link rel="stylesheet" href="/ProjetoEstagio/FrontEnd/CSS/Entidades/Detalhes/DetalhesEntidades.css">
    <script src="/ProjetoEstagio/BackEnd/MainPageDropdown/DropdownMain.js" defer></script>
    <script src="/ProjetoEstagio/BackEnd/Entidade/EntidadesInfo.js" defer></script>
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
         <div class="container">
            <div class="header">
                <div class="text-info">
                    <p><strong>Nome Entidade:</strong> <span id="nome_entidade"></span></p>
                    <br>
                    <p><strong>Email:</strong> <span id="email"></span></p>
                    <p><strong>Contacto:</strong> <span id="contacto"></span></p>
                </div>
                <div class="logotipo" id="logo_entidade"></div>
            </div>

            <hr>

            <div class="presidente-section">
                <div class="foto-pres" id="foto_presidente"></div>
                <div class="texto-pres">
                    <p><span id="frase_pres"></span></p>
                    <p class="nome-presidente" id="nome_presidente"></p>
                </div>
            </div>

            <hr>

            <div class="apoios">
                <h3>Apoios:</h3>
                <ul id="apoios-lista">
                </ul>
            </div>
        </div>
    </main>

    <footer>
        <p>Contacto: geral@clis.jfe.pt | Tel: 227 344 418</p>
        <div class="redes">
            <a href="https://www.facebook.com/Freguesia.de.Ermesinde/?locale=pt_PT">Facebook</a> | <a href="https://www.instagram.com/jfermesinde/">Instagram</a>
        </div>
    </footer>
</body>
</html>
