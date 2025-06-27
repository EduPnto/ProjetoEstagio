<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php'; // Adjusted path to db_connect.php
    if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
    }

     header('Content-Type: application/json');

     try {
          $query = "
               SELECT 
                    e.*,
                    COUNT(b.Id_Bene) AS total_beneficiarios
               FROM entidades e
               LEFT JOIN beneficiarios b ON b.Id_Enti = e.Id_Enti
               GROUP BY e.Id_Enti, e.nome, e.email, e.Contacto, e.Sigla, e.logo_enti
               ORDER BY e.Id_Enti ASC
               ";

          $result = $conn->query($query);

          if ($result) {
               $entidades = [];
               while ($row = $result->fetch_assoc()) {
                    $entidades[] = [
                         'Id_Enti' => $row['Id_Enti'],
                         'nome' => $row['nome'],
                         'email' => $row['email'],
                         'Contacto' => $row['Contacto'],
                         'Sigla' => $row['Sigla'],
                         'logo' => !empty($row['logo_enti']) ? base64_encode($row['logo_enti']) : null,
                         'total_beneficiarios' => $row['total_beneficiarios']
                    ];
               }
               echo json_encode($entidades);
          } else {
          http_response_code(500); // Define erro HTTP
          echo json_encode(['error' => $conn->error]);
          }
     } catch (Exception $e) {
          echo json_encode(['error' => $e->getMessage()]);
     }
?>