<?php
require_once '../core/zona_privada.php';
include '../core/user.php';
$id = $_GET["id"];
$obj = new user();
$d = $obj->getStatic_existente_user($id);
echo $d[0]['cantidad'];