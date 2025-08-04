<?php
    header('Content-Type: application/json');

    $data = json_decode(file_get_contents("php://input"), true);
    $produtos = [];

    if (!isset($data['categoria'])) {
        echo json_encode([]);
        exit;
    }

    require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';

    if ($conn->connect_error) {
        echo json_encode([]);
        exit;
    }

    $stmt = $conn->prepare("SELECT Id_Prod, nome_Prod FROM produtos WHERE Id_Category = ?");
    $stmt->bind_param("i", $data['categoria']);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $produtos[] = $row;
    }

    $stmt->close();
    $conn->close();

    echo json_encode($produtos);
?>