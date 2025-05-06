<?php
header('Content-Type: application/json');

$host = 'localhost';
$db = 'clis_db';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  echo json_encode(['success' => false, 'message' => 'Erro na conexão com o banco de dados.']);
  exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$email = $conn->real_escape_string($data['email']);

$result = $conn->query("SELECT * FROM users WHERE email = '$email'");
if ($result && $result->num_rows > 0) {
  echo json_encode(['success' => true]);
} else {
  echo json_encode(['success' => false, 'message' => 'E-mail não encontrado.']);
}

$conn->close();
?>