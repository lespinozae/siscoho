<?php
require_once '../core/zona_privada.php';
include '../core/carga.php';
$id = $_GET["id"];

$anio = carga::getStatic_anio($id);
?>
<div class="panel-group" id="accordion">
    <?php
    if (count($anio) > 0) {
        ?>
        <?php
        for ($j = 0; $j < count($anio); $j++) {
            $t = array();
            $t = carga::getStatic_asignaturas($id, $anio[$j]["anio"]);
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $j; ?>">
                            A&ntilde;o acad&eacute;mico: <?php echo $anio[$j]["anio"]; ?></a>
                    </h4>
                </div>
                <div id="collapse<?php echo $j; ?>" class="panel-collapse collapse <?php if ($j == 0) { ?> in <?php } ?>">
                    <div class="panel-body">
                     <?php
                     for ($i = 0; $i < count($t); $i++) {
                         ?>

                            <?php
                            if ($i == 0) {
                                ?>
                                <table class="table table-hover" id="su">
                                    <thead>
                                        <tr>
                                            <TH>ID</TH>
                                            <th>Asignatura</th>
                                            <th>Plan</th>
                                            <th>Horas</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla">
            <?php } ?>

                                    <tr id="<?php echo $t[$i]["idasiganturas"]; ?>">
                                        <td><?php echo $t[$i]["idasiganturas"]; ?></td>
                                        <td><?php echo $t[$i]["asignaturas"]; ?></td>
                                        <td><?php echo $t[$i]["plan"]; ?></td>
                                        <td><?php echo $t[$i]["thoras"]; ?></td>
                                        <td><a href="#" class="add" onclick="anadi_quitar(event, '<?php echo $t[$i]["idasiganturas"]; ?>', this)"><i class="fa fa-plus"></i></a></td>         
                                    </tr>
            <?php
            if ($i > count($t) - 2) {
                ?>
                                    </tbody>

                                </table>
                                    <?php } ?>

            <?php
        }
        ?>
                    </div>
                </div>
            </div>
                        <?php
                    }
                }
                ?>
</div>