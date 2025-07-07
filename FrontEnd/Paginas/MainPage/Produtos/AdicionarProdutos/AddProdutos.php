<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>CLIS - Registo de Beneficiário</title>
    <link rel="stylesheet" href="/ProjetoEstagio/FrontEnd/CSS/Produtos/Adicionar/ProdutosAdd.css">
    <link rel="icon" href="../../../../Imagens/CLIS.png" type="image/png">
    
    <script src="/ProjetoEstagio/BackEnd/MainPageDropdown/DropdownMain.js" defer></script>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/MainPageDropdown/topbar.php'; ?>
    
    <main>
        
        <h2>Registo de Produto</h2>

        <div class="form-section titular">
            <h3 style="width: 8%;">Detalhes</h3>
            <?php
                $data = json_decode(file_get_contents("php://input"), true);
                require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Buscar categorias da base de dados
                $categorias = [];
                $sql = "SELECT Id_Category, nome FROM categoria";
                $result = $conn->query($sql);
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $categorias[] = $row;
                    }
                }
                $conn->close();
            ?>
            <div class="grid-2">
                <div>
                    <label for="nome">Nome do Produto</label>
                    <input type="text" name="nome" id="nome" required>
                </div>
                <div>
                    <label for="categoria">Categoria</label>
                    <select style="width: 60%;" name="categoria" id="categoria" required>
                        <option value="">Selecione a categoria</option>
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?= htmlspecialchars($cat['Id_Category']) ?>">
                                <?= htmlspecialchars($cat['nome']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="grid-3">
                <div>
                    <label for="quantidade">Quantidade</label>
                    <input style="width: 25%;" type="text" name="quantidade" id="quantidade" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
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
            <h3 style="width: 11%;">Fornecedor</h3>
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
        <script>
            function previewImage(event) {
                const input = event.target;
                const preview = document.getElementById('foto_perfil_preview');
                if (!preview) {
                    console.error("Preview image element not found.");
                    return;
                }
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    preview.src = '#';
                    preview.style.display = 'none';
                }
            }
        </script>
           
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
