<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>CLIS - Página Principal</title>
    <link rel="stylesheet" href="/ProjetoEstagio/FrontEnd/CSS/mainPage.css">
</head>
<body>
    <div class="top-bar">
        <div class="logo" style="background-color: white; display: flex; align-items: center; justify-content: center; padding: 10px;">
            <img src="../Imagens/LogotipoJunta.png">
        </div>
        <div class="title">CLIS - Comissão Local de Intervenção Social</div>
        <div class="user-info">
            <?php $username = "Refood"; ?>
            <div>Bem-Vindo,<br><strong><?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></strong></div>
            <img src="../Imagens/default-user.png" alt="User" class="user-img">
        </div>
    </div>
    <div class="menu-container">
        <?php
        $menuItems = [
            ["href" => "entidades.php", "icon" => "../Icons/Entidades.png", "alt" => "Entidades", "label" => "Entidades"],
            ["href" => "servicos.php", "icon" => "../Icons/servicos.png", "alt" => "Serviços", "label" => "Serviços"],
            ["href" => "../Paginas/Beneficiario/Beneficiario.php", "icon" => "../Icons/Beneficiario.png", "alt" => "Beneficiários", "label" => "Beneficiários"],
            ["href" => "documentacao.php", "icon" => "../Icons/Documentos.png", "alt" => "Documentação", "label" => "Documentação"],
            ["href" => "comunicacao.php", "icon" => "../Icons/comunicacao.png", "alt" => "Comunicação", "label" => "Comunicação"],
            ["href" => "resultados.php", "icon" => "../Icons/resultados.svg", "alt" => "Resultados", "label" => "Resultados"]
        ];

        foreach ($menuItems as $item) {
            echo '<a href="' . $item["href"] . '" class="menu-btn">';
            echo '<img src="' . $item["icon"] . '" alt="' . $item["alt"] . '">';
            echo '<span>' . $item["label"] . '</span>';
            echo '</a>';
        }
        ?>
    </div>
</body>
</html>
