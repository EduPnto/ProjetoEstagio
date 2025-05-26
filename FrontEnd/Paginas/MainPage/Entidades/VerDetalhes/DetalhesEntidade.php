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
    <link rel="stylesheet" href="/ProjetoEstagio/FrontEnd/CSS/Entidades/Detalhes/DetalhesEntidades.css">
</head>
<body>
    <div class="top-bar">
        <div class="logotipo" style="padding: 10px; border-radius: 5px;">
            <img src="../../../../Imagens/CLIS.png">
        </div>
        <div class="user-info">
        <?php
            session_start();
            $username = $_SESSION['user'] ?? null;

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
            <div class="user-trigger">
                <div>Bem-Vindo,<br><strong><?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></strong></div>
                <img src="<?php echo $userImg; ?>" alt="User" class="user-img" onclick="toggleDropdown()">
            </div>
            <div class="dropdown-menu" id="dropdownMenu">
                <a href="/ProjetoEstagio/FrontEnd/Perfil/detalhesConta.php">Ver Detalhes da Conta</a>
                <a href="/ProjetoEstagio/BackEnd/Login/Logout.php">Logout</a>
            </div>
        </div>
        <?php
            } else {
        ?>
        <div class="auth-buttons" style="display: flex; gap: 10px;">
            <a href="/ProjetoEstagio/FrontEnd/Paginas/Login/LoginPage.php" class="btn-login">Login</a>
            <a href="/ProjetoEstagio/FrontEnd/Paginas/Login/Register/RegisterPage.php" class="btn-register">Registar</a>
        </div>
        <?php } ?>
        </div>
    </div>

    <div class="contact-bar">
        <ul>
            <li><a href="/ProjetoEstagio/FrontEnd/Paginas/MainPage/MainPage.php">Início</a></li>
            <li><a href="#contact">Entidades e Parceiros</a></li>
            <li><a href="#about">Sobre nós</a></li>
        </ul>
    </div>

    <main>
         <div class="container">
            <div class="header">
            <div class="text-info">
                <p><strong>Nome Entidade:</strong> <span id="nome_entidade">####</span></p>
                <p><strong>Email:</strong> <span id="email">####</span></p>
                <p><strong>Contacto:</strong> <span id="contacto">####</span></p>
            </div>
            <div class="logo" id="logo_entidade"></div>
            </div>

            <hr>

            <div class="presidente-section">
            <div class="foto-pres" id="foto_presidente"></div>
            <div class="texto-pres">
                <p><span id="frase_pres">#### (frase_pres)</span></p>
                <p class="nome-presidente" id="nome_presidente">#######<br><small>(Nome Presidente)</small></p>
            </div>
            </div>

            <hr>

            <div class="apoios">
            <h3>Apoios:</h3>
            <ul id="apoios-lista"></ul>
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
