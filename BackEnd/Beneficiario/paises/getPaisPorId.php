<?php
    header('Content-Type: application/json');
    require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT Id_Sigla, nome FROM paises";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    $apoios = [];
    while ($row = $result->fetch_assoc()) {
        $apoios[] = [
            'Id_Sigla' => $row['Id_Sigla'], // manter o mesmo nome usado no JS
            'nome' => $row['nome']
        ];
    }

    echo json_encode($apoios);

    $stmt->close();
    $conn->close();
?>