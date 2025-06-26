<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>CLIS - Registo de Beneficiário</title>
    <link rel="stylesheet" href="../../../../CSS/Beneficiario/Register/BeneficiarioRegister.css">
    <link rel="icon" href="../../../../Imagens/CLIS.png" type="image/png">
    <script src='/ProjetoEstagio/BackEnd/Beneficiario/Beneficiario.js' defer></script>
    <script src="/ProjetoEstagio/BackEnd/MainPageDropdown/DropdownMain.js" defer></script>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/MainPageDropdown/topbar.php'; ?>
    
    <main>
        
        <h2>Registo de Produto</h2>

        <div class="form-section titular">
            <h3 style="width: 7%;">Detalhes</h3>
            <div class="grid-2">
                <div><label for="nome">Nome do Produto</label><input type="text" name="nome" id="nome" required></div>
            </div>
            <div class="grid-3">
                <div>
                    <label for="quantidade">Quantidade</label>
                    <input type="text" name="quantidade" id="quantidade" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                </div>
            </div>
            <label for="foto_perfil">Imagem do Produto:</label>
            <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*" onchange="previewImage(event)">
            <br>
            <img id="foto_perfil_preview" src="#" alt="Pré-visualização do Produto" style="display:none; max-width:150px; max-height:150px; margin-top:10px;"/>
            <br>
        </div>
        <hr>
        <div class="form-section apoio">
            <h3 style="width: 10%;">Fornecedor</h3>
            <div class="grid-4">
                <div style="width: 60%;">
                    <label for="apoio_entidade">Entidade</label>
                    <select id="apoio_entidade" name="apoio_entidade" required></select>
                </div>
            </div>
        </div>
        <form method="POST">
            <button type="submit" id="btn_criar">Adicionar Produto</button>
        </form>
           
    </main>

    <footer>
        <p>Contacto: geral@clis.jfe.pt | Tel: 227 344 418</p>
        <div class="redes">
            <a href="https://www.facebook.com/Freguesia.de.Ermesinde/?locale=pt_PT">Facebook</a> | <a href="https://www.instagram.com/jfermesinde/">Instagram</a>
        </div>
    </footer>
    
</body>
</html>
