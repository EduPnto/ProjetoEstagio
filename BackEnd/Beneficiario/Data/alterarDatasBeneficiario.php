<?php
header('Content-Type: application/json');

// Lê o corpo JSON cru
$input = json_decode(file_get_contents("php://input"), true);

// Extrai os dados do JSON
$niss = $input['niss'] ?? null;
$dataAdmissao = $input['data_admissao'] ?? null;
$dataSaida = $input['data_saida'] ?? null;

// Validação
if (!$niss || !$dataAdmissao || !$dataSaida) {
    echo json_encode([
        'success' => false,
        'message' => 'Dados em falta.'
    ]);
    exit;
}

// Connect to the database using mysqli
$mysqli = new mysqli('localhost', 'root', '', 'clis_db');

// Check connection
if ($mysqli->connect_error) {
    echo json_encode([
        'success' => false,
        'message' => 'Erro de conexão: ' . $mysqli->connect_error
    ]);
    exit;
}

// Prepare and bind
$stmt = $mysqli->prepare("UPDATE beneficiarios SET Data_Admissao = ?, Data_Saida = ? WHERE NISS = ?");
$stmt->bind_param('ssi', $dataAdmissao, $dataSaida, $niss);

// Execute the statement
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Erro ao atualizar o banco de dados.'
    ]);
}

// Close the statement and connection
$stmt->close();
$mysqli->close();
?>
