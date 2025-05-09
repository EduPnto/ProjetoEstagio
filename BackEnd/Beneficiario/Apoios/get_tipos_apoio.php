<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php'; // Adjusted path to db_connect.php
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    header('Content-Type: application/json');

    if (!isset($_GET['entidade'])) {
        echo json_encode([]);
        exit;
    }

    $entidade = $conn->real_escape_string($_GET['entidade']);

    $query = "
        SELECT a.nome
        FROM apoio a, entidades e
        WHERE e.Sigla = '$entidade'
    ";

    $result = $conn->query($query);

    if ($result) {
        $tipos = [];
        while ($row = $result->fetch_assoc()) {
            $tipos[] = $row['nome'];
        }
        echo json_encode($tipos);
    } else {
        echo json_encode(['error' => $conn->error]);
    }

    $conn->close();
?>