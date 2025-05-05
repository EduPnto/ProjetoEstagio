<?php
session_start();
session_destroy();
header('Location: ../../FrontEnd/Paginas/Login/LoginPage.php');
exit();
?>