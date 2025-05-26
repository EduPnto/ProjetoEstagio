<?php
  require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>CLIS - Entidades</title>
    <link rel="stylesheet" href="/ProjetoEstagio/FrontEnd/CSS/Entidades/MostrarEntidades.css">
    <script src="/ProjetoEstagio/FrontEnd/Paginas/MainPage/Entidades/MostrarEntidades.js"></script>
    <link rel="icon" href="/ProjetoEstagio/FrontEnd/Imagens/CLIS.png" type="image/png">
</head>
<body>
    <div class="top-bar">
        <div class="logo" style="padding: 5px; border-radius: 5px;">
        <img src="../../../Imagens/CLIS.png">
        </div>
        <div class="user-info">
        <?php
            session_start();
            $username = isset($_SESSION['user']) ? $_SESSION['user'] : null;

            if ($username) {
            $userImg = '../../Icons/user.png';

            $query = "SELECT foto_perfil FROM users WHERE nome = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($profileImage);

            if ($stmt->fetch() && !empty($profileImage)) {
                $userImg = 'data:image/png;base64,' . base64_encode($profileImage);
            }

            $stmt->close();
        ?>
        <div class="user-dropdown">
            <div class="user-trigger" >
            <div>Bem-Vindo,<br><strong><?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></strong></div>
            <img src="<?php echo $userImg; ?>" alt="User" class="user-img" onclick="toggleDropdown()">
            </div>
            <div class="dropdown-menu" id="dropdownMenu">
                <a href="/ProjetoEstagio/FrontEnd/Perfil/detalhesConta.php">Ver Detalhes da Conta</a>
                <a href="/ProjetoEstagio/BackEnd/Login/Logout.php">Logout</a>
            </div>
            </div>
        </div>
        <?php
            } else {
        ?>
            <div class="auth-buttons" style="display: flex; gap: 10px;">
                <a href="/ProjetoEstagio/FrontEnd/Paginas/Login/LoginPage.php" class="btn-login">Login</a>
                <a href="/ProjetoEstagio/FrontEnd/Paginas/Login/Register/RegisterPage.php" class="btn-register">Registar</a>
            </div>
        <?php
            }
        ?>
        </div>
    </div>
    <div class="contact-bar" style="display: center;">
        <ul>
            <li><a href=" " style="border-right: 1px solid;">Início</a></li>
            <li><a href="#contact" style="border-right: 1px solid;">Entidades e Parceiros</a></li>
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
        <div class="logos">
            <img src="../../../Imagens/logo_adice.png" alt="ADICE">
            <img src="../../../Imagens/LogotipoJunta.png" alt="JFE" style="background-color: white; border-radius: 5px; padding: 5px;">
            <img src="../../../Imagens/rfe.png" alt="Refood">
        </div>
    </footer>

    <script>
        let todasEntidades = [];

        function verDetalhesEntidade(Id_Enti) {
            window.location.href = `VerDetalhes/DetalhesEntidade.php?id=${Id_Enti}`;
        }

        function criarCard(entidade) {
            const logoSrc = entidade.logo ? `data:image/png;base64,${entidade.logo}` : '../../../Imagens/default_logo.png';
            
            return `
                <div class="card-custom" data-id="${entidade.Id_Enti}">
                    <div class="card-body">
                        <div class="card-logo">
                            <img src="${entidade.logo ? 'data:image/png;base64,' + entidade.logo : '../../../Imagens/default_logo.png'}" alt="Logo da entidade">
                        </div>
                        <div class="card-info">
                            <div>
                                <div class="card-header">
                                    <strong>${entidade.nome}</strong> (${entidade.Sigla})
                                </div>
                                <div class="card-content">
                                    <p><strong>Contacto:</strong> ${entidade.Contacto}</p>
                                    <p><strong>Email:</strong> ${entidade.email}</p>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button onclick="verDetalhesEntidade('${entidade.Id_Enti}')">Ver Detalhes</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        function renderCards(lista) {
            const container = document.getElementById('cards-container');
            container.innerHTML = "";
            lista.forEach(entidade => {
                container.innerHTML += criarCard(entidade);
            });
        }

        function setupSearch() {
            const input = document.getElementById('search-entidade');
            input.addEventListener('input', () => {
                const termo = input.value.trim().toLowerCase();
                const filtradas = todasEntidades.filter(e =>
                    e.nome.toLowerCase().includes(termo) || e.Sigla.toLowerCase().includes(termo)
                );
                renderCards(filtradas);
            });
        }

        // Carrega os dados
        fetch('/ProjetoEstagio/BackEnd/Entidade/get_entidades.php')
            .then(res => res.json())
            .then(data => {
                todasEntidades = data;
                renderCards(todasEntidades);
                setupSearch();
            })
            .catch(error => {
                console.error('Erro ao carregar entidades:', error);
            });
    </script>
</body>
</html>
