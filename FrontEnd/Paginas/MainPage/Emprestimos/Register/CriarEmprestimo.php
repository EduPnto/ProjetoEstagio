<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>CLIS - Registo de Beneficiário</title>
    <link rel="stylesheet" href="/ProjetoEstagio/FrontEnd/CSS/Produtos/Adicionar/ProdutosAdd.css">
    <link rel="icon" href="../../../../Imagens/CLIS.png" type="image/png">
    <script src="/ProjetoEstagio/BackEnd/Produtos/Produtos.js"></script>
    <script src="/ProjetoEstagio/BackEnd/MainPageDropdown/DropdownMain.js" defer></script>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/MainPageDropdown/topbar.php'; ?>
    
    <main>
        <h2 style="text-align: center;">Registo Empréstimo</h2>
        <hr style="width: 35%; opacity: 0.5;">
        <form id="RegisterForm" method="POST" enctype="multipart/form-data">
            <div class="form-section titular">
                <h3 style="width: 8%;">Detalhes</h3>
                <div class="grid-2">
                    <div>
                        <label for="nome">Nome Beneficiário</label>
                        <input type="text" name="nome" id="nome" style="width: 95%;" required>
                    </div>
                    <div>
                        <label for="niss">NISS</label>
                        <input type="text" name="niss" id="niss" style="width: 75%;" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                    </div>
                </div>
                <div class="grid-3">
                    <div>
                        <label for="produto">Produto</label>
                        <input style="width: 25%;" type="text" name="produto" id="produto" required>
                    </div>
                </div>
                <hr style="width: 90%; opacity: 0.5;">
                <h3 style="width: 17%;">Data Início/Entrega</h3>
                <div>
                    <label for="data_inicio">Data de Início</label>
                    <input type="date" name="data_inicio" id="data_inicio" style="width: 25%;" required>
                </div>
                <div>
                    <label for="data_entrega">Data de Entrega</label>
                    <input type="date" name="data_entrega" id="data_entrega" style="width: 25%;" required>
                </div>
            </div>
            <button type="submit">Adicionar Produto</button>
        </form>
    </main>
    <footer>
        <p>Contacto: geral@clis.jfe.pt | Tel: 227 344 418</p>
        <div class="redes">
            <a href="https://www.facebook.com/Freguesia.de.Ermesinde/?locale=pt_PT">Facebook</a> | <a href="https://www.instagram.com/jfermesinde/">Instagram</a>
        </div>
        <hr>
        <p style="font-size: 12px;">© 2023 CLIS. Todos os direitos reservados.</p>
    </footer>
    
</body>
</html>
