<?php
require_once '../core/zona_privada.php';
include '../core/class.asig.php';
$id = $_GET["id"];
$mod = asignatura::getStatic_Modalidad($_GET["id"]);

?>
<option class="priElement" value="">Seleccione una opci&oacute;n</option>
<?php
if(count($mod)>0)
{
for ($i = 0; $i < count($mod); $i++) {
        ?>
        <option value="<?php echo $mod[$i]["idturno"]; ?>"><?php echo $mod[$i]["turno"]; ?></option>
        <?php
}
}
else
{
    ?>
        <option class="priElement" value="">Seleccione una opci&oacute;n</option>
        <?php
}
?>