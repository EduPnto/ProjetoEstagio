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
        SELECT a.nome, a.Id_Apoio
        FROM apoio a, entidades e
        WHERE a.Id_Enti = e.Id_Enti AND e.Id_Enti = '$entidade'
    ";

    $result = $conn->query($query);

    if ($result) {
        $tipos = [];
        while ($row = $result->fetch_assoc()) {
            $tipos[] = [
                'nome' => $row['nome'],
                'id' => $row['Id_Apoio']               
            ];
        }
        echo json_encode($tipos);
    } else {
        echo json_encode(['error' => $conn->error]);
    }

    $conn->close();
?>