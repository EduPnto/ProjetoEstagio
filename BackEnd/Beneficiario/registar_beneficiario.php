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

    // Fetch Id_Enti based on Sigla
    $result2 = $conn->query("SELECT Id_Enti FROM entidades WHERE Sigla = '" . $data['apoio_entidade'] . "'");
    $row2 = $result2->fetch_assoc();
    $id_Enti = $row2['Id_Enti'];
    

    // Fetch Id_Apoio based on nome
    $result3 = $conn->query("SELECT Id_Apoio FROM apoio WHERE nome = '" . $data['tipo_apoio'] . "'");
    $row3 = $result3->fetch_assoc();
    $id_apoio = $row3['Id_Apoio'];

    // Fetch Id_Apoio based on nome
    $result4 = $conn->query("SELECT Id_Sigla FROM paises WHERE nome = '" . $data['pais_origem'] . "'");
    $row4 = $result4->fetch_assoc();
    $id_Sigla = $row4['Id_Sigla'];

    $result5 = $conn->query("SELECT Id_Alimentar FROM apoio_alimentar WHERE nome = '" . $data['tipo_alimentar'] . "'");
    $row5 = $result5->fetch_assoc();
    $id_Alimentar = $row5['Id_Alimentar'];
    
    if($data['apoio_saas'] == 1){
        // Fetch Id_Titular based on nome
        $result6 = $conn->query("SELECT MAX(Id_Titular) FROM acompanhamento_saas");
        $row6 = $result6->fetch_assoc();
        $data['titular'] = $row6['Id_Titular'];
    } else {
        $data['titular'] = null;
    }

    // Prepare and bind the insert statement
    $stmt = $conn->prepare("INSERT INTO beneficiarios (Id_Bene,
        nome_Bene, Genero, NIF, NISS, BI, Morada, Contacto, Cod_Postal,
        Data_nasc, Data_Admissao, Data_Saida, Id_Enti, Id_Apoio,
        Id_Alimentar, Incap_Defec, Auto_Depen, Sit_sem_abrigo,
        Sit_Emprego, Imigrante, Id_Sigla, rendi_Capita, SAAS, Id_Titular, Observacao
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("isssssssssssiiiiiiiiidiis",
        $data['Id_Bene'], $data['nome'], $data['genero'], 
        $data['nif'], $data['niss'], $data['bi_cc'],
        $data['morada'], $data['contacto'], $data['cod_postal'], 
        $data['data_nasc'], $data['data_admissao'], $data['data_saida'], 
        $id_Enti, $id_apoio,$id_Alimentar, $data['deficiencia'],
        $data['autonomia'], $data['sem_abrigo'], $data['emprego'],
        $data['imigrante'], $id_Sigla, $data['rendimento_per_Capita'], $data['apoio_saas'], $data['titular'], $data['observacoes']
    );

    if ($stmt->execute()) {
        if($data['apoio_saas'] == 1){
            $stmt2 = $conn->prepare("INSERT INTO acompanhamento_saas (Id_Titular, Id_Bene, nome) VALUES (?, ?, ?)");
            $stmt2->bind_param("iis", $data['titular'], $data['Id_Bene'], $data['SAASTitular']);
            
            if ($stmt2->execute()) {
                echo json_encode(['success' => true, 'message' => 'Beneficiário registado com sucesso!']);
            }
        }
        
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao registar beneficiário: ' . $stmt->error]);
    }

    $stmt->close();
    $stmt2->close();
    $conn->close();
?>
