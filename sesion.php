<?php 
/*Area privada de PHP para el acceso a usuarios*/ 
include("zona_privada.php"); 
/*Inicia Sessión*/
session_start();
/*Finaliza todas las variables de sesión del sistema*/
$_SESSION = array();
/*Finaliza Sesión*/
session_destroy();
/*Redirecciona al login*/
$url="index.php";
header ("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']). "/" .$url);
exit();
?>