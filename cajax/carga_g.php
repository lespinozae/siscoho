<?php 
require_once '../core/zona_privada.php';
include '../core/carga.php';

$obj = new carga();
$d = $obj->setCargaAsig($_POST['_idasiganturas'], $_POST["carga_periodo_id"], $_POST["carga_docentes_id"], $_POST["thoras"]);

echo $d;
?>