<?php
//exit();
ob_start();
$data = data();
require_once './core/zona_privada.php';
require_once './core/depocoor.php';
require_once './core/paginator.class.php';
$accion = 0;
$objP_ = new p();

function data() {
    $data = array();
    if (array_key_exists('id', $_POST)) {
        $data["id"] = $_POST['id'];
    }
    
    if (isset($_COOKIE['departamento'])) {
        $data["departamento"] = $_COOKIE['departamento'];
        if(strlen($_COOKIE['departamento']) > 0)
            setcookie('departamento', $_COOKIE['departamento'], time() + 3600);
    }else
    if (array_key_exists('departamento', $_POST)) {
        $data["departamento"] = $_POST['departamento'];
        if(strlen($_POST['departamento']) > 0)
            setcookie('departamento', $_POST['departamento'], time() + 3600);
    } else
    if (array_key_exists('departamento', $_GET)) {
        $data["departamento"] = $_GET['departamento'];
        if(strlen($_GET['departamento']) > 0)
            setcookie('departamento', $_GET['departamento'], time() + 3600);
    }
    
    if (isset($_COOKIE['facultad'])) {
        $data["facultad"] = $_COOKIE['facultad'];
        if(strlen($_COOKIE['facultad']))
            setcookie('facultad', $_COOKIE['facultad'], time() + 3600);
    }else
    if (array_key_exists('facultad', $_POST)) {
        $data["facultad"] = $_POST['facultad'];
        if(strlen($_POST['facultad']))
            setcookie('facultad', $_POST['facultad'], time() + 3600);
    } else
    if (array_key_exists('facultad', $_GET)) {
        $data["facultad"] = $_GET['facultad'];
        if(strlen($_GET['facultad']))
            setcookie('facultad', $_GET['facultad'], time() + 3600);
    }
    
    
    $BAND_DELETE_COOKIE = false;
    if (array_key_exists('cdepartamento', $_GET)) {
        setCookie('departamento', '', time() - 5000);
        $BAND_DELETE_COOKIE = true;
    }
    if (array_key_exists('cfacultad', $_GET)) {
        setCookie('facultad', '', time() - 5000);
        $BAND_DELETE_COOKIE = true;
    }
    
    if($BAND_DELETE_COOKIE)
    {
        header("Location: dc.php");
    }
    ob_end_flush(); 
    //print_r($_COOKIE);
    //exit();
    return $data;
}

$BANDM = false;
$beneficiario = array();
$user = array();

if (isset($_GET)) {
    if (isset($_GET["id"]) and isset($_GET["d"])) {

        $result = $objP_->delete($_GET["id"]);
    }
}

if (isset($_GET)) {
    if (isset($_GET["id"]) and isset($_GET["open"])) {

        $result = $objP_->open($_GET["id"]);
    }
}

if (isset($_GET)) {
    if (isset($_GET["id"]) and isset($_GET["close"])) {

        $result = $objP_->close($_GET["id"]);
    }
}

if (isset($_GET)) {
    if (isset($_GET["id"])) {

        $result = $objP_->getPerido($_GET["id"]);

        if (count($result) > 0) {
            $BANDM = true;
            
        }
    }
}

if (isset($_POST)) {
    if (isset($_POST["SET"])) {
        //print_r($_POST);
        $objP_->setPeriodo($data);
    }
}

if (isset($_POST)) {
    if (isset($_POST["EDI"])) {
        //print_r($_POST);
        $objP_->setEditP($data);
    }
}

$num_rows = count($objP_->getPC($data));
$pages = new Paginator();
$pages->items_total = $num_rows;
$pages->paginate();
$datosP = $objP_->getPB($data, $pages->limit);

