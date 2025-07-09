<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';

    if (!$conn) {
        echo json_encode(['success' => false, 'message' => 'Erro na conexão com a base de dados.']);
        exit;
    }

    $nome = $_POST['nome'] ?? '';
    $categoria = $_POST['categoria'] ?? '';
    $quantidade = $_POST['quantidade'] ?? '';
    $entidade = $_POST['apoio_entidade'] ?? '';
    $foto_prod = null;
    if (isset($_FILES['foto_produto']) && $_FILES['foto_produto']['error'] === UPLOAD_ERR_OK) {
        $foto_prod = file_get_contents($_FILES['foto_produto']['tmp_name']);
    }
    // Verifica se já existe um produto com o mesmo nome, categoria e entidade
    $checkStmt = $conn->prepare("SELECT COUNT(*) as count FROM produtos WHERE nome_Prod = ? AND Id_Category = ? AND Id_Enti = ?");
    $checkStmt->bind_param("sii", $nome, $categoria, $entidade);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    $checkRow = $checkResult->fetch_assoc();

    if ($checkRow['count'] > 0) {
        echo json_encode(['success' => false, 'message' => 'Produto já cadastrado com esse nome, categoria e entidade.']);
        $checkStmt->close();
        $conn->close();
        exit;
    }
    
    $checkStmt->close();
    $result = $conn->query("SELECT MAX(Id_Prod) AS max_id FROM produtos");
    $row = $result->fetch_assoc();
    $ID = $row['max_id'] + 1;

    $continuidade = 1;

    $stmt = $conn->prepare("INSERT INTO produtos (Id_Prod, Id_Category, Id_Enti, nome_Prod, Quantidade, Image_Prod, Continuidade) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiisisi", $ID, $categoria, $entidade, $nome, $quantidade, $foto_prod, $continuidade);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Product registered successfully.']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Database error.']);
    }

    $stmt->close();
    $conn->close();
?>