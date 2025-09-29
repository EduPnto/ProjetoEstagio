<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';
    session_start();
    header('Content-Type: application/json');

    $produtos = [];
    if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
    }
    
    try {
        $id_enti = isset($_SESSION['Id_Enti']) ? intval($_SESSION['Id_Enti']) : 0;
        if ($id_enti == 0) {
            $sql = "SELECT p.*, e.Sigla AS Entidade, c.nome AS Categoria
                    FROM produtos p
                    JOIN entidades e ON e.Id_Enti = p.Id_Enti
                    LEFT JOIN categoria c ON c.Id_Category = p.Id_Category
                ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $sql = "SELECT p.*, e.Sigla AS Entidade, c.nome AS Categoria
                    FROM produtos p
                    JOIN entidades e ON e.Id_Enti = p.Id_Enti
                    LEFT JOIN categoria c ON c.Id_Category = p.Id_Category
                    WHERE p.Id_Enti = ?
                ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id_enti);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        
        while ($row = $result->fetch_assoc()) {
            $produtos[] = [
                'Id_Prod' => $row['Id_Prod'],
                'Id_Category' => $row['Id_Category'],
                'Id_Enti' => $row['Id_Enti'],
                'nome_Prod' => $row['nome_Prod'],
                'Entidade' => $row['Entidade'],
                'Categoria' => $row['Categoria'],
                'Quantidade' => $row['Quantidade'],
                'Quantidade_emp' => $row['Quantidade_emp'],
                'Image_Prod' => !empty($row['Image_Prod']) ? base64_encode($row['Image_Prod']) : null,
                'Continuidade' => $row['Continuidade']
            ];
        }

        echo json_encode($produtos);
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo json_encode(['erro' => $e->getMessage()]);
    }

?>