require_once 'menu.php';
?>
<!doctype html>
<html lang="es">
    <head>
        <title>Sistema de carga horaria docente</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
        include './inc/head_common.php';
        ?>
        <link rel="stylesheet" href="css/cuerpo.css"/>
        
    </head>
    <body>
        <?php include './inc/header.php'; ?>
        <div class="container" id="principal">
            <div class="row">
                <div class="col-xs-12">
                    
                    <div class="alert alert-success paleta" role="alert"><h3>Periodo de carga horaria:</h3>
                </div>
                    <?php require './respuesta.php'; ?>
                    <ul class="nav nav-tabs">
                        <li id="tab1" class="active"><a id="tab1a" data-toggle="tab" href="#home">Buscar</a></li>
                        <li id="tab2"><a id="tab2a" data-toggle="tab" href="#menu1">Agregar</a></li>
                        <!--<li><a data-toggle="tab" href="#menu2">Datos del usuario</a></li>-->
                        <!--<li><a data-toggle="tab" href="#menu3">Menu 3</a></li>-->
                    </ul>

                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                            <h3>Buscar Periodo</h3>
                            <form name="form1" class="form-horizontal" style="text-align: left;" action="p.php" method="POST">
                                <div class="row">
                                    <div class="col-xs-4">
                                        
                                        <div class="form-group">
                                            <label for="anio_lectivo" class="control-label col-xs-5">A&ntilde;o lectivo</label>
                                            <div class="col-xs-7">
                                                <select name="anio_lectivo" class="form-control" id="anio_lectivo">
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>

                                                    <?php
                                                    $anio = date('Y');
                                                    for ($i = $anio-5; $i < $anio+5; $i++) {
                                                        
                                                            ?>
                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                            <?php
                                                        
                                                    }
                                                    ?> 
                                                </select>
                                            </div>
                                        </div>
                                        

                                        <div id="divmo" style="display:none;">

                                            <div class="form-group">
                                            <label for="semestre_id" class="control-label col-xs-5">Semestre</label>
                                            <div class="col-xs-7">
                                                <select name="semestre_id" class="form-control" id="semestre_id">
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>

                                                    <?php
                                                    $sem = $objP_->getStatic_semestre();

                                                    for ($i = 0; $i < count($sem); $i++) {
                                                        
                                                            ?>
                                                            <option value="<?php echo $sem[$i]["id"]; ?>"><?php echo $sem[$i]["nombre"]; ?></option>
                                                            <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>



                                            <div class="form-group">
                                            <label for="estado" class="control-label col-xs-5">Estado</label>
                                            <div class="col-xs-7">
                                                <select name="estado" class="form-control" id="estado">
                                                    <option value="" class="priElement">Seleccione una opci&oacute;n</option>
                                                        <option value="1">Activo</option>
                                                        <option value="0">Cerrado</option>
                                                </select>
                                            </div>
                                        </div> 

                                            
                                        </div>

                                        <div align="center">
                                            <a style="color: black;" href="javascript:void(0);" id="mo">Mostar +</a>
                                        </div>
                                        <div class="clearfix"></div>
                                        <br />
                                        <div class="form-actions">
                                            <button type="submit" name="FIND" class="btn btn-primary">Buscar</button> 
                                            <button class="btn cancel">Cancelar</button>
                                        </div> <!-- /form-actions -->
                                    </div>
                                    <div class="col-xs-8">

                                        <?php
                                        if (count($_COOKIE) > 0) {
                                            $BAND_COOKIE = false;
                                            //print_r($data);
                                            if (isset($data['departamento']) and strlen($data['departamento']) > 0) {
                                                ?>
                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="p.php?cdepartamento=<?php  echo $data['departamento']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Departamento: ";
                                                    echo $data['departamento'];
                                                    $BAND_COOKIE = true;
                                                    ?>
                                                </div>
                                                <?php
                                            } elseif (isset($_COOKIE["departamento"])) {
                                                ?>

                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="p.php?cdepartamento=<?php  echo $_COOKIE['departamento']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Departamento: ";
                                                    echo $_COOKIE["departamento"];
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>
                                                <?php
                                            } 
                                            if (isset($data['facultad']) and strlen($data['facultad']) > 0) {
                                                ?>
                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="p.php?cfacultad=<?php echo $data['facultad']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Facultad: ";
                                                    echo $data['facultad'];
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>


                                                <?php
                                            } elseif (isset($_COOKIE["facultad"])) {
                                                ?>

                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="p.php?cfacultad=<?php echo $_COOKIE['facultad']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Facultad: ";
                                                    echo $_COOKIE["facultad"];
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>

                                                <?php
                                            } 
                                            
                                            if($BAND_COOKIE)
                                            {
                                                ?>
                                        <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                            <a class="close" href="p.php?<?php if (isset($data['anio_lectivo'])){ echo "cdepartamento=".$data['departamento']; } elseif (isset($_COOKIE['departamento'])) { echo "cdepartamento=".$_COOKIE['departamento']; } ?><?php if (isset($data['facultad'])){ echo "&cfacultad=".$data['facultad']; } elseif (isset($_COOKIE['facultad'])) { echo "&cfacultad=".$_COOKIE['facultad']; } ?>">&times;</a>                        
                                                    <?php
                                                    echo "Eliminar todos los par&aacute;metros ";
                                                    ?>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>



                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>A&ntilde;o lectivo</th>
                                                    <th>Semestre</th>
                                                    <th>Estado</th>
                                                    
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                //print_r($datosU);
                                                $BAND_A = false;//Despues de aqui compruebas si hay periodos activos, si lo hay no habilitas el habilitar periodo
                                                foreach($datosP as $valores)
                                                {
                                                       if ($valores['estado'] == 1)
                                                           $BAND_A = true;
                                                }
                                                for ($i = 0; $i < count($datosP); $i++) {
                                                    
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $datosP[$i]["anio_lectivo"]; ?></td>
                                                        <td><?php 
                                                        $sem = p::getStatic_semestreII($datosP[$i]["semestre_id"]);
                                                        foreach ($sem as $dato)
                                                        {
                                                            echo $dato['nombre'];
                                                        }
                                                        ?></td>
                                                        <td><?php if ($datosP[$i]["estado"] == 1) { ?> <a data-toggle="tooltip" title="Cerrar periodo" href="p.php?id=<?php echo $datosP[$i]["id"]; ?>&close=true"><i class="fa fa-folder-open-o fa-2x"></i></a> <?php }else { ?> <a data-toggle="tooltip" title="Abrir periodo" <?php if ($BAND_A){ ?>href="#"<?php } else { ?>href="p.php?id=<?php echo $datosP[$i]["id"]; ?>&open=true"<?php }?>><i class="fa fa-folder-o fa-2x"></i> </a><?php } ?></td>
                                                        
                                                        <td><a data-toggle="tooltip" title="Modificar" href="p.php?id=<?php echo $datosP[$i]["id"]; ?>"><i class="fa fa-pencil-square-o fa-2x"></i>
                                                            </a></td>
                                                            <td><a id="eli" data-toggle="tooltip" title="Eliminar" onclick="alertDelete('p.php?id=<?php echo $datosP[$i]["id"]; ?>&d=true')" href="#"><i class="fa fa-trash-o fa-2x"></i></a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>


                                            </tbody>
                                        </table>

                                        <nav>
                                            <ul class="pagination">
                                                <li>


                                                </li>
                                                <?php
                                                echo $pages->display_pages();
                                                ?>
                                                <li>

                                                </li>
                                            </ul>
                                        </nav>
                                        <i>Nota: Para abrir un per&iacute;do, todos deben estar cerrados</i>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <form name="form2" id="form2" class="form-horizontal" style="text-align: left;" action="p.php" method="POST">

                                <div class="row">
                                    <h4>Datos del Periodo</h4>
                                    <div class="control-label col-xs-6">
                                        
                                        <div class="form-group">
                                            <label for="finicio" class="control-label col-xs-5">Inicio</label>
                                            <div class="col-xs-7">
                                                <input autocomplete="off" type="date" onkeyup=" " name="finicio" required="require" class="form-control" id="finicio" value="<?php
                                                if ($BANDM) { echo date('Y-m-d', $result[0]["finicio"]); } ?>">
                                                <?php
                                                if ($BANDM) {?>
                                                
                                                <input type="hidden" name="id" required="require" id="id" value="<?php echo $result[0]["id"]; ?>">
                                                    <?php }
                                               ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label autocomplete="off" for="ffin" class="control-label col-xs-5">Fin</label>
                                            <div class="col-xs-7">
                                                <input type="date" name="ffin" required="require" class="form-control" id="ffin" value="<?php
                                                if ($BANDM) {
                                                    echo date('Y-m-d', $result[0]["ffin"]);
                                                }
                                                ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="semestre_id" class="control-label col-xs-5">Semestre</label>
                                            <div class="col-xs-7">
                                                <select name="semestre_id" class="form-control" id="semestre_id" required>
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>

                                                    <?php
                                                    $sem = $objP_->getStatic_semestre();

                                                    for ($i = 0; $i < count($sem); $i++) {
                                                        if ($BANDM) {

                                                            if ($result[0]["semestre_id"] == $sem[$i]["id"]) {
                                                                ?>
                                                                <option value="<?php echo $sem[$i]["id"]; ?>" selected="selected"> <?php echo $sem[$i]["nombre"]; ?></option>
                                                                <?php
                                                            } else {
                                                                ?>

                                                                <option value="<?php echo $sem[$i]["id"]; ?>"><?php echo $sem[$i]["nombre"]; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="<?php echo $sem[$i]["id"]; ?>"><?php echo $sem[$i]["nombre"]; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="control-label col-xs-6">
                                        <div class="form-group">
                                            <label for="anio_lectivo" class="control-label col-xs-5">A&ntilde;o lectivo</label>
                                            <div class="col-xs-7">
                                                <select name="anio_lectivo" class="form-control" id="anio_lectivo" required>
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>

                                                    <?php
                                                    $anio = date('Y');
                                                    for ($i = $anio-5; $i < $anio+5; $i++) {
                                                        if (BANDM and $result[0]["anio_lectivo"] == $i)
                                                        {
                                                            ?>
                                                    <option selected="selected" value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                            <?php
                                                        
                                                    }}
                                                    ?> 
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="estado" class="control-label col-xs-5">Estado</label>
                                            <div class="col-xs-7">
                                                <select name="estado" class="form-control" id="estado_v" required onchange="cambiarValor(this.value)">
                                                    <option value="" class="priElement">Seleccione una opci&oacute;n</option>
                                                    <?php
                                                    
                                                    $select = 0;
                                                    if ($BANDM) {
                                                        if ($result[0]["estado"] == "1") {
                                                            $select = 1;
                                                            ?>
                                                            <option value="1" selected="selected">Activo</option>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option value="1">Activo</option>
                                                            <?php
                                                        }
                                                        ?>

                                                        <?php
                                                        if ($result[0]["estado"] == "0") {
                                                            $select = 0;
                                                            ?>
                                                            <option value="0" selected="selected">Cerrado</option>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option value="0">Cerrado</option>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <option value="1">Activo</option>
                                                        <option value="0">Cerrado</option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                
                                                <input type="hidden" value="<?php if ($BANDM) echo $select; ?>" id="select">
                                               
                                            </div>
                                        </div> 

                                        <div class="form-group">
                                            <label for="descripcion" class="control-label col-xs-5">Descripci&oacute;n</label>
                                            <div class="col-xs-7">
                                                <textarea class="form-control" id="descripcion" name="descripcion"><?php
                                                if ($BANDM) {
                                                    echo $result[0]["descripcion"];
                                                }
                                                ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                <div class="form-actions">
                                    <?php
                                    if (!$BANDM) {
                                    ?>
                                    <input type="hidden" name="SET" id="SET" value="SET" />
                                    <button type="submit" name="enviar" id="enviar" class="btn btn-primary" onclick="return periodoActivoP('cajax/periodo_activo.php', 'cajax/desactivar_periodo.php', document.form2.finicio.value, document.form2.ffin.value)">Agregar Periodo</button> 
                                    <?php
                                    }  else {
                                        ?>
                                        <input type="hidden" name="EDI" id="EDI" value="EDI" />
                                        <button type="submit" name="enviar" id="enviar" class="btn btn-primary" onclick="return periodoActivoP('cajax/periodo_activo.php', 'cajax/desactivar_periodo.php', document.form2.finicio.value, document.form2.ffin.value)">Modificar Periodo</button> 
                                        <?php
                                    }
                                    ?>
                                    <button class="btn cancel">Cancelar</button>
                                </div> <!-- /form-actions -->
                            </form>
                        </div>
                        <!--                        <div id="menu2" class="tab-pane fade">
                                                    <h3>Datos del usuario</h3>
                                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                                                </div>-->
                        <!--    <div id="menu3" class="tab-pane fade">
                              <h3>Menu 3</h3>
                              <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                            </div>-->
                    </div>
                </div>
            </div>

        </div>
        <input id="BAND" value="<?php echo $BANDM; ?>" type="hidden"></span>
<?php
include './inc/footer.php';
?>

<?php
include './inc/footer_common.php';
?>
    <script>
        $(document).on('ready', function () {
            var BAND = document.getElementById("BAND").value;
            var tab1 = document.getElementById('tab1');
            var tab2 = document.getElementById('tab2');

            var home = document.getElementById('home');
            var menu1 = document.getElementById('menu1');
            //console.log(atab1);
            if (BAND)
            {
                tab1.className = '';
                tab2.className = 'active';
                home.className = 'tab-pane fade';
                menu1.className = 'tab-pane fade active in';
            } else
            {
                tab2.className = '';
                tab1.className = 'active';
                menu1.className = 'tab-pane fade';
                home.className = 'tab-pane fade active in';
                //$('#tab1').css().add("active");
            }
        });
    </script>
</body>
</html>