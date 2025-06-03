<?php
require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';
header('Content-Type: application/json');

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

try {
    $query = "
        SELECT 
            e.Nome AS nome,
            e.Email AS email,
            e.Contacto,
            e.Sigla,
            e.logo_enti,
            p.foto_pres,
            p.frase_pres,
            p.nome_Pres,
            ap.nome AS nome_apoio
        FROM entidades e
        LEFT JOIN presidentes p ON e.Id_Enti = p.Id_Enti
        LEFT JOIN apoio ap ON e.Id_Enti = ap.Id_Enti
        WHERE e.Id_Enti = ?
    ";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }

    $id = $_GET['id'] ?? $_POST['id'] ?? null;
    if (!$id) {
        throw new Exception("Id_Enti não fornecido.");
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $entidade = null;
    $apoios = [];

    while ($row = $result->fetch_assoc()) {
        if (!$entidade) {
            // Só uma vez, pega os dados principais
            $entidade = [ 
                'nome' => $row['nome'], 
                'email' => $row['email'], 
                'Contacto' => $row['Contacto'], 
                'Sigla' => $row['Sigla'], 
                'logo' => !empty($row['logo_enti']) ? base64_encode($row['logo_enti']) : null, 
                'foto_presidente' => !empty($row['foto_pres']) ? base64_encode($row['foto_pres']) : null, 
                'frase_president' => $row['frase_pres'], 
                'nome_presidente' => $row['nome_Pres'],
                'nome_apoio' => [] // inicializa como array
            ];
        }

        if (!empty($row['nome_apoio']) && !in_array($row['nome_apoio'], $apoios)) {
            $apoios[] = $row['nome_apoio'];
        }
    }

    if ($entidade) {
        $entidade['nome_apoio'] = $apoios;
        echo json_encode([$entidade]);
    } else {
        echo json_encode(['error' => 'Nenhum dado encontrado.']);
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
