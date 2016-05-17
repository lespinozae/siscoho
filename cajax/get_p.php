<?php
require_once '../core/zona_privada.php';
include '../core/carga.php';
$p = $_POST["carga_periodo_id"];
$d = $_POST["carga_docentes_id"];

$obj = new carga();
$d = $obj->getStatic_permitir($d, $p);

if(count($d)>0)
    echo $d[0]["permitir"];
?>