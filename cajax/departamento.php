<?php
require_once '../core/zona_privada.php';
include '../core/user.php';
$id = $_GET["id"];
$obj = new user();
$d = $obj->getStatic_departamento($id);
if(count($d)>0)
{
?>
    <?php
    ?>
    <option class="priElement" value="">Seleccione una opci&oacute;n</option>
    <?php
    for ($i = 0; $i < count($d); $i++) {
        ?>
        <option value="<?php echo $d[$i]["id"]; ?>"><?php echo $d[$i]["departamento"]; ?></option>
        <?php
    }
    }
    ?>