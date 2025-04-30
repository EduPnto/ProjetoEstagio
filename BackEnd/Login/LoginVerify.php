<?php
    session_start();
    require('../../../BackEnd/DataBase/db_connect.php');

    if (!$conn) {
        echo json_encode(['success' => false, 'message' => 'Erro na conexão com a base de dados.']);
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST["name"];
        $password = $_POST["password"];

        if(!empty($email) && !empty($password)){
            $condition = true;
        } else {
            $condition = false;
        }
        
        if($condition == true){

            $sql = "SELECT * FROM users WHERE nome = ? and senha = ?";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss",$name,$password);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
        
            if($name == $row['nome'] && $password == $row['senha']){
                $condition = true;

                if($condition == true){
                    
                        $sql = "SELECT * FROM users WHERE nome = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("s",$name);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();

                        session_start();

                        $_SESSION['ID'] = $row['ID'];

                        header("Location: Paginas/MainPage.php"); //Caminho para a página do utilizador
                        exit();

                    
                    } 
                }
                
            } else {
                echo 'Utilizador não existe';
            }

        } 
?>
