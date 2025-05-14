<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php'; // Adjusted path to db_connect.php
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    header('Content-Type: application/json');

    if (!isset($_GET['alimentar']) && !isset($_GET['entidade'])) {
        echo json_encode([]);
        exit;
    }

    $entidade = $conn->real_escape_string($_GET['entidade']);
    $alimentar = $conn->real_escape_string($_GET['alimentar']);


    $query = "
        SELECT al.nome FROM apoio_alimentar al, apoio a, entidades e
        WHERE al.Id_Apoio = a.Id_Apoio AND a.nome = '$alimentar' AND a.Id_Enti = e.Id_Enti AND e.Sigla = '$entidade'

    ";

    $result = $conn->query($query);

    if ($result) {
        $apoioalimentar = [];
        while ($row = $result->fetch_assoc()) {
            $apoioalimentar[] = ['nome' => $row['nome']];
        }
        echo json_encode($apoioalimentar);
    } else {
        echo json_encode(['error' => $conn->error]);
    }

    $conn->close();
?>