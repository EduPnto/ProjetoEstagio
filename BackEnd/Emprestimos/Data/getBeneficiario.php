<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';

    header('Content-Type: application/json');

    $data = json_decode(file_get_contents("php://input"), true);
    $niss = $data['niss'] ?? '';

    $response = ['nome' => null];

    if (!empty($niss)) {
        $stmt = $conn->prepare("SELECT nome_Bene FROM beneficiarios WHERE NISS = ?");
        $stmt->bind_param("s", $niss);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            $response['nome'] = $row['nome_Bene'];
        }

        $stmt->close();
    }

    $conn->close();
    echo json_encode($response);
?>