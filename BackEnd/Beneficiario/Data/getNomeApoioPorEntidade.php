<?php
    header('Content-Type: application/json');
    require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php'; // Adjusted path to db_connect.php
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    // Recebe o ID da entidade via GET
    $entidade_id = isset($_GET['idEntidade']);
    $Id_Apoio = isset($_GET['idApoio']);

    if ($entidade_id === 0) {
        http_response_code(400);
        echo json_encode(['error' => 'ID da entidade não informado']);
        exit;
    }

    // Consulta SQL
    $sql = "SELECT * FROM apoio WHERE Id_Enti = ? AND Id_Apoio = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $entidade_id , $Id_Apoio);
    $stmt->execute();
    $result = $stmt->get_result();

    $apoios = [];
    while ($row = $result->fetch_assoc()) {
        $apoios[] = [
            'Id_Apoio' =>$row['Id_Apoio'], 
            'nome' => $row['nome']
        ];
    }

    echo json_encode($apoios);

    $stmt->close();
    $conn->close();
?>