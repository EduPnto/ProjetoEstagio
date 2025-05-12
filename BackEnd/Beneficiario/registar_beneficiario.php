<?php
    header('Content-Type: application/json');
    $data = json_decode(file_get_contents("php://input"), true);

    require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check for duplicates
    $check_stmt = $conn->prepare("SELECT COUNT(*) AS count FROM beneficiarios WHERE NISS = ? OR NIF = ? OR BI = ?");
    $check_stmt->bind_param("sss", $data['niss'], $data['nif'], $data['bi_cc']);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    $check_row = $check_result->fetch_assoc();

    if ($check_row['count'] > 0) {
        echo json_encode(['success' => false, 'message' => 'Já existe um beneficiário com o mesmo NISS, NIF ou BI.']);
        $check_stmt->close();
        $conn->close();
        exit;
    }
    $check_stmt->close();

    // Fetch the maximum Id_Bene and increment it by 1
    $result = $conn->query("SELECT MAX(Id_Bene) AS max_id FROM beneficiarios");
    $row = $result->fetch_assoc();
    $new_id_bene = $row['max_id'] + 1;


    $stmt = $conn->prepare("INSERT INTO beneficiarios (Id_Bene,
        nome_Bene, Genero, NIF, NISS, BI, Morada, Contacto, Cod_Postal,
        Data_nasc, Data_Admissao, Data_Saida,
        Incap_Defec, Auto_Depen, Sit_sem_abrigo,
        Sit_Emprego, Imigrante, Id_Sigla, Observacao
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("issssssssssiiiiiiss",
        $new_id_bene, $data['nome'], $data['genero'], 
        $data['nif'], $data['niss'], $data['bi_cc'],
        $data['morada'], $data['contacto'], $data['cod_postal'], 
        $data['data_nasc'], $data['data_admissao'], $data['data_saida'], $data['deficiencia'],
        $data['autonomia'], $data['sem_abrigo'], $data['emprego'],
        $data['imigrante'], $data['id_sigla'], $data['observacoes']
    );

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Beneficiário registado com sucesso!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao registar beneficiário: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
?>
