<?php
//exit();
ob_start();
$data = data();
require_once './core/zona_privada.php';
require_once './core/depocoor.php';
require_once './core/paginator.class.php';
$accion = 0;
$objD_ = new departamento();

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

if (isset($_GET)) {
    if (isset($_GET["id"]) and isset($_GET["d"])) {

        $result = $objD_->delete($_GET["id"]);
    }
}

if (isset($_GET)) {
    if (isset($_GET["id"]) and isset($_GET["open"])) {

        $result = $objD_->open($_GET["id"]);
    }
}

if (isset($_GET)) {
    if (isset($_GET["id"]) and isset($_GET["close"])) {

        $result = $objD_->close($_GET["id"]);
    }
}

if (isset($_GET)) {
    if (isset($_GET["id"])) {

        $result = $objD_->getDepartamento($_GET["id"]);

        if (count($result) > 0) {
            $BANDM = true;
            
        }
    }
}

if (isset($_POST)) {
    if (isset($_POST["SET"])) {
        //print_r($_POST);
        $objD_->setDepartamento($data);
    }
}

if (isset($_POST)) {
    if (isset($_POST["EDI"])) {
        //print_r($_POST);
        $objD_->setEditP($data);
    }
}

$num_rows = count($objD_->getDC($data));


$pages = new Paginator();
$pages->items_total = $num_rows;
$pages->paginate();
$datosD = $objD_->getDB($data, $pages->limit);

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
                            <h3>Buscar Departamento</h3>
                            <form name="form1" class="form-horizontal" style="text-align: left;" action="dc.php" method="POST">
                                <div class="row">
                                    <div class="col-xs-4">
                                        
                                        <div class="form-group">
                                            <label for="Departamento" class="control-label col-xs-5">A&ntilde;o lectivo</label>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" name="departamento" id="departamento" />
                                            </div>
                                        </div>
                                        

                                        <div id="divmo" style="display:none;">

                                            <div class="form-group">
                                            <label for="facultad" class="control-label col-xs-5">Facultad</label>
                                            <div class="col-xs-7">
                                                <select name="facultad" class="form-control" id="semestre_id">
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>

                                                    <?php
                                                    $fac = $objD_->getStatic_facultad();

                                                    for ($i = 0; $i < count($fac); $i++) {
                                                        
                                                            ?>
                                                            <option value="<?php echo $fac[$i]["idfacultad"]; ?>"><?php echo $fac[$i]["facultad"]; ?></option>
                                                            <?php
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
                                            if (isset($data['departamento']) and strlen($data['departamento']) > 0) {
                                                ?>
                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="dc.php?cdepartamento=<?php  echo $data['departamento']; ?>">&times;</a>                        
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
                                                    <a class="close" href="dc.php?cdepartamento=<?php  echo $_COOKIE['departamento']; ?>">&times;</a>                        
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
                                                    <a class="close" href="dc.php?cfacultad=<?php echo $data['facultad']; ?>">&times;</a>                        
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
                                                    <a class="close" href="dc.php?cfacultad=<?php echo $_COOKIE['facultad']; ?>">&times;</a>                        
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
                                            <a class="close" href="dc.php?<?php if (isset($data['departamento'])){ echo "cdepartamento=".$data['departamento']; } elseif (isset($_COOKIE['departamento'])) { echo "cdepartamento=".$_COOKIE['departamento']; } ?><?php if (isset($data['facultad'])){ echo "&cfacultad=".$data['facultad']; } elseif (isset($_COOKIE['facultad'])) { echo "&cfacultad=".$_COOKIE['facultad']; } ?>">&times;</a>                        
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
                                                    <th>Departamento</th>
                                                    <th>Faultad</th>
                                                    
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
                                                        <td><?php echo $datosD[$i]["departamento"]; ?></td>
                                                        <td><?php 
                                                        echo $datosD[$i]["facultad"];
                                                        
                                                        ?></td>
                                                        
                                                        <td><a data-toggle="tooltip" title="Modificar" href="dc.php?id=<?php echo $datosD[$i]["id"]; ?>"><i class="fa fa-pencil-square-o fa-2x"></i>
                                                            </a></td>
                                                            <td><a id="eli" data-toggle="tooltip" title="Eliminar" onclick="alertDelete('dc.php?id=<?php echo $datosD[$i]["id"]; ?>&d=true')" href="#"><i class="fa fa-trash-o fa-2x"></i></a>
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
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <form name="form2" id="form2" class="form-horizontal" style="text-align: left;" action="dc.php" method="POST">

                                <div class="row">
                                    <h4>Datos del Departamento</h4>
                                    <div class="control-label col-xs-6">
                                        
                                        <div class="form-group">
                                            <label for="departamento" class="control-label col-xs-5">Departamento</label>
                                            <div class="col-xs-7">
                                                <input type="text" required name="departamento" id="departamento" value="<?php
                                                if($BANDM)
                                                {
                                                    echo $result[0]["departamento"];
                                                }
?>" class="form-control" />
                                                
                                                <input type="hidden" required name="iddepartamento" value="<?php
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
                                            <label for="facultad" class="control-label col-xs-5">Facultad</label>
                                            <div class="col-xs-7">
                                                <select name="facultad" class="form-control" id="facultad">
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>

                                                    <?php
                                                    $fac = $objD_->getStatic_facultad();
                                                    if($BANDM)
                                                    {
                                                        for ($i = 0; $i < count($fac); $i++) {
                                                        if($result[0]["_idfacultad"] == $fac[$i]["idfacultad"])
                                                        {
                                                            ?>
                                                        
                                                    <option selected value="<?php echo $fac[$i]["idfacultad"]; ?>"><?php echo $fac[$i]["facultad"]; ?></option>
                                                        <?php }
                                                        else
                                                        {
                                                            ?>
                                                    
                                                            <option value="<?php echo $fac[$i]["idfacultad"]; ?>"><?php echo $fac[$i]["facultad"]; ?></option>
                                                            <?php
                                                    }
                                                    
                                                        }
                                                    }  else {
                                                        

                                                    $doc = $objD_->getStatic_facultadUSER($_SESSION["user"]);
                                                    for ($i = 0; $i < count($fac); $i++) {
                                                        if($doc[0]["idfacultad"] == $fac[$i]["idfacultad"])
                                                        {
                                                            ?>
                                                        
                                                    <option selected value="<?php echo $fac[$i]["idfacultad"]; ?>"><?php echo $fac[$i]["facultad"]; ?></option>
                                                        <?php }
                                                        else
                                                        {
                                                            ?>
                                                    
                                                            <option value="<?php echo $fac[$i]["idfacultad"]; ?>"><?php echo $fac[$i]["facultad"]; ?></option>
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
                                        <button type="submit" name="enviar" id="enviar" class="btn btn-primary">Modificar Departamento</button> 
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
</body>
</html>