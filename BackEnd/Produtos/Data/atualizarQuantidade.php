<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';
    header('Content-Type: application/json');

    if ($conn->connect_error) {
        http_response_code(500);
        echo json_encode(['error' => 'Erro na conexão com o banco de dados.']);
        exit;
    }

    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['nome']) || !isset($data['quantidade'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Parâmetros inválidos.']);
        exit;
    }

    $stmt = $conn->prepare("UPDATE produtos SET quantidade = ? WHERE nome_Prod = ?");
    $stmt->bind_param("is", $data['quantidade'], $data['nome']);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Erro ao atualizar a quantidade.']);
    }

    $stmt->close();
    $conn->close();
?>