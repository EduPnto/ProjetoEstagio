<?php
session_start();
header('Content-Type: application/json');

include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';

if (!$conn) {
    echo json_encode(['success' => false, 'message' => 'Erro na conexão com a base de dados.']);
    exit;
}

$name = $_POST['name'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($name) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Nome ou senha em branco.']);
    exit;
}

$stmt = $conn->prepare("SELECT * FROM users WHERE nome = ?");
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    // Se a senha estiver encriptada com password_hash()
    if (password_verify($password, $row['senha'])) {
        $_SESSION['user'] = $row['nome'];
        echo json_encode(['success' => true]);
        exit;
    }
    // Se não estiver encriptada (usa comparação direta)
    // if ($password === $row['senha']) { ... }
    if ($password === $row['senha']) {
        $_SESSION['user'] = $row['nome'];
        echo json_encode(['success' => true]);
        exit;
    }
}

echo json_encode(['success' => false, 'message' => 'Credenciais inválidas.']);
exit;
?>