<?php
session_start();
header('Content-Type: application/json');

include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';

if (!$conn) {
    echo json_encode(['success' => false, 'message' => 'Erro na conexão com a base de dados.']);
    exit;
}

$input = trim($_POST['name'] ?? '');
$password = trim($_POST['password'] ?? '');

if (empty($input) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Nome/email ou senha em branco.']);
    exit;
}

// Verifica se é um email válido
$isEmail = filter_var($input, FILTER_VALIDATE_EMAIL);

// Prepara o statement correto com base no tipo de input
if ($isEmail) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
} else {
    $stmt = $conn->prepare("SELECT * FROM users WHERE nome = ?");
}

$stmt->bind_param("s", $input);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    // Verifica a senha, com suporte para hash ou plano
    if (password_verify($password, $row['senha']) || $password === $row['senha']) {
        $_SESSION['user'] = $row['nome'];
        echo json_encode(['success' => true]);
        exit;
    }
}

// Se não encontrou ou senha incorreta
echo json_encode(['success' => false, 'message' => 'Credenciais inválidas.']);
exit;
?>
