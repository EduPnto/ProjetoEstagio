<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>CLIS - Página Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/ProjetoEstagio/FrontEnd/CSS/Login/Conta/detalhesConta.css">
    <script src='/ProjetoEstagio/BackEnd/MainPageDropdown/DropdownMain.js'></script>
    <script src='/ProjetoEstagio/BackEnd/Login/Detalhes/VerDetalhesConta.js'></script>
    <link rel="icon" href="/ProjetoEstagio/FrontEnd/Imagens/CLIS.png" type="image/png">
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/MainPageDropdown/topbar.php'; ?>
    
    <main>
        <div class="menu-container">
            <?php
                $userName = isset($_GET['user']) ? urldecode($_GET['user']) : (isset($_SESSION['user']) ? $_SESSION['user'] : '');
            ?>
            <div class="row">
                    <div class="col-md-4 text-center">
                        <?php
                                require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';
                                if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                }
                                $stmt = $conn->prepare("SELECT foto_perfil, nome, email, senha FROM users WHERE nome = ?");
                                $stmt->bind_param("s", $userName);
                                $stmt->execute();
                                $stmt->store_result();
                                $stmt->bind_result($fotoPerfil, $nome, $email, $senha);
                                $stmt->fetch();
                        ?>
                        <?php if ($fotoPerfil): ?>
                                <img src="data:image/jpeg;base64,<?= base64_encode($fotoPerfil) ?>" class="img-thumbnail mb-3" style="width: 180px; height: 180px; object-fit: cover;" alt="Foto de Perfil">
                        <?php else: ?>
                                <img src="/ProjetoEstagio/FrontEnd/Imagens/default-profile.png" class="img-thumbnail mb-3" style="width: 180px; height: 180px; object-fit: cover;" alt="Foto de Perfil">
                        <?php endif; ?>
                        <form action="/ProjetoEstagio/BackEnd/Perfil/alterarFoto.php" method="post" enctype="multipart/form-data">
                                <input type="file" name="nova_foto" accept="image/*" class="form-control mb-2" required>
                                <button type="submit" class="btn btn-primary btn-sm">Alterar Foto de Perfil</button>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <form id="DadosForm" method="post">
                                        <div class="mb-3">
                                                <label class="form-label">Nome: <?= htmlspecialchars($nome) ?></label>
                                        </div>
                                        <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
                                        </div>
                                        <div class="mb-3">
                                                <label for="senha" class="form-label">Senha</label>
                                                <input type="password" class="form-control" id="senha" name="senha" value="<?= htmlspecialchars($senha) ?>" required>
                                        </div>
                                        <button type="submit" class="btn btn-success">Guardar Alterações</button>
                                        <div id="dadosFormMsg" class="mt-2"></div>
                        </form>
                        <script>
                                document.getElementById('DadosForm').addEventListener('submit', function(e) {
                                        e.preventDefault();
                                        const form = e.target;
                                        const formData = new FormData(form);
                                        fetch('/ProjetoEstagio/BackEnd/Perfil/alterarDados.php', {
                                                method: 'POST',
                                                body: formData
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                                const msgDiv = document.getElementById('dadosFormMsg');
                                                if (data.success) {
                                                        msgDiv.innerHTML = '<div class="alert alert-success">Alterações guardadas com sucesso.</div>';
                                                } else {
                                                        msgDiv.innerHTML = '<div class="alert alert-danger">' + (data.error || 'Erro ao guardar alterações.') + '</div>';
                                                }
                                        })
                                        .catch(() => {
                                                document.getElementById('dadosFormMsg').innerHTML = '<div class="alert alert-danger">Erro ao comunicar com o servidor.</div>';
                                        });
                                });
                        </script>
                    </div>
            </div>
            <?php
                $stmt->close();
                $conn->close();
            ?>
        </div>
    </main>
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
