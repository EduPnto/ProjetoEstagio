<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';

    header('Content-Type: application/json');

    $emprestimos = [];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("
        SELECT 
            ep.*, 
            b.nome_Bene AS nomeBeneficiario, 
            b.NISS AS Niss, 
            p.nome_Prod AS nome_Prod
        FROM emprestimos ep
        INNER JOIN beneficiarios b ON ep.Id_Bene = b.Id_Bene
        INNER JOIN produtos p ON ep.Id_Prod = p.Id_Prod
    ");
    $stmt->execute();
    $result = $stmt->get_result();
    

    while ($row = $result->fetch_assoc()) {
        $emprestimos[] = [
            'Id_Emprestimo' => $row['Id_Emprestimo'],
            'nomeBeneficiario' => $row['nomeBeneficiario'],
            'Niss' => $row['Niss'],
            'nome_Prod' => $row['nome_Prod'],
            'Quantidade' => $row['Quantidade'],
            'Data_Inicio' => $row['Data_Inicio'],
            'Data_Entrega' => $row['Data_Entrega']
        ];
    }

    $stmt->close();


    $conn->close();
    echo json_encode($emprestimos);
?>