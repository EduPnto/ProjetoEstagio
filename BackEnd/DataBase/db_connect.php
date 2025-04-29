<?php
$servername = "127.0.0.1"; // ou o IP do servidor
$username = "root";
$password = "";
$dbname = "clis_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

?>
