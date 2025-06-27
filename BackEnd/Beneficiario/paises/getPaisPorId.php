<?php
    header('Content-Type: application/json');
    require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php'; // Adjusted path to db_connect.php
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    // Recebe o ID da entidade via GET
    $id_pais = isset($_GET['id']);

    if ($id_pais === 0) {
        http_response_code(400);
        echo json_encode(['error' => 'ID da entidade não informado']);
        exit;
    }

    // Consulta SQL
    $sql = "SELECT * FROM paises WHERE Id_Sigla = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_pais);
    $stmt->execute();
    $result = $stmt->get_result();

    $apoios = [];
    while ($row = $result->fetch_assoc()) {
        $apoios[] = $row;
    }

    echo json_encode($apoios);

    $stmt->close();
    $conn->close();
?>