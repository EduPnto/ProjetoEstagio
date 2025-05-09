<?php
    header('Content-Type: application/json');
    $data = json_decode(file_get_contents("php://input"), true);

    require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php'; // Adjusted path to db_connect.php

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $stmt = $conn->prepare("INSERT INTO beneficiarios (
        nome_Bene, Genero, NIF, NISS, BI, Morada, Contacto, Cod_Postal,
        Data_nasc, Data_Admissao, Data_Saida,
        Id_Enti, Id_Apoio, Incap_Defec, Auto_Depen, Sit_sem_abrigo,
        Sit_Emprego, Imigrante, Id_Sigla, Observacao
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssssssiiiiiiiiss",
        $data['nome'], $data['genero'], $data['nif'], $data['niss'], $data['bi_cc'],
        $data['morada'], $data['contacto'], $data['cod_postal'], $data['data_nasc'], 
        $data['data_admissao'], $data['data_saida'],
        $data['id_enti'], $data['id_apoio'], $data['deficiencia'], $data['autonomia'],
        $data['sem_abrigo'], $data['emprego'], $data['imigrante'],
        $data['id_sigla'], $data['observacoes']
    );

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Beneficiário registado com sucesso!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao registar beneficiário: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
?>
