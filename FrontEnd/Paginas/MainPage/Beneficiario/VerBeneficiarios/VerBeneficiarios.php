<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>CLIS - Beneficiário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/ProjetoEstagio/FrontEnd/CSS/Beneficiario/VerBeneficiarios/VerBeneficiarios.css">
    <script src="/ProjetoEstagio/BackEnd/MainPageDropdown/DropdownMain.js" defer></script>
    <link rel="icon" href="/ProjetoEstagio/FrontEnd/Imagens/CLIS.png" type="image/png">
    <script src="/ProjetoEstagio/BackEnd/Beneficiario/VerBeneficiarios.js"></script>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/MainPageDropdown/topbar.php'; ?>

    <main>
        <div class="menu-container">
            <input type="text" id="search-niss" placeholder="Pesquisar por NISS..." style="width: 100%; padding: 10px; margin-bottom: 20px; font-size: 16px; border-radius: 5px; border: 1px solid #ccc;">
            <?php
                $idEnti = isset($_SESSION['Id_Enti']) ? $_SESSION['Id_Enti'] : null;
            ?>
            <div id="cards-container" data-id-enti="<?php echo htmlspecialchars($idEnti); ?>"></div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const idEnti = document.getElementById('cards-container').dataset.idEnti;
                    // Supondo que você busca os beneficiários via AJAX
                    fetch(`/ProjetoEstagio/BackEnd/Beneficiario/getBeneficiarios.php?id_enti=${idEnti}`)
                        .then(response => response.json())
                        .then(data => {
                            const container = document.getElementById('cards-container');
                            container.innerHTML = '';
                            data.forEach(beneficiario => {
                                // Renderize os cards conforme necessário
                                const card = document.createElement('div');
                                card.className = 'card mb-3';
                                card.innerHTML = `
                                    <div class="card-body">
                                        <h5 class="card-title">${beneficiario.nome}</h5>
                                        <p class="card-text">NISS: ${beneficiario.niss}</p>
                                    </div>
                                `;
                                container.appendChild(card);
                            });
                        });
                });
            </script>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
