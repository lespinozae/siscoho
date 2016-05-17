<?php
require_once '../core/zona_privada.php';
include '../core/carga.php';
$p = $_GET["p"];
$c = $_GET["c"];
$carga_asignatura = carga::getStatic_carga_asignatura($c, $p);
$p_actual = $_GET["p_actual"];
if(count($carga_asignatura)>0)
{
    ?>
<LABEL for="all" style="font-size: 10px;">Seleccionar todo</LABEL>&nbsp;&nbsp;<input id="all" type="checkbox" onclick="checkPage(this)">
<form name="import_form" id="import_form" method="POST" action="c.php">
<table class="table table-hover editinplace_p" id="import_t" style="font-size: 10px;">
                                           <thead>
                                                <tr>
                                                    <TH>ID</TH>
                                                    <th>Asignatura</th>
                                                    <th>Plan</th>
                                                    <th>Horas</th>
                                                    <th>Turno</th>
                                                    
                                                    <th></th>
                                                </tr>
                                           </thead>
                                            <tbody>
                                                    <?php
                                                    if(count($carga_asignatura)>0)
                                                    {
                                                    for($z = 0; $z<count($carga_asignatura); $z++)
                                                    {
                                                        
                                                 ?>
                                                    <tr>
                                        <td><?php echo $carga_asignatura[$z]["idasiganturas"]; ?></td>
                                        <td><?php echo $carga_asignatura[$z]["asignaturas"]; ?></td>
                                        <td><?php echo $carga_asignatura[$z]["plan"]; ?></td>
                                        <td><?php echo $carga_asignatura[$z]["thoras"]; ?>
                                        <input type="hidden" name="th" value="<?php echo $carga_asignatura[$z]["thoras"]; ?>" />
                                        </td>
                                        <td><?php echo $carga_asignatura[$z]["turno"]; ?></td>
                                        <td>
                                            <label class="c-input c-checkbox">
  <input type="checkbox" name="agregar_import[]" value="<?php echo $carga_asignatura[$z]["idasiganturas"]; ?>" />
</label></td>         
                                    </tr>
                                    <?php
                                                    }}
                                                    ?>
                                            </tbody>
                                        </table>
    <input type="hidden" name="id" value="<?php echo $c; ?>" />
    <input type="hidden" name="p" value="<?php echo $p_actual; ?>" />
    
    <BUTTON type="submit" name="import" onclick="return _import_carga()" class="btn btn-primary">Importar</BUTTON/><div id="resultado_import"></DIV>
</form>
<?php
}