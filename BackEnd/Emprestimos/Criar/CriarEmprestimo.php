<?php
    header('Content-Type: application/json');
    $data = json_decode(file_get_contents("php://input"), true);
    require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $get_stmt = $conn->prepare("SELECT Id_Bene AS IdBene FROM beneficiarios WHERE NISS = ? AND nome_Bene = ?");
    $get_stmt->bind_param("ss", $data['niss'], $data['nome']);
    $get_stmt->execute();
    $result = $get_stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $idBene = $row['IdBene'];
    } else {
        $idBene = null;
    }

    $check_stmt = $conn->prepare("
        SELECT COUNT(e.Id_Emprestimo) AS count
        FROM emprestimos e
        INNER JOIN beneficiarios b ON e.Id_Bene = b.Id_Bene
        WHERE b.NISS = ? OR b.nome_Bene = ?
    ");
    $check_stmt->bind_param("ss", $data['niss'], $data['nome']);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    $check_row = $check_result->fetch_assoc();

    if ($check_row['count'] > 0) {
        echo json_encode(['success' => false, 'message' => 'Já existe um empréstimo deste beneficiário.']);
        $check_stmt->close();
        $conn->close();
        exit;
    }
    $check_stmt->close();
    
    $result6 = $conn->query("SELECT MAX(Id_Emprestimo) as Id FROM emprestimos");
    $row6 = $result6->fetch_assoc();
    $data['Id_Emprestimo'] = $row6['Id'] + 1;

    $result1 = $conn->query("SELECT quantidade as qtd FROM produtos WHERE Id_Prod = " . $data['produto']);
    $row1 = $result1->fetch_assoc();
    $quantidadeDisp = $row1['qtd'] + 1;

    // Prepare and bind the insert statement
    $stmt = $conn->prepare("INSERT INTO emprestimos (Id_Emprestimo, Id_Prod, Id_Bene, Quantidade, Data_Inicio, Data_Entrega
    ) VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("iiiiss",
        $data['Id_Emprestimo'],
        $data['produto'], $idBene,
        $data['quantidade'], $data['data_inicio'], $data['data_entrega']
    );
    if($data['quantidade'] < $quantidadeDisp) {
        if ($stmt->execute()) {
                $update_stmt = $conn->prepare("
                    UPDATE produtos 
                    SET 
                        Quantidade_emp = Quantidade_emp + ?, 
                        Quantidade = Quantidade - ? 
                    WHERE 
                        Id_Prod = ?
                ");

                $update_stmt->bind_param("iii", $data['quantidade'], $data['quantidade'], $data['produto']);
                $update_stmt->execute();
            echo json_encode(['success' => true, 'message' => 'Empréstimo registado com sucesso!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao registar empréstimo: ' . $stmt->error]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Quantidade insuficiente para o empréstimo.']);
    }
    
    $stmt->close();
    $conn->close();
?>
