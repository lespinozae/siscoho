<?php
require_once '../core/zona_privada.php';
include '../core/p.php';
$d = p::updateStatic_activo_cerrar();
echo $d;