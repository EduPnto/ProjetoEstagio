<?php
header('Content-Type: application/json');

require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';

if (!$conn || $conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Erro na conexão com o banco de dados: ' . $conn->connect_error]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $niss = isset($_POST['agregado_niss']) && is_array($_POST['agregado_niss']) ? $_POST['agregado_niss'] : [];
    $datas = isset($_POST['agregado_data']) && is_array($_POST['agregado_data']) ? $_POST['agregado_data'] : [];
    $generos = isset($_POST['agregado_genero']) && is_array($_POST['agregado_genero']) ? $_POST['agregado_genero'] : [];

    if (count($niss) !== count($datas) || count($niss) !== count($generos)) {
        echo json_encode(['success' => false, 'message' => 'Dados inconsistentes.']);
        exit;
    }

    $inserted_familiares_ids = [];    

    for ($i = 0; $i < count($niss); $i++) {
        // Insere o familiar com o ID_Familiar atual
        $stmt = $conn->prepare("INSERT INTO `composicao_familiar` (`NISS`, `Data_nasc`, `Genero`, `Id_Bene`) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sssi", $niss[$i], $datas[$i], $generos[$i], $new_id_bene);
            if ($stmt->execute()) {
                $inserted_familiares_ids[] = $conn->insert_id; // Pega o ID do familiar inserido
            } else {
                echo json_encode(['success' => false, 'message' => 'Erro ao executar inserção: ' . $stmt->error]);
                $stmt->close();
                $conn->close();
                exit;
            }
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao preparar inserção: ' . $conn->error]);
            $conn->close();
            exit;
        }
    }
    echo json_encode(['success' => true, 'message' => 'Família inserida com sucesso!', 'id_familiar' => $id_familiar]);
} else {
    echo json_encode(['success' => false, 'message' => 'Método inválido.']);
}

$conn->close();
?>
