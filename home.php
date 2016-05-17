<?php
require_once './core/zona_privada.php';
require_once './core/carga.php';
require_once './core/user.php';
require_once './core/horario.php';
require_once 'menu.php';
$BAND = false;
setlocale(LC_MONETARY, 'en_US');

    $dato_periodo = carga::getStatic_activo();
    $horario = new horario();
    $carga_asignatura = $horario->get_existente_carga($_SESSION['user'], $dato_periodo[0]['id']);
    //print_r($carga_asignatura);
    if (count($carga_asignatura)> 0)
    {
        $BAND = true;
        //print_r($carga_asignatura);
    }
    
if(isset($_POST) and isset($_POST["id"]))
{
    $objH = new horario();
    //print_r($_POST);
    //exit();
    $respuesta = $objH->setHorario($_POST['dia'], $_POST['hstart'], $_POST['hend'], $_POST['id']);
    header("Location: home.php");
}

if(isset($_GET) and isset($_GET["eli"]))
{
    $objH = new horario();
    $respuesta = $objH->deleteHorario($_GET['eli']);
}  
?>
<!doctype html>
<html lang="es">
    <head>
        <title>Sistema de carga horaria docente</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        include './inc/head_common.php';
        ?>
        <link rel="stylesheet" href="css/cuerpo.css"/>
    </head>
    <body>
        <?php include './inc/header.php'; ?>
        <div class="container" id="principal">
            
            <div class="row">
                <div class="alert alert-success paleta" role="alert"><h3>Carga: <?php if ($BAND) { echo 'Semestre: '. $dato_periodo[0]['nombre'] . ' - A&ntilde;o lectivo: '. $dato_periodo[0]['anio_lectivo']; } ?></h3>
                </div>
                <div class="col-xs-12">
                    
                    
                    <fieldset>
                        
                            <p id="resultado"></p>
                            <div class="mensaje_p"></div>
 <div class="mensaje"></div>
                                        <table class="table table-hover editinplace_p" id="ad">
                                           <thead>
                                                <tr>
                                                    <th>Asignatura</th>
                                                    <th>Horas</th>
                                                    <th>Pago</th>
                                                    <th>Total</th>
                                                    <th>Modalidad</th>
                                                    <th>Carrera</th>
                                                    <th>Departamento</th>
                                                    <th>Horario</th>
                                                    <th></th>
                                                </tr>
                                           </thead>
                                            <tbody>
                                                    <?php
                                                   
                                                    if(count($carga_asignatura)>0)
                                                    {
                                                        $total_h = 0;
                                                        $total_p = 0;
                                                    for($z = 0; $z<count($carga_asignatura); $z++)
                                                    {
                                                        $dato_horario = horario::get_horario($carga_asignatura[$z]["idcarga"]);
                                                        
                                                 ?>
                                        <tr>
                                            <td><input type="hidden" name="id" value="<?php echo $carga_asignatura[$z]["idcarga"]; ?>"/><?php echo $carga_asignatura[$z]["asignaturas"]; ?></td>
                                        <td><?php echo $carga_asignatura[$z]["thoras"]; $total_h += $carga_asignatura[$z]["thoras"]; ?></td>
                                        <td>C$ <?php echo number_format($carga_asignatura[$z]["pagoxhora"], 2, ',', ' '); ?></td>
                                        <td>C$ <?php echo number_format($carga_asignatura[$z]["pago"], 2, ',', ' '); $total_p += $carga_asignatura[$z]["pago"];?></td>
                                        <td><?php echo $carga_asignatura[$z]["turno"]; ?></td>
                                        <td><?php echo $carga_asignatura[$z]["carreras"]; ?></td>
                                        <td><?php echo $carga_asignatura[$z]["departamento"]; ?></td>
                                        
                                       
                                        <td>
                                            <table>
                                               
                                                 <?php
                                                                                                  
                                                      
                                                    //print_r($dato_horario);
                                                    if(count($dato_horario)>0)
                                                    {
                                                    for($i = 0; $i<count($dato_horario); $i++)
                                                    {
                                                 ?>
                                        <tr>
                                            <td style="padding-right: 10px;"><?php echo $dato_horario[$i]["dia"]; ?></td>
                                        <td style="padding-right: 10px;"><?php echo date('h:i A', strtotime($dato_horario[$i]["inicio"])); ?></td>
                                        <td style="padding-right: 10px;"><?php echo date('h:i A', strtotime($dato_horario[$i]["fin"])); ?></td>
                                        <td style="padding-right: 10px;"><a data-toggle="tooltip" href="home.php?eli=<?php echo $dato_horario[$i]["idhorario"]; ?>" title="Eliminar horario">
                                                <i class="fa fa-trash-o fa-2x"></i></a></td>
                                        </tr>
                                        <?php
                                                    }}
                                                    
                                                    ?>
                                        </table>
                                        </td>
                                        
                                        
                                        <td>
                                            <span data-target="#myModal" data-toggle="modal"><a  data-toggle="tooltip" onclick="idActualizar('<?php echo $carga_asignatura[$z]["idcarga"]; ?>')" href="#" title="Agregar horario" data-toggle="tooltip" ><i class="fa fa-plus fa-2x" aria-hidden="true"></i></a>
                                        
</span>
                                            </td>
                                    </tr>
                               
                                                    
                                       <?php
                                    
                                                    
                                                    }}
                                                    ?>
                                            </tbody>
                                        </table>
 <table class="table table-hover editinplace_p" id="ad">
                                           <thead>
                                                <tr>
                                                    <th>Total de horas</th>
                                                    <th>Total de pago</th>
                                                </tr>
                                                <tr>
                                                    <td><?php if(count($carga_asignatura)>0)
                                                    { echo $total_h; } ?></td>
                                                    <td> <?php if(count($carga_asignatura)>0)
                                                    { echo "C$ ".number_format($total_p, 2, ',', ' '); } ?></td>
                                                </tr>
                                           </thead>
                                           <tbody>
                                               
                                           </tbody>
 </table>
                             </fieldset>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title">Horario</h4>
        </div>
        <div class="modal-body">
          <form name="form" id="form" class="form-horizontal" style="text-align: left;" action="home.php" method="POST">
                                <div class="form-group">
                                    <label for="dia" class="control-label col-xs-5">D&iacute;a: </label>
                                            <div class="col-xs-7">
                                                <select name="dia" id="dia" required class="form-control">
                                                    <option value="" class="priElement">Seleccione una opci&oacute;n</option>
                                                    <option value="Lunes">Lunes</option>
                                                    <option value="Martes">Martes</option>
                                                    <option value="Miercoles">Miercoles</option>
                                                    <option value="Jueves">Jueves</option>
                                                    <option value="Viernes">Viernes</option>
                                                    <option value="S&aacute;bado">S&aacute;bado</option>
                                                    <option value="Domingo">Domingo</option>
                                                </select>
                                                <input type="hidden" name="id" id="id">
                                            </div>
                                        </div>
                                
                                <div class="form-group">
                                            <label autocomplete="off" for="hstart" class="control-label col-xs-5">Hora de inicio</label>
                                            <div class="col-xs-7">
                                                <input type="time" name="hstart" required="require" class="form-control" id="hstart" min="06:00:00" max="22:00:00">
                                            </div>
                                        </div>
                                
                               <div class="form-group">
                                            <label autocomplete="off" for="hend" class="control-label col-xs-5">Hora de cierre</label>
                                            <div class="col-xs-7">
                                                <input type="time" name="hend" required="require" class="form-control" id="hend" min="06:00:00" max="22:00:00">
                                            </div>
                                        </div>
                                <div class="form-actions">
                                <button type="submit" name="enviar" id="enviar" class="btn btn-primary">Agregar Horario</button> 
                                   
                                </div>
                            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
<!--                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">Datos personales</a></li>
                        <li><a data-toggle="tab" href="#menu1">Datos academicos</a></li>
                        <li><a data-toggle="tab" href="#menu2">Datos del usuario</a></li>
                        <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                            <h3>Datos personales</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            
                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <h3>Datos academicos</h3>
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            <h3>Datos del usuario</h3>
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                        </div>
                            <div id="menu3" class="tab-pane fade">
                              <h3>Menu 3</h3>
                              <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                            </div>
                    </div>-->


                </div>
            </div>
<!--            <div class="row">
                <div class="col-xs-12">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                        Collapsible Group 1</a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse in">
                                <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                    minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                    commodo consequat.</div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                        Collapsible Group 2</a>
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                    minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                    commodo consequat.</div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                        Collapsible Group 3</a>
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                    minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                    commodo consequat.</div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>-->
        </div>
        <?php
        include './inc/footer.php';
        ?>
        
        <?php
        include './inc/footer_common.php';
        ?>
        <script>
            function idActualizar(id)
            {
                document.getElementById('id').value = id;
            }
        </script>
    </body>
</html>
