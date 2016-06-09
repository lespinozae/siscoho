<?php
//exit();
ob_start();
$data = data();
require_once './core/zona_privada.php';
require_once './core/class.asig.php';
require_once './core/paginator.class.php';
$accion = 0;
$objA_ = new asignatura();

function data() {
    $data = array();
    if (array_key_exists('id', $_POST)) {
        $data["id"] = $_POST['id'];
    }
    
    if (isset($_COOKIE['asignatura'])) {
        $data["asignatura"] = $_COOKIE['asignatura'];
        if(strlen($_COOKIE['asignatura']) > 0)
            setcookie('asignatura', $_COOKIE['asignatura'], time() + 3600);
    }else
    if (array_key_exists('asignatura', $_POST)) {
        $data["asignatura"] = $_POST['asignatura'];
        if(strlen($_POST['asignatura']) > 0)
            setcookie('asignatura', $_POST['asignatura'], time() + 3600);
    } else
    if (array_key_exists('asignatura', $_GET)) {
        $data["asignatura"] = $_GET['asignatura'];
        if(strlen($_GET['asignatura']) > 0)
            setcookie('asignatura', $_GET['asignatura'], time() + 3600);
    }
    
    if (isset($_COOKIE['plan'])) {
        $data["plan"] = $_COOKIE['plan'];
        if(strlen($_COOKIE['plan']) > 0)
            setcookie('plan', $_COOKIE['plan'], time() + 3600);
    }else
    if (array_key_exists('plan', $_POST)) {
        $data["plan"] = $_POST['plan'];
        if(strlen($_POST['plan']) > 0)
            setcookie('plan', $_POST['plan'], time() + 3600);
    } else
    if (array_key_exists('plan', $_GET)) {
        $data["plan"] = $_GET['plan'];
        if(strlen($_GET['plan']) > 0)
            setcookie('plan', $_GET['plan'], time() + 3600);
    }
    
    if (isset($_COOKIE['anio'])) {
        $data["anio"] = $_COOKIE['anio'];
        if(strlen($_COOKIE['anio']) > 0)
            setcookie('anio', $_COOKIE['anio'], time() + 3600);
    }else
    if (array_key_exists('anio', $_POST)) {
        $data["anio"] = $_POST['anio'];
        if(strlen($_POST['anio']) > 0)
            setcookie('anio', $_POST['anio'], time() + 3600);
    } else
    if (array_key_exists('anio', $_GET)) {
        $data["anio"] = $_GET['anio'];
        if(strlen($_GET['anio']) > 0)
            setcookie('anio', $_GET['anio'], time() + 3600);
    }
    
    if (isset($_COOKIE['turno_idturno'])) {
        $data["turno_idturno"] = $_COOKIE['turno_idturno'];
        if(strlen($_COOKIE['turno_idturno']))
            setcookie('turno_idturno', $_COOKIE['turno_idturno'], time() + 3600);
    }else
    if (array_key_exists('turno_idturno', $_POST)) {
        $data["turno_idturno"] = $_POST['turno_idturno'];
        if(strlen($_POST['turno_idturno']))
            setcookie('turno_idturno', $_POST['turno_idturno'], time() + 3600);
    } else
    if (array_key_exists('turno_idturno', $_GET)) {
        $data["turno_idturno"] = $_GET['turno_idturno'];
        if(strlen($_GET['turno_idturno']))
            setcookie('turno_idturno', $_GET['turno_idturno'], time() + 3600);
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
    if (array_key_exists('casignatura', $_GET)) {
        setCookie('asignatura', '', time() - 5000);
        $BAND_DELETE_COOKIE = true;
    }
    if (array_key_exists('cplan', $_GET)) {
        setCookie('plan', '', time() - 5000);
        $BAND_DELETE_COOKIE = true;
    }
    if (array_key_exists('canio', $_GET)) {
        setCookie('anio', '', time() - 5000);
        $BAND_DELETE_COOKIE = true;
    }
    if (array_key_exists('cturno_idturno', $_GET)) {
        setCookie('turno_idturno', '', time() - 5000);
        $BAND_DELETE_COOKIE = true;
    }
    
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
    
    if($BAND_DELETE_COOKIE)
    {
        header("Location: asig.php");
    }
    ob_end_flush(); 
    //print_r($_COOKIE);
    //exit();
    return $data;
}

$BANDM = false;

if (isset($_GET)) {
    if (isset($_GET["id"]) and isset($_GET["d"])) {

        $result = $objA_->delete($_GET["id"]);
    }
}

if (isset($_GET)) {
    if (isset($_GET["id"])) {

        $result = $objA_->getDepartamento($_GET["id"]);

        if (count($result) > 0) {
            $BANDM = true;
            
        }
    }
}

if (isset($_POST)) {
    if (isset($_POST["SET"])) {
        //print_r($_POST);
        $objA_->setDepartamento($data);
    }
}

if (isset($_POST)) {
    if (isset($_POST["EDI"])) {
        //print_r($_POST);
        $objA_->setEditD($data);
    }
}

$num_rows = count($objA_->getDC($data));


$pages = new Paginator();
$pages->items_total = $num_rows;
$pages->paginate();
$datosD = $objA_->getDB($data, $pages->limit);
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
                    
                    <div class="alert alert-success paleta" role="alert"><h3>Asignatura:</h3>
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
                            <h3>Buscar Asignatura</h3>
                            <form name="form1" class="form-horizontal" style="text-align: left;" action="asig.php" method="POST">
                                <div class="row">
                                    <div class="col-xs-4">
                                        
                                        <div class="form-group">
                                            <label for="asignatura" class="control-label col-xs-5">Asignatura</label>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" name="asignatura" id="asignatura" />
                                            </div>
                                        </div>
                                        
                                        

                                        <div id="divmo" style="display:none;">
<div class="form-group">
                                            <label for="facultad" class="control-label col-xs-5">Facultad</label>
                                            <div class="col-xs-7">
                                                <select name="facultad" class="form-control" id="facultad" onchange="from(this.value, 'departamento', 'cajax/departamento.php')">
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>

                                                    <?php
                                                    $fac = $objA_->getStatic_facultad();

                                                    $doc = $objA_->getStatic_facultadUSER($_SESSION["user"]);
                                                    if(count($fac)>0){
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
                                        
                                        <div class="form-group">
                                            <label for="departamento" class="control-label col-xs-5">Departamento</label>
                                            <div class="col-xs-7">
                                                <select name="departamento" class="form-control" id="departamento" onchange="from(this.value, 'carreras', 'cajax/carreras.php')">
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>

                                                    <?php
                                                    $fac = $objA_->getStatic_departamento($doc[0]["idfacultad"]);
                                                    //print_r($fac);
                                                    $doc = $objA_->getStatic_departamentoUSER($_SESSION["user"]);
                                                    if(count($fac)>0){
                                                        ?>
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>
                                                    <?php
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
                                                        else{
                                                            ?>
                                                            <option class="priElement" value="">Seleccione una opci&oacute;n</option>
                                                            <?php
                                                            
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                            
                                            <div class="form-group">
                                            <label for="carreras" class="control-label col-xs-5">Carrera</label>
                                            <div class="col-xs-7">
                                                <select name="carreras" class="form-control" id="carreras" onchange="from(this.value, 'turno_idturno', 'cajax/modalidad.php')">
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>

                                                    <?php
                                                    $carr = $objA_->getStatic_carreras($doc[0]["id"]);
                                                    //print_r($fac);
                                                    
                                                    if(count($carr)>0){
                                                    for ($i = 0; $i < count($carr); $i++) {
                                                        
                                                            ?>
                                                            <option value="<?php echo $carr[$i]["id"]; ?>"><?php echo $carr[$i]["carreras"]; ?></option>
                                                            <?php
                                                    
                                                    }
                                                    
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                            <div class="form-group">
                                            <label for="turno_idturno" class="control-label col-xs-5">Modalidad</label>
                                            <div class="col-xs-7">
                                                <select name="turno_idturno" class="form-control" id="turno_idturno">
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>
                                                </select>
                                            </div>
                                        </div>
                                            
                                            <div class="form-group">
                                            <label for="plan" class="control-label col-xs-5">Plan</label>
                                            <div class="col-xs-7">
                                                <select name="plan" class="form-control" id="plan">
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>
<option value="13">13</option>
                                                   
                                                </select>
                                            </div>
                                        </div>
                                            
                                            <div class="form-group">
                                                <label for="anio" class="control-label col-xs-5">A&ntilde;o</label>
                                            <div class="col-xs-7">
                                                <select name="anio" class="form-control" id="anio">
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
                                                   
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
                                            if (isset($data['asignatura']) and strlen($data['asignatura']) > 0) {
                                                ?>
                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="asig.php?casignatura=<?php  echo $data['asignatura']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Asignatura: ";
                                                    echo $data['asignatura'];
                                                    $BAND_COOKIE = true;
                                                    ?>
                                                </div>
                                                <?php
                                            } elseif (isset($_COOKIE["asignatura"])) {
                                                ?>

                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="asig.php?casignatura=<?php  echo $_COOKIE['asignatura']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Asignatura: ";
                                                    echo $_COOKIE["asignatura"];
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>
                                                <?php
                                            } 
                                            
                                            if (isset($data['facultad']) and strlen($data['facultad']) > 0) {
                                                ?>
                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="asig.php?cfacultad=<?php echo $data['facultad']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Facultad: ";
                                                     echo asignatura::getStatic_facultadETIQUETA($data["facultad"])[0]["facultad"];
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>


                                                <?php
                                            } elseif (isset($_COOKIE["facultad"])) {
                                                ?>

                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="asig.php?cfacultad=<?php echo $_COOKIE['facultad']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Facultad: ";
                                                    echo departamento::getStatic_facultadETIQUETA($_COOKIE["facultad"])[0]["facultad"];
                                                    
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>

                                                <?php
                                            }  
                                            
                                            if (isset($data['departamento']) and strlen($data['departamento']) > 0) {
                                                ?>
                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="asig.php?cdepartamento=<?php echo $data['departamento']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Departamento: ";
                                                     echo asignatura::getStatic_departamentoETIQUETA($data["departamento"])[0]["departamento"];
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>


                                                <?php
                                            } elseif (isset($_COOKIE["departamento"])) {
                                                ?>

                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="asig.php?cdepartamento=<?php echo $_COOKIE['departamento']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Departamento: ";
                                                    echo carreras::getStatic_departamentoETIQUETA($_COOKIE["departamento"])[0]["departamento"];
                                                    
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>

                                               <?php
                                            }
                                            
                                            if (isset($data['carreras']) and strlen($data['carreras']) > 0) {
                                                ?>
                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="asig.php?ccarreras=<?php  echo $data['carreras']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Carrera: ";
                                                    echo asignatura::getStatic_CarreraEtiqueta($data['carreras'])[0]["carreras"];
                                                    $BAND_COOKIE = true;
                                                    ?>
                                                </div>
                                                <?php
                                            } elseif (isset($_COOKIE["carreras"])) {
                                                ?>

                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="asig.php?ccarreras=<?php  echo $_COOKIE['carreras']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Carrera: ";
                                                    echo asignatura::getStatic_CarreraEtiqueta($_COOKIE["carreras"])[0]["carreras"];
                                                    
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>
                                                <?php
                                            } 
                                            
                                            
                                            if (isset($data['turno_idturno']) and strlen($data['turno_idturno']) > 0) {
                                                ?>
                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="asig.php?cturno_idturno=<?php echo $data['turno_idturno']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Modalidad: ";
                                                   echo asignatura::getStatic_ModalidadETIQUETA($data["turno_idturno"])[0]["turno"];
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>


                                                <?php
                                            } elseif (isset($_COOKIE["turno_idturno"])) {
                                                ?>

                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="asig.php?cturno_idturno=<?php echo $_COOKIE['turno_idturno']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Modalidad: ";
                                                    echo asignatura::getStatic_ModalidadETIQUETA($_COOKIE["turno_idturno"])[0]["turno"];
                                                    
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>

                                                <?php
                                           
                                            }
                                            
                                             
                                            
                                            if (isset($data['plan']) and strlen($data['plan']) > 0) {
                                                ?>
                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="asig.php?cplan=<?php echo $data['plan']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Plan: ";
                                                     echo $data["plan"];
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>


                                                <?php
                                            } elseif (isset($_COOKIE["plan"])) {
                                                ?>

                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="asig.php?cplan=<?php echo $_COOKIE['plan']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Plan: ";
                                                    echo $_COOKIE["plan"];
                                                    
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>

                                                <?php
                                            } 
                                            
                                            if (isset($data['anio']) and strlen($data['anio']) > 0) {
                                                ?>
                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="asig.php?canio=<?php echo $data['anio']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Año: ";
                                                     echo $data["anio"];
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>


                                                <?php
                                            } elseif (isset($_COOKIE["anio"])) {
                                                ?>

                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="asig.php?canio=<?php echo $_COOKIE['anio']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Año: ";
                                                    echo $_COOKIE["anio"];
                                                    
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>

                                                <?php
                                            } 
                                            
                                            if($BAND_COOKIE)
                                            {
                                                ?>
                                        <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                            <a class="close" href="asig.php?<?php if (isset($data['asignatura'])){ echo "casignatura=".$data['asignatura']; } elseif (isset($_COOKIE['asignatura'])) { echo "casignatura=".$_COOKIE['asignatura']; } ?><?php if (isset($data['turno_idturno'])){ echo "&cturno_idturno=".$data['turno_idturno']; } elseif (isset($_COOKIE['turno_idturno'])) { echo "&cturno_idturno=".$_COOKIE['turno_idturno']; } ?><?php if (isset($data['plan'])){ echo "&cplan=".$data['plan']; } elseif (isset($_COOKIE['plan'])) { echo "&cplan=".$_COOKIE['plan']; } ?><?php if (isset($data['anio'])){ echo "&canio=".$data['anio']; } elseif (isset($_COOKIE['anio'])) { echo "&canio=".$_COOKIE['anio']; } ?><?php if (isset($data['departamento'])){ echo "&cdepartamento=".$data['departamento']; } elseif (isset($_COOKIE['departamento'])) { echo "&cdepartamento=".$_COOKIE['departamento']; } ?><?php if (isset($data['carreras'])){ echo "&ccarreras=".$data['carreras']; } elseif (isset($_COOKIE['carreras'])) { echo "&ccarreras=".$_COOKIE['carreras']; } ?><?php if (isset($data['facultad'])){ echo "&cfacultad=".$data['facultad']; } elseif (isset($_COOKIE['facultad'])) { echo "&cfacultad=".$_COOKIE['facultad']; } ?>">&times;</a>                        
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
                                                    <th>Asignatura</th>
                                                    <th>A&ntilde;o</th>
                                                    <th>Plan</th>
                                                    <th>Horas</th>
                                                    <th>Modalidad</th>
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
                                                        <td><?php echo $datosD[$i]["asignaturas"]; ?></td>
                                                        <td><?php 
                                                        echo $datosD[$i]["anio"];
                                                        
                                                        ?></td>
                                                        
                                                        <td><?php 
                                                        echo $datosD[$i]["plan"];
                                                        
                                                        ?></td>
                                                        
                                                        <td><?php 
                                                        echo $datosD[$i]["thoras"];
                                                        
                                                        ?></td>
                                                        
                                                        <td><?php 
                                                        echo $datosD[$i]["turno_idturno"];
                                                        
                                                        ?></td>
                                                        
                                                        <td><a data-toggle="tooltip" title="Modificar" href="asig.php?id=<?php echo $datosD[$i]["idasiganturas"]; ?>"><i class="fa fa-pencil-square-o fa-2x"></i>
                                                            </a></td>
                                                            <td><a id="eli" data-toggle="tooltip" title="Eliminar" onclick="alertDelete('asig.php?id=<?php echo $datosD[$i]["idasiganturas"]; ?>&d=true')" href="#"><i class="fa fa-trash-o fa-2x"></i></a>
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
                            <form name="form2" id="form2" class="form-horizontal" style="text-align: left;" action="asig.php" method="POST">
                                <div class="row">
                                    <h4>Datos del Departamento</h4>
                                    <div class="control-label col-xs-6">
                                        
                                        <div class="form-group">
                                            <label for="asignatura" class="control-label col-xs-5">Departamento</label>
                                            <div class="col-xs-7">
                                                <input type="text" required name="asignatura" id="asignatura" value="<?php
                                                if($BANDM)
                                                {
                                                    echo $result[0]["asignatura"];
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
                                            <label for="turno_idturno" class="control-label col-xs-5">Facultad</label>
                                            <div class="col-xs-7">
                                                <select name="turno_idturno" class="form-control" id="turno_idturno" required>
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>

                                                    <?php
//                                                    $fac = $objA_->getStatic_turno_idturno();
//                                                    if($BANDM)
//                                                    {
//                                                        for ($i = 0; $i < count($fac); $i++) {
//                                                        if($result[0]["_idturno_idturno"] == $fac[$i]["idturno_idturno"])
//                                                        {
//                                                            ?>
                                                        
                                                    <option selected value="//<?php //echo $fac[$i]["idturno_idturno"]; ?>"><?php //echo $fac[$i]["turno_idturno"]; ?></option>
                                                        //<?php //}
//                                                        else
//                                                        {
//                                                            ?>
                                                    
                                                            <option value="//<?php //echo $fac[$i]["idturno_idturno"]; ?>"><?php //echo $fac[$i]["turno_idturno"]; ?></option>
                                                            //<?php
//                                                    }
//                                                    
//                                                        }
//                                                    }  else {
//                                                        
//
//                                                    $doc = $objA_->getStatic_turno_idturnoUSER($_SESSION["user"]);
//                                                    for ($i = 0; $i < count($fac); $i++) {
//                                                        if($doc[0]["idturno_idturno"] == $fac[$i]["idturno_idturno"])
//                                                        {
//                                                            ?>
                                                        
                                                    <option selected value="//<?php //echo $fac[$i]["idturno_idturno"]; ?>"><?php //echo $fac[$i]["turno_idturno"]; ?></option>
                                                        //<?php //}
//                                                        else
//                                                        {
//                                                            ?>
                                                    
                                                            <option value="//<?php //echo $fac[$i]["idturno_idturno"]; ?>"><?php //echo $fac[$i]["turno_idturno"]; ?></option>
                                                            //<?php
//                                                    }
//                                                    
//                                                        }
//                                                    }
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
                                <!-- Aqui va lo que cortaste
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