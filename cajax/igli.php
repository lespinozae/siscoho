<?php 
require_once '../core/zona_privada.php';
include '../core/carga.php';

$obj = new carga();
$d = $obj->ignorarLimite($_POST["carga_periodo_id"], $_POST["carga_docentes_id"], $_POST["valor"]);

echo $d;
?>