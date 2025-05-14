<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php'; // Adjusted path to db_connect.php
    if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM beneficiarios";
    $result = $conn->query($sql);

    $beneficiarios = [];

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $beneficiarios[] = $row ;
        }
    }

    header('Content-Type: application/json');
    echo json_encode($beneficiarios);
?>
