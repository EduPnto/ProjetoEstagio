<?php
    header('Content-Type: application/json');
    $data = json_decode(file_get_contents("php://input"), true);
    require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $get_stmt = $conn->prepare("SELECT Id_Bene AS IdBene FROM beneficiarios WHERE NISS = ? AND nome = ?");
    $get_stmt->bind_param("ss", $data['niss'], $data['nome']);
    $get_stmt->execute();

    $check_stmt = $conn->prepare("SELECT COUNT(*) AS count FROM emprestimos e, beneficiarios b WHERE b.NISS = ? OR b.nome ? ");
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

    
    
    $result6 = $conn->query("SELECT MAX(Id_Emprestimo) as Id FROM emprestimos");
    $row6 = $result6->fetch_assoc();
    $data['Id_Emprestimo'] = $row6['Id'] + 1;


    // Prepare and bind the insert statement
    $stmt = $conn->prepare("INSERT INTO emprestimos (Id_Emprestimo, Id_Bene, Id_Prod, Data_Inicio, Data_Entrega
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
