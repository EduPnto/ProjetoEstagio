<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';
    
    header('Content-Type: application/json');

    $nomeProduto = isset($_POST['nome']) ? trim($_POST['nome']) : '';

    if (empty($nomeProduto)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Nome do produto inválido.']);
        exit;
    }

    $sql = "UPDATE produtos SET Continuidade = 0 WHERE nome_Prod = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('s', $nomeProduto);
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Continuidade do produto cancelada com sucesso.']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Erro ao cancelar a continuidade do produto.']);
        }
        $stmt->close();
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Erro na preparação da consulta.']);
    }

    $conn->close();
?>
