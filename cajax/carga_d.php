<?php 
require_once '../core/zona_privada.php';
include '../core/carga.php';

$obj = new carga();
$d = $obj->deleteCargaAsig($_POST['_idasiganturas'], $_POST["carga_periodo_id"], $_POST["carga_docentes_id"]);

echo $d;
?>