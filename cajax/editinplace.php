<?php
require_once '../core/zona_privada.php';
include '../core/h.php';

if (isset($_POST) && count($_POST)>0)
{
    $obj = new tc_y_p();
    $query=$obj->setEdit_tc($_POST["campo"], $_POST["valor"], intval($_POST["id"]));
    if ($query) echo "<span class='ok'>Valores modificados correctamente.</span>";
    else echo "<span class='ko'>Error</span>";
}

if (isset($_GET) && count($_GET)>0)
{
	
    $valores = tc_y_p::getStatic_tc();
    $datos=array();
    for ($index = 0; $index < count($valores); $index++)
    {
            $datos[]=array("id"=>$valores[$index]["id"],
                                            "contratacion"=>$valores[$index]["contratacion"],
                                            "limiteshoras"=>$valores[$index]["limiteshoras"]
            );
    }
    
    echo json_encode($datos);
}
?>
