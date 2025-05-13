<?php
    header('Content-Type: application/json');
    require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php'; // Adjusted path to db_connect.php
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT nome_Bene, Genero, NIF, NISS, BI, Morada, Contacto, Cod_Postal, Data_nasc, Data_Admissao, Data_Saida, Id_Enti, Id_Apoio, Incap_Defec, Auto_Depen, Sit_sem_abrigo, Sit_Emprego, Imigrante, Id_Sigla, Observacao FROM beneficiarios";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $beneficiarios = [];
        while ($row = $result->fetch_assoc()) {
            $beneficiarios[] = $row;
        }
        echo json_encode($beneficiarios);
    } else {
        echo json_encode(['erro' => 'Nenhum beneficiário encontrado']);
    }
?>
