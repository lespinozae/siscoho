<?php
require_once '../core/zona_privada.php';
include '../core/class.asig.php';
$id = $_GET["id"];
$carr = asignatura::getStatic_carreras($id);
//print_r($fac);

if(count($carr)>0){
    ?>
<option class="priElement" value="">Seleccione una opci&oacute;n</option>
<?php
for ($i = 0; $i < count($carr); $i++) {

        ?>
        <option value="<?php echo $carr[$i]["id"]; ?>"><?php echo $carr[$i]["carreras"]; ?></option>
        <?php

}

    }
 else {?>
<option class="priElement" value="">Seleccione una opci&oacute;n</option>        
<?php }
?>