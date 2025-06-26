<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';

    if (!$conn) {
        echo json_encode(['success' => false, 'message' => 'Erro na conexão com a base de dados.']);
        exit;
    }

    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $entidade = $_POST['entidade'] ?? '';
    $foto_perfil = null;

    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
        $foto_perfil = file_get_contents($_FILES['foto_perfil']['tmp_name']);
    }

    $result = $conn->query("SELECT MAX(ID) AS max_id FROM users");
    $row = $result->fetch_assoc();
    $ID = $row['max_id'] + 1;

    $hashedSenha = password_hash($senha, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (ID, Id_Enti, nome, senha, email, foto_perfil) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iisssb", $ID, $entidade, $nome, $hashedSenha, $email, $foto_perfil);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Account registered successfully.']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Database error.']);
    }

    $stmt->close();
    $conn->close();
?>
