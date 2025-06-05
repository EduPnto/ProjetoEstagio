<?php
    header('Content-Type: application/json');
    require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php'; // Adjusted path to db_connect.php
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    // Recebe o ID da entidade via GET
    if (!isset($_GET['idTitular']) || !is_numeric($_GET['idTitular'])) {
        http_response_code(400);
        echo json_encode(['error' => 'ID da entidade não informado ou inválido']);
        exit;
    }
    $id_Titular = (int)$_GET['idTitular'];

    // Consulta SQL
    $sql = "SELECT nome FROM acompanhamento_saas WHERE Id_Titular = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_Titular);
    $stmt->execute();
    $result = $stmt->get_result();
    
    echo json_encode($result->fetch_assoc());

    $stmt->close();
    $conn->close();
?>