<?php
    header('Content-Type: application/json');
    require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php'; // Adjusted path to db_connect.php
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $niss = $_GET['NISS'] ?? null;
    if (empty($niss)) {
        echo json_encode(['erro' => 'NISS não informado']);
        exit;
    }

    $sql = "SELECT * FROM beneficiarios WHERE NISS = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }
    
    $stmt->bind_param("s", $niss);

    if ($stmt->execute()) {
        $beneficiarios = [];
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $beneficiarios[] = $row;
        }
        echo json_encode($beneficiarios);
    } else {
        echo json_encode(['erro' => 'Nenhum beneficiário encontrado']);
    }
?>
