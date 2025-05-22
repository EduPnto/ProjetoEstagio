<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php'; // Adjusted path to db_connect.php
    if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
    }

     header('Content-Type: application/json');

     try {
          $query = "SELECT * FROM entidades ORDER BY Id_Enti ASC";
          $result = $conn->query($query);

          if ($result) {
                $entidades = [];
                while ($row = $result->fetch_assoc()) {
                    $entidades[] = [
                         'Id_Enti' =>$row['Id_Enti'],
                         'nome' => $row['nome'],
                         'email' => $row['email'],
                         'Contacto' => $row['Contacto'],
                         'Sigla' => $row['Sigla'],
                         'logo' => !empty($row['logo_enti']) ? base64_encode($row['logo_enti']) : null
                    ];
                }
                echo json_encode($entidades);
          } else {
                echo json_encode(['error' => $conn->error]);
          }
     } catch (Exception $e) {
          echo json_encode(['error' => $e->getMessage()]);
     }
?>