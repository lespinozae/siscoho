<?php
require_once '../core/zona_privada.php';
require_once '../core/carga.php';
$d = $_POST["carga_docentes_id"];
$p = $_POST["carga_periodo_id"];

$permitir=carga::getStatic_permitir($d, $p);
if($permitir[0]['permitir']==0)
{
    $limite = carga::getStatic_limite($_POST["carga_docentes_id"]);
    
    $limiteA = $limite[0]['limite'];
    
    $porciones = explode(",", $_POST['arreglo']);
    array_pop($porciones);
    $contador = 0;
    $total = array();
    
    $cantidad = carga::getStatic_CountCarga($d, $p);
    //print_r($cantidad);
    
    $contador = $cantidad[0]["cantidad"]; 
    
    for($k=0;$k<count($porciones);$k++)
    {
        $total=carga::getStatic_Asignatura($porciones[$k]);
        
        if(count($total)>0)
        {
            $contador+=$total[0]["thoras"];
        }
        $total = array();
    }
    //echo $contador;
    if($limiteA>=$contador)
    {
        echo 1;
    }
    else
    {
        echo 0;
    }
}
else
    echo 1;


