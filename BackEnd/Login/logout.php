<?php
session_start();
session_destroy();
header('Location: /ProjetoEstagio/FrontEnd/Paginas/MainPage/MainPage.php');
exit();
?>