<?php
require_once '../core/zona_privada.php';
include '../core/carga.php';
$id = $_GET["id"];
$t = carga::getStatic_turno($id);
if(count($t)>0)
{
?>
<option class="priElement" value="">Seleccione una opci&oacute;n</option>
    <?php
    for ($i = 0; $i < count($t); $i++) {
        ?>
        <option value="<?php echo $t[$i]["idturno"]; ?>"><?php echo $t[$i]["turno"]; ?></option>
        <?php
    }
    }
    ?>