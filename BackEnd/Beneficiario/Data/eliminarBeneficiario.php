<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: DELETE");
    header("Content-Type: application/json");

    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        // Obter o NISS da query string
        if (!isset($_GET['niss'])) {
            http_response_code(400);
            echo json_encode(["mensagem" => "NISS não fornecido."]);
            exit;
        }

        $niss = $_GET['niss'];

        require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php'; // Adjusted path to db_connect.php
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT Id_Bene FROM beneficiarios Where NISS = '$niss'";
        $result = $conn->query($sql);

        if ($result > 0) {
            $beneficiarios =  null;;
            while ($row = $result->fetch_assoc()) {
                $beneficiarios = $row['Id_Bene'];
            }
        }

        // Eliminar o beneficiário
        $stmt3 = $conn->prepare("DELETE FROM beneficiarios WHERE NISS = ?");
        $stmt3->bind_param("s", $niss);

        $stmt2 = $conn->prepare("DELETE FROM composicao_familiar WHERE Id_Bene = ?");
        $stmt2->bind_param("s", $beneficiarios);

        if ($stmt3->execute() || $stmt2->execute()) {
            http_response_code(200);
            echo json_encode(["mensagem" => "Beneficiário eliminado com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["mensagem" => "Erro ao eliminar beneficiário."]);
        }

        $stmt->close();
        $conn->close();
    } else {
        http_response_code(405);
        echo json_encode(["mensagem" => "Método não permitido. Use DELETE."]);
    }
?>