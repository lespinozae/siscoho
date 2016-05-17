<?php
require_once '../core/zona_privada.php';
include '../core/p.php';
$d = p::getStatic_activo();
echo $d[0]['cantidad'];