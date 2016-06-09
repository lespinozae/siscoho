<?php
//exit();
ob_start();
$data = data();
require_once './core/zona_privada.php';
require_once './core/class.car.php';
require_once './core/paginator.class.php';
$accion = 0;
$objC_ = new carreras();

function data() {
    $data = array();
    if (array_key_exists('id', $_POST)) {
        $data["id"] = $_POST['id'];
    }
    
    if (isset($_COOKIE['carreras'])) {
        $data["carreras"] = $_COOKIE['carreras'];
        if(strlen($_COOKIE['carreras']) > 0)
            setcookie('carreras', $_COOKIE['carreras'], time() + 3600);
    }else
    if (array_key_exists('carreras', $_POST)) {
        $data["carreras"] = $_POST['carreras'];
        if(strlen($_POST['carreras']) > 0)
            setcookie('carreras', $_POST['carreras'], time() + 3600);
    } else
    if (array_key_exists('carreras', $_GET)) {
        $data["carreras"] = $_GET['carreras'];
        if(strlen($_GET['carreras']) > 0)
            setcookie('carreras', $_GET['carreras'], time() + 3600);
    }
    
    if (isset($_COOKIE['departamento'])) {
        $data["departamento"] = $_COOKIE['departamento'];
        if(strlen($_COOKIE['departamento']))
            setcookie('departamento', $_COOKIE['departamento'], time() + 3600);
    }else
    if (array_key_exists('departamento', $_POST)) {
        $data["departamento"] = $_POST['departamento'];
        if(strlen($_POST['departamento']))
            setcookie('departamento', $_POST['departamento'], time() + 3600);
    } else
    if (array_key_exists('departamento', $_GET)) {
        $data["departamento"] = $_GET['departamento'];
        if(strlen($_GET['departamento']))
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
    if (array_key_exists('ccarreras', $_GET)) {
        setCookie('carreras', '', time() - 5000);
        $BAND_DELETE_COOKIE = true;
    }
    if (array_key_exists('cdepartamento', $_GET)) {
        setCookie('departamento', '', time() - 5000);
        $BAND_DELETE_COOKIE = true;
    }
    
    if (array_key_exists('cfacultad', $_GET)) {
        setCookie('facultad', '', time() - 5000);
        $BAND_DELETE_COOKIE = true;
    }
    if (array_key_exists('cfacultad', $_GET)) {
        setCookie('facultad', '', time() - 5000);
        $BAND_DELETE_COOKIE = true;
    }
    if($BAND_DELETE_COOKIE)
    {
        header("Location: car.php");
    }
    ob_end_flush(); 
    //print_r($_COOKIE);
    //exit();
    return $data;
}

$BANDM = false;

if (isset($_GET)) {
    if (isset($_GET["id"]) and isset($_GET["d"])) {

        $result = $objC_->delete($_GET["id"]);
    }
}

if (isset($_GET)) {
    if (isset($_GET["id"])) {

        $result = $objC_->getCarrera($_GET["id"]);

        if (count($result) > 0) {
            $BANDM = true;
            
        }
    }
}

if (isset($_POST)) {
    if (isset($_POST["SET"])) {
        //print_r($_POST);
        $objC_->setCarrera($data);
    }
}

if (isset($_POST)) {
    if (isset($_POST["EDI"])) {
        //print_r($_POST);
        $objC_->setEditC($data);
    }
}

$num_rows = count($objC_->getDC($data));


$pages = new Paginator();
$pages->items_total = $num_rows;
$pages->paginate();
$datosD = $objC_->getDB($data, $pages->limit);


require_once 'menu.php';
?>
<!doctype html>
<html lang="es">
    <head>
        <title>Sistema de carrerasga horaria docente</title>
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
                    
                    <div class="alert alert-success paleta" role="alert"><h3>Carrera:</h3>
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
                            <h3>Buscar Departamento</h3>
                            <form name="form1" class="form-horizontal" style="text-align: left;" action="car.php" method="POST">
                                <div class="row">
                                    <div class="col-xs-4">
                                        
                                        <div class="form-group">
                                            <label for="carreras" class="control-label col-xs-5">Carrera</label>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" name="carreras" id="carreras" />
                                            </div>
                                        </div>
                                        

                                        <div id="divmo" style="display:none;">

                                            <div class="form-group">
                                            <label for="departamento" class="control-label col-xs-5">Departamento</label>
                                            <div class="col-xs-7">
                                                <select name="departamento" class="form-control" id="semestre_id">
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>

                                                    <?php
                                                    $fac = $objC_->getStatic_departamento();
                                                    //print_r($fac);
                                                    $doc = $objC_->getStatic_departamentoUSER($_SESSION["user"]);
                                                    for ($i = 0; $i < count($fac); $i++) {
                                                        if($doc[0]["id"] == $fac[$i]["id"])
                                                        {
                                                            ?>
                                                        
                                                    <option selected value="<?php echo $fac[$i]["id"]; ?>"><?php echo $fac[$i]["departamento"]; ?></option>
                                                        <?php }
                                                        else
                                                        {
                                                            ?>
                                                    
                                                            <option value="<?php echo $fac[$i]["id"]; ?>"><?php echo $fac[$i]["departamento"]; ?></option>
                                                            <?php
                                                    }
                                                    
                                                        }
                                                    ?>
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
                                            if (isset($data['carreras']) and strlen($data['carreras']) > 0) {
                                                ?>
                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="car.php?ccarreras=<?php  echo $data['carreras']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Carrera: ";
                                                    echo $data['carreras'];
                                                    $BAND_COOKIE = true;
                                                    ?>
                                                </div>
                                                <?php
                                            } elseif (isset($_COOKIE["carreras"])) {
                                                ?>

                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="car.php?ccarreras=<?php  echo $_COOKIE['carreras']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Carrera: ";
                                                    echo $_COOKIE["carreras"];
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>
                                                <?php
                                            } 
                                            if (isset($data['departamento']) and strlen($data['departamento']) > 0) {
                                                ?>
                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="car.php?cdepartamento=<?php echo $data['departamento']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Departamento: ";
                                                     echo carreras::getStatic_departamentoETIQUETA($data["departamento"])[0]["departamento"];
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>


                                                <?php
                                            } elseif (isset($_COOKIE["departamento"])) {
                                                ?>

                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="car.php?cdepartamento=<?php echo $_COOKIE['departamento']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Departamento: ";
                                                    echo carreras::getStatic_departamentoETIQUETA($_COOKIE["departamento"])[0]["departamento"];
                                                    
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>

                                               <?php
                                            } 
                                            if (isset($data['facultad']) and strlen($data['facultad']) > 0) {
                                                ?>
                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="dc.php?cfacultad=<?php echo $data['facultad']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Facultad: ";
                                                     echo departamento::getStatic_facultadETIQUETA($data["facultad"])[0]["facultad"];
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>


                                                <?php
                                            } elseif (isset($_COOKIE["facultad"])) {
                                                ?>

                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="dc.php?cfacultad=<?php echo $_COOKIE['facultad']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Facultad: ";
                                                    echo departamento::getStatic_facultadETIQUETA($_COOKIE["facultad"])[0]["facultad"];
                                                    
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>

                                                <?php
                                            } 
                                            
                                            if($BAND_COOKIE)
                                            {
                                                ?>
                                        <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                            <a class="close" href="car.php?<?php if (isset($data['carreras'])){ echo "ccarreras=".$data['carreras']; } elseif (isset($_COOKIE['carreras'])) { echo "ccarreras=".$_COOKIE['carreras']; } ?><?php if (isset($data['departamento'])){ echo "&cdepartamento=".$data['departamento']; } elseif (isset($_COOKIE['departamento'])) { echo "&cdepartamento=".$_COOKIE['departamento']; } ?>">&times;</a>                        
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
                                                    <th>Carrera</th>
                                                    <th>Departamento</th>
                                                    
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                //print_r($datosU);
                                                
                                                for ($i = 0; $i < count($datosD); $i++) {
                                                    
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $datosD[$i]["carreras"]; ?></td>
                                                        <td><?php 
                                                        echo $datosD[$i]["departamento"];
                                                        
                                                        ?></td>
                                                        
                                                        <td><a data-toggle="tooltip" title="Modificar" href="car.php?id=<?php echo $datosD[$i]["id"]; ?>"><i class="fa fa-pencil-square-o fa-2x"></i>
                                                            </a></td>
                                                            <td><a id="eli" data-toggle="tooltip" title="Eliminar" onclick="alertDelete('car.php?id=<?php echo $datosD[$i]["id"]; ?>&d=true')" href="#"><i class="fa fa-trash-o fa-2x"></i></a>
                                                        </td>
                                                        <td>
                                                            <a data-toggle="tooltip" title="Modalidad" href="mod.php?id=<?php echo $datosD[$i]["id"]; ?>"><i class="fa fa-list-ul fa-2x" aria-hidden="true" ></i></a>
                                                            
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                                          
  <!-- Modal -->
  <div class="modal fade <?php if(isset($_GET["idC"])) { ?> in <?php }?>" <?php if(isset($_GET["idC"])) { ?> style="display: block; padding-left: 0px;" <?php }?> id="<?php if(isset($_GET["idC"])) { ?><?php echo $_GET["idC"]; ?><?php }?>myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Modalidad</h4>
        </div>
        <div class="modal-body">
            <p><a href="mod.php?id=<?php if(isset($_GET["idC"])) { ?><?php echo $_GET["idC"]; ?><?php }?>" class="btn btn-primary">Continuar...</a></p>
        </div>
      </div>
      
    </div>
  </div>
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
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <form name="form2" id="form2" class="form-horizontal" style="text-align: left;" action="car.php" method="POST">

                                <div class="row">
                                    <h4>Datos de la Carrera</h4>
                                    <div class="control-label col-xs-6">
                                        
                                        <div class="form-group">
                                            <label for="carreras" class="control-label col-xs-5">Carrera</label>
                                            <div class="col-xs-7">
                                                <input type="text" required name="carreras" id="carreras" value="<?php
                                                if($BANDM)
                                                {
                                                    echo $result[0]["carreras"];
                                                }
?>" class="form-control" />
                                                
                                                <input type="hidden" required name="id" value="<?php
                                                if($BANDM)
                                                {
                                                    echo $result[0]["id"];
                                                }
?>" class="form-control" />
                                            </div>
                                        </div>
                                        </div>
                                        <div class="control-label col-xs-6">
                                        <div class="form-group">
                                            <label for="departamento" class="control-label col-xs-5">Departamento</label>
                                            <div class="col-xs-7">
                                                <select name="departamento" class="form-control" id="departamento" required>
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>

                                                    <?php
                                                    $fac = $objC_->getStatic_departamento();
                                                    if($BANDM)
                                                    {
                                                        for ($i = 0; $i < count($fac); $i++) {
                                                        if($result[0]["_id"] == $fac[$i]["id"])
                                                        {
                                                            ?>
                                                        
                                                    <option selected value="<?php echo $fac[$i]["id"]; ?>"><?php echo $fac[$i]["departamento"]; ?></option>
                                                        <?php }
                                                        else
                                                        {
                                                            ?>
                                                    
                                                            <option value="<?php echo $fac[$i]["id"]; ?>"><?php echo $fac[$i]["departamento"]; ?></option>
                                                            <?php
                                                    }
                                                    
                                                        }
                                                    }  else {
                                                        

                                                    $doc = $objC_->getStatic_departamentoUSER($_SESSION["user"]);
                                                    for ($i = 0; $i < count($fac); $i++) {
                                                        if($doc[0]["id"] == $fac[$i]["id"])
                                                        {
                                                            ?>
                                                        
                                                    <option selected value="<?php echo $fac[$i]["id"]; ?>"><?php echo $fac[$i]["departamento"]; ?></option>
                                                        <?php }
                                                        else
                                                        {
                                                            ?>
                                                    
                                                            <option value="<?php echo $fac[$i]["id"]; ?>"><?php echo $fac[$i]["departamento"]; ?></option>
                                                            <?php
                                                    }
                                                    
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                </div>
                                <div class="form-actions">
                                    <?php
                                    if (!$BANDM) {
                                    ?>
                                    <input type="hidden" name="SET" id="SET" value="SET" />
                                    <button type="submit" name="enviar" id="enviar" class="btn btn-primary" >Agregar Departamento</button> 
                                    <?php
                                    }  else {
                                        ?>
                                        <input type="hidden" name="EDI" id="EDI" value="EDI" />
                                        <button type="submit" name="enviar" id="enviar" class="btn btn-primary">Modificarreras Departamento</button> 
                                        <?php
                                    }
                                    ?>
                                    <button class="btn cancel">Cancelar</button>
                                </div> <!-- /form-actions -->
                                </div>
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
        <input id="BAND" value="<?php echo $BANDM; ?>" type="hidden">
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
    <?php if(isset($_GET["idC"])) { ?><div class="modal-backdrop fade in"></div><?php } ?>
</body>
</html>