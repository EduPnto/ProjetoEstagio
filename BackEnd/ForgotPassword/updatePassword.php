<?php
header('Content-Type: application/json');

$host = 'localhost';
$db = 'clis_db';
$user = 'root';
$pass = ''; // sem senha no XAMPP por padrão

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  echo json_encode(['success' => false, 'message' => 'Erro na conexão com o banco de dados.']);
  exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$email = $conn->real_escape_string($data['email']);
$newPassword = $data['password'];

// Verifica se o utilizador existe e obtém a senha atual
$result = $conn->query("SELECT senha FROM users WHERE email = '$email'");
if ($result && $result->num_rows === 1) {
  $row = $result->fetch_assoc();
  $currentHashedPassword = $row['senha'];

  // Verifica se a nova senha é igual à atual
  if (password_verify($newPassword, $currentHashedPassword)) {
    echo json_encode(['success' => false, 'message' => 'A nova senha não pode ser igual à anterior.']);
    $conn->close();
    exit;
  }

  // Atualiza a senha
  $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
  $update = $conn->query("UPDATE users SET senha = '$newHashedPassword' WHERE email = '$email'");

  if ($update) {
    echo json_encode(['success' => true]);
  } else {
    echo json_encode(['success' => false, 'message' => 'Erro ao atualizar a senha.']);
  }
} else {
  echo json_encode(['success' => false, 'message' => 'Utilizador não encontrado.']);
}

$conn->close();
?>
