<?php
    session_start();
    require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';

    if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
    }

    // Supondo que o Id_Enti do usuário logado está salvo na sessão
    $id_enti = isset($_SESSION['Id_Enti']) ? intval($_SESSION['Id_Enti']) : 0;

    $sql = "SELECT * FROM beneficiarios WHERE Id_Enti = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_enti);
    $stmt->execute();
    $result = $stmt->get_result();

    $beneficiarios = [];

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $beneficiarios[] = $row ;
        }
    }

    header('Content-Type: application/json');
    echo json_encode($beneficiarios);
?>
