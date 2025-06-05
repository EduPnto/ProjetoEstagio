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
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/MainPageDropdown/topbar.php'; ?>

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
        <div class="logos">
            <img src="../../../../Imagens/logo_adice.png" alt="ADICE">
            <img src="../../../../Imagens/LogotipoJunta.png" alt="JFE" style="background-color: white; border-radius: 5px; padding: 5px;">
            <img src="../../../../Imagens/rfe.png" alt="Refood">
        </div>
    </footer>
</body>
</html>
