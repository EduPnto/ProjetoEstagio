<?php
    // Conexão DB
    require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php'; // Adjusted path to db_connect.php
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Definir o charset para UTF-8
    $conn->set_charset("utf8");

    $sql = "SELECT * FROM paises ORDER BY nome ASC";
    $result = $conn->query($sql);

    $paises = [];

    while ($row = $result->fetch_assoc()) {
        $paises[] = [
            'sigla' => $row['Sigla'],
            'nome' => $row['nome']
        ];
    }

    echo json_encode($paises);
?>