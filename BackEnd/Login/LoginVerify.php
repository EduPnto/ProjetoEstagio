<?php
    session_start();
    require('../../../BackEnd/DataBase/db_connect.php');

    if (!$conn) {
        echo json_encode(['success' => false, 'message' => 'Erro na conexão com a base de dados.']);
        exit;
    }

    // Receber os dados do POST
    $name = $_POST['name'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($name) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Nome e senha são obrigatórios.']);
        exit;
    }

    // Prevenir SQL Injection
    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE nome = ?");
    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $user['senha'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nome'];

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Senha incorreta.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Utilizador não encontrado.']);
    }

    mysqli_close($conn);
?>
