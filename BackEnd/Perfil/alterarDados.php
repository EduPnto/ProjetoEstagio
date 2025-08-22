<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['erro' => 'Falha na conexão com o banco de dados.']);
    exit;
}

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['email']) || !isset($data['senha'])) {
    http_response_code(400);
    echo json_encode(['erro' => 'Dados incompletos.']);
    exit;
}

$nome = intval($data['nome']);
$email = $data['email'];
$senha = password_hash($data['senha'], PASSWORD_BCRYPT);

$stmt = $conn->prepare("UPDATE users SET email=?, senha=? WHERE nome=?");
$stmt->bind_param("ssi", $email, $senha, $nome);

if ($stmt->execute()) {
    echo json_encode(['sucesso' => 'Dados atualizados com sucesso.']);
} else {
    http_response_code(500);
    echo json_encode(['erro' => 'Erro ao atualizar os dados.']);
}

$stmt->close();
$conn->close();
?>
