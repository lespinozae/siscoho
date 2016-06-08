
<?php
require_once('DBConnector.php');
require_once('mStatic.php');
/* Inicia nueva sesion */ 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

if($_SESSION["user"]==""){ 
   
	echo '<script>window.location.href="index.php";</script>';
	} 
/* Tiempo de caducidad de la sesión actual */
        $inactivo = 1800;
        $vida_session = 0;
        
    if (isset($_SESSION["time"]))
    {
        $vida_session = time() - $_SESSION["time"];
        $valor = false;
        
        $self = $_SERVER['PHP_SELF'];
        $valor = strpos('user', $self);
        $valores = mStatic::url_acces($_SESSION["user"]);
       
        for($i = 0; $i<count($valores); $i++)
        {
            if(strlen($valores[$i]["archivo"]) > 0)
            {
                $valor = strpos($self, $valores[$i]["archivo"]);
            }
            if($valor) break;
        }
        if($valor == false and !strpos($self, '/cajax/'))
        {
            echo '<script>window.location.href="index.php";</script>';
        }
        
        if ($vida_session > $inactivo)
        {
            echo '<script>alert("Su sesión ha caducado")</script>'; //Script de caducidad de la sesión
            echo '<script>window.location.href="index.php";</script>';
            $_SESSION = array();
            session_destroy();
        }
    }
    
    $_SESSION["time"] = time();
?>
