<?php
session_start();
session_destroy();
header('Location: /ProjetoEstagio/FrontEnd/Paginas/Login/LoginPage.php');
exit();
?>