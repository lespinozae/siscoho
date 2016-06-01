<?php
ob_start();
$data = data();
require_once './core/zona_privada.php';
require_once './core/user.php';
require_once './core/paginator.class.php';
$accion = 0;
$objUser_ = new user();

function data() {
    $data = array();
    if (array_key_exists('cedulam', $_POST)) {
        $data["cedulam"] = $_POST['cedulam'];
    }
    if (isset($_COOKIE['cedula'])) {
        $data["cedula"] = $_COOKIE['cedula'];
        if(strlen($_COOKIE['cedula']) > 0)
            setcookie('cedula', $_COOKIE['cedula'], time() + 3600);
    }else
    if (array_key_exists('cedula', $_POST)) {
        $data["cedula"] = $_POST['cedula'];
        if(strlen($_POST['cedula']) > 0)
            setcookie('cedula', $_POST['cedula'], time() + 3600);
    } else
    if (array_key_exists('cedula', $_GET)) {
        $data["cedula"] = $_GET['cedula'];
        if(strlen($_GET['cedula']))
            setcookie('cedula', $_GET['cedula'], time() + 3600);
    }
    
    if (array_key_exists('inss', $_POST)) {
        $data["inss"] = $_POST['inss'];
    }
    if (isset($_COOKIE['pnombre'])) {
        $data["pnombre"] = $_COOKIE['pnombre'];
        if(strlen($_COOKIE['pnombre']) > 0)
            setcookie('pnombre', $_COOKIE['pnombre'], time() + 3600);
    }else
    if (array_key_exists('pnombre', $_POST)) {
        $data["pnombre"] = $_POST['pnombre'];
        if(strlen($_POST['pnombre']) > 0)
            setcookie('pnombre', $_POST['pnombre'], time() + 3600);
    } else
    if (array_key_exists('pnombre', $_GET)) {
        $data["pnombre"] = $_GET['pnombre'];
        if(strlen($_GET['pnombre']) > 0)
            setcookie('pnombre', $_GET['pnombre'], time() + 3600);
    }
    if (isset($_COOKIE['snombre'])) {
        $data["snombre"] = $_COOKIE['snombre'];
        if(strlen($_COOKIE['snombre']))
            setcookie('snombre', $_COOKIE['snombre'], time() + 3600);
    }else
    if (array_key_exists('snombre', $_POST)) {
        $data["snombre"] = $_POST['snombre'];
        if(strlen($_POST['snombre']))
            setcookie('snombre', $_POST['snombre'], time() + 3600);
    } else
    if (array_key_exists('snombre', $_GET)) {
        $data["snombre"] = $_GET['snombre'];
        if(strlen($_GET['snombre']))
            setcookie('snombre', $_GET['snombre'], time() + 3600);
    } 
    if (isset($_COOKIE['papellido'])) {
        $data["papellido"] = $_COOKIE['papellido'];
        if(strlen($_COOKIE['papellido']))
            setcookie('papellido', $_COOKIE['papellido'], time() + 3600);
    }else
    if (array_key_exists('papellido', $_POST)) {
        $data["papellido"] = $_POST['papellido'];
        if(strlen($_POST['papellido']))
            setcookie('papellido', $_POST['papellido'], time() + 3600);
    } elseif (array_key_exists('papellido', $_GET)) {
        $data["papellido"] = $_GET['papellido'];
        if(strlen($_GET['papellido']))
            setcookie('papellido', $_GET['papellido'], time() + 3600);
    }
    if (isset($_COOKIE['sapellido'])) {
        $data["sapellido"] = $_COOKIE['sapellido'];
        if(strlen($_COOKIE['sapellido']))
            setcookie('sapellido', $_COOKIE['sapellido'], time() + 3600);
    }else
    if (array_key_exists('sapellido', $_POST)) {
        $data["sapellido"] = $_POST['sapellido'];
        if(strlen($_POST['sapellido']))
            setcookie('sapellido', $_POST['sapellido'], time() + 3600);
    } else
    if (array_key_exists('sapellido', $_GET)) {
        $data["sapellido"] = $_GET['sapellido'];
        if(strlen($_GET['sapellido']))
            setcookie('sapellido', $_GET['sapellido'], time() + 3600);
    } 
    
    if (array_key_exists('direccion', $_POST)) {
        $data["direccion"] = $_POST['direccion'];
    }
    
    if (array_key_exists('direccion2', $_POST)) {
        $data["direccion2"] = $_POST['direccion2'];
    }
    if (array_key_exists('sexo', $_POST)) {
        $data["sexo"] = $_POST['sexo'];
    }
    if (array_key_exists('telefono', $_POST)) {
        $data["telefono"] = $_POST['telefono'];
    }
    if (array_key_exists('tc', $_POST)) {
        $data["tc"] = $_POST['tc'];
    }
    if (array_key_exists('cd', $_POST)) {
        $data["cd"] = $_POST['cd'];
    }
    if (array_key_exists('f', $_POST)) {
        $data["f"] = $_POST['f'];
    }
    if (array_key_exists('d', $_POST)) {
        $data["d"] = $_POST['d'];
    }
    if (array_key_exists('cc', $_POST)) {
        $data["cc"] = $_POST['cc'];
    }
    if (array_key_exists('ec', $_POST)) {
        $data["ec"] = $_POST['ec'];
    }
    if (array_key_exists('o', $_POST)) {
        $data["o"] = $_POST['o'];
    }
    if (array_key_exists('n', $_POST)) {
        $data["n"] = $_POST['n'];
    }
    if (array_key_exists('na', $_POST)) {
        $data["na"] = $_POST['na'];
    }
    if (array_key_exists('password', $_POST)) {
        $data["password"] = $_POST['password'];
    }
    if (array_key_exists('tu', $_POST)) {
        $data["tu"] = $_POST['tu'];
    }
    if (array_key_exists('cb', $_POST)) {
        $data["cb"] = $_POST['cb'];
    }
    if (array_key_exists('nb', $_POST)) {
        $data["nb"] = $_POST['nb'];
    }
    if (array_key_exists('ab', $_POST)) {
        $data["ab"] = $_POST['ab'];
    }
    if (array_key_exists('db', $_POST)) {
        $data["db"] = $_POST['db'];
    }
    $BAND_DELETE_COOKIE = false;
    if (array_key_exists('ccedula', $_GET)) {
        setCookie('cedula', '', time() - 5000);
        $BAND_DELETE_COOKIE = true;
    }
    if (array_key_exists('cpnombre', $_GET)) {
        setCookie('pnombre', '', time() - 5000);
        $BAND_DELETE_COOKIE = true;
    }
    if (array_key_exists('cpapellido', $_GET)) {
        setCookie('papellido', '', time() - 5000);
        $BAND_DELETE_COOKIE = true;
    }
    if (array_key_exists('csnombre', $_GET)) {
        setCookie('snombre', '', time() - 5000);
       $BAND_DELETE_COOKIE = true;
    }
    if (array_key_exists('csapellido', $_GET)) {
        setCookie('sapellido', '', time() - 5000);
        $BAND_DELETE_COOKIE = true;
    }
    
    if($BAND_DELETE_COOKIE)
    {
        header("Location: user.php");
    }
    //echo $_COOKIE['pnombre'];
    //setCookie('pnombre', $_COOKIE['pnombre'], time() + 5000);
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
        $result = $objUser_->delete($_GET["id"]);
    }
}

if (isset($_GET)) {
    if (isset($_GET["id"])) {

        $result = $objUser_->getUser($_GET["id"]);

        if (count($result) > 0) {
            $BANDM = true;
            $beneficiario = $objUser_->getBeneficiario($result[0]["id"]);
            $user = $objUser_->getDatoUser($result[0]["id"]);
            if ($result[0]["id"] == $_SESSION["user"]) {
                $accion = 1;
            }
            //exit();
        }
    }
}

if (isset($_POST)) {
    if (isset($_POST["SET"])) {
        $objUser_->setUser($data);
    }
}

if (isset($_POST)) {
    if (isset($_POST["EDI"])) {
        //print_r($_POST);
        $objUser_->setEditUser($data);
    }
}
$num_rows = count($objUser_->getUserC($data));
$pages = new Paginator();
$pages->items_total = $num_rows;
$pages->paginate();
$datosU = $objUser_->getUserB($data, $pages->limit);

require_once 'menu.php';
?>
<script>
    function replaceC()
    {
        var chkbox = document.getElementById('check');

        if (chkbox.checked)
        {
            var obj = document.getElementById("password");
            var datos = obj.value;
            var newO = document.createElement('input');

            newO.setAttribute('type', 'text');
            newO.setAttribute('name', obj.getAttribute('name'));
            newO.setAttribute('id', obj.getAttribute('id'));
            newO.setAttribute('class', obj.getAttribute('class'));
            newO.setAttribute('required', obj.getAttribute('required'));
            newO.value = datos;
            obj.parentNode.replaceChild(newO, obj);
            newO.focus();
        } else
        {
            var obj = document.getElementById("password");
            var datos = obj.value;
            var newO = document.createElement('input');

            newO.setAttribute('type', 'password');
            newO.setAttribute('name', obj.getAttribute('name'));
            newO.setAttribute('id', obj.getAttribute('id'));
            newO.setAttribute('class', obj.getAttribute('class'));
            newO.setAttribute('required', obj.getAttribute('required'));

            newO.value = datos;
            obj.parentNode.replaceChild(newO, obj);
            newO.focus();
        }
    }



    window.onload = function ()
    {
        document.getElementById('check').onchange = replaceC;
    }



</script>
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
        <script src="js/ajax.js" type="text/javascript"></script>

    </head>
    <body>
        <?php include './inc/header.php'; ?>
        <div class="container" id="principal">
            <div class="row">
                <div class="col-xs-12">
                    
                    <div class="alert alert-success paleta" role="alert"><h3>Docentes:</h3>
                        
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
                            <h3>Buscar Docente</h3>
                            <form name="form1" class="form-horizontal" style="text-align: left;" action="user.php" method="POST">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <label for="cedula" class="control-label col-xs-5">C&eacute;dula</label>
                                            <div class="col-xs-7">
                                                <input type="text" name="cedula" class="form-control" />
                                            </div>
                                        </div>

                                        <div id="divmo" style="display:none;">

                                            <div class="form-group">
                                                <label for="pnombre" class="control-label col-xs-5">Primer nombre</label>
                                                <div class="col-xs-7">
                                                    <input type="text" class="form-control" id="pnombre" name="pnombre" />
                                                </div>
                                            </div>



                                            <div class="form-group">
                                                <label for="snombre" class="control-label col-xs-5">Segundo nombre</label>
                                                <div class="col-xs-7">
                                                    <input type="text" class="form-control" id="snombre" name="snombre" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="papellido" class="control-label col-xs-5">Primer apellido</label>
                                                <div class="col-xs-7">
                                                    <input type="text" class="form-control" id="papellido"  name="papellido" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="sapellido" class="control-label col-xs-5">Segundo apellido</label>
                                                <div class="col-xs-7">
                                                    <input type="text" class="form-control" id="sapellido" name="sapellido" />
                                                </div>
                                            </div>
                                        </div>

                                        <div align="center">
                                            <a style="color: black;" href="javascript:void(0);" id="mo">Mostar +</a>
                                        </div>
                                        <div class="clearfix"></div>
                                        <br />
                                        <div class="form-actions">
                                            <button type="submit" name="FIND" class="btn btn-primary">Buscar Docente</button> 
                                            <button class="btn cancel">Cancelar</button>
                                        </div> <!-- /form-actions -->
                                    </div>
                                    <div class="col-xs-8">
                                        

                                        <?php
                                        if (count($_COOKIE) > 0) {
                                            $BAND_COOKIE = false;
                                            //print_r($data);
                                            if (isset($data['cedula']) and strlen($data['cedula']) > 0) {
                                                ?>
                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="user.php?ccedula=<?php echo $data['cedula']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "C&eacute;dula: ";
                                                    echo $data['cedula'];
                                                    $BAND_COOKIE = true;
                                                    ?>
                                                </div>
                                                <?php
                                            } elseif (isset($_COOKIE["cedula"])) {
                                                ?>

                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="user.php?ccedula=<?php echo $_COOKIE['cedula']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "C&eacute;dula: ";
                                                    echo $_COOKIE["cedula"];
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>
                                                <?php
                                            } if (isset($data['pnombre']) and strlen($data['pnombre']) > 0) {
                                                ?>
                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="user.php?cpnombre=<?php echo $data['pnombre']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Primer nombre: ";
                                                    echo $data['pnombre'];
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>


                                                <?php
                                            } elseif (isset($_COOKIE["pnombre"])) {
                                                ?>

                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="user.php?cpnombre=<?php echo $_COOKIE['pnombre']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Primer nombre: ";
                                                    echo $_COOKIE["pnombre"];
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>

                                                <?php
                                            } if (isset($data['snombre']) and strlen($data['snombre']) > 0) {
                                                ?>
                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="user.php?csnombre=<?php echo $data['snombre']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Segundo nombre: ";
                                                    echo $data['snombre'];
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>
                                                <?php
                                            } elseif (isset($_COOKIE["snombre"])) {
                                                ?>

                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="user.php?csnombre=<?php echo $_COOKIE['snombre']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Segundo nombre: ";
                                                    echo $_COOKIE["snombre"];
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>

                                                <?php
                                            } if (isset($data['papellido']) and strlen($data['papellido']) > 0) {
                                                ?>
                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="user.php?cpapellido=<?php echo $data['papellido']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Primer apellido: ";
                                                    echo $data['papellido'];
                                                    ?>

                                                </div>
                                                <?php
                                            } elseif (isset($_COOKIE["papellido"])) {
                                                ?>

                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="user.php?cpapellido=<?php echo $_COOKIE['papellido']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Primer apellido: ";
                                                    echo $_COOKIE["papellido"];
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>
                                                <?php
                                            } if (isset($data['sapellido']) and strlen($data['sapellido']) > 0) {
                                                ?>
                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="user.php?csapellido=<?php echo $data['sapellido']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Segundo apellido: ";
                                                    echo $data['sapellido'];
                                                    $BAND_COOKIE = true;
                                                    ?>

                                                </div>
                                                <?php
                                            } else if (isset($_COOKIE["sapellido"])) {
                                                ?>

                                                <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                                    <a class="close" href="user.php?csapellido=<?php echo $_COOKIE['sapellido']; ?>">&times;</a>                        
                                                    <?php
                                                    echo "Primer apellido: ";
                                                    echo $_COOKIE["sapellido"];
                                                    $BAND_COOKIE = true;
                                                    ?>
                                                </div>

                                                <?php
                                            }
                                            
                                            if($BAND_COOKIE)
                                            {
                                                ?>
                                        <div class="alert alert-warning alert-dismissible espacio_cookie" role="alert">
                                            <a class="close" href="user.php?<?php if (isset($data['cedula'])){ echo "ccedula=".$data['cedula']; } elseif (isset($_COOKIE['cedula'])) { echo "ccedula=".$_COOKIE['cedula']; } ?><?php if (isset($data['pnombre'])){ echo "&cpnombre=".$data['pnombre']; } elseif (isset($_COOKIE['pnombre'])) { echo "&cpnombre=".$_COOKIE['pnombre']; } ?><?php if (isset($data['snombre'])){ echo "&csnombre=".$data['snombre']; } elseif (isset($_COOKIE['snombre'])) { echo "&csnombre=".$_COOKIE['snombre']; } ?><?php if (isset($data['papellido'])){ echo "&cpapellido=".$data['papellido']; } elseif (isset($_COOKIE['papellido'])) { echo "&cpapellido=".$_COOKIE['papellido']; } ?><?php if (isset($data['sapellido'])){ echo "&csapellido=".$data['sapellido']; } elseif (isset($_COOKIE['sapellido'])) { echo "&csapellido=".$_COOKIE['sapellido']; } ?>">&times;</a>                        
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
                                                    <th>C&eacute;dula</th>
                                                    <th>Primer nombre</th>
                                                    <th>Segundo nombre</th>
                                                    <th>Primer apellido</th>
                                                    <th>Segundo apellido</th>
                                                    <th></th>
                                                    <th></th>
                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                //print_r($datosU);
                                               
                                                for ($i = 0; $i < count($datosU); $i++) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $datosU[$i]["cedula"]; ?></td>
                                                        <td><?php echo $datosU[$i]["pnombre"]; ?></td>
                                                        <td><?php echo $datosU[$i]["snombre"]; ?></td>
                                                        <td><?php echo $datosU[$i]["papellido"]; ?></td>
                                                        <td><?php echo $datosU[$i]["sapellido"]; ?></td>
                                                        <td><a data-toggle="tooltip" title="Modificar" href="user.php?id=<?php echo $datosU[$i]["id"]; ?>"><i class="fa fa-pencil-square-o fa-2x"></i>
                                                            </a></td>
                                                            <td><a data-toggle="tooltip" title="Eliminar" class="eli" href="#" onclick="alertDelete('user.php?id=<?php echo $datosU[$i]["id"]; ?>&d=true')"><i class="fa fa-trash-o fa-2x"></i></a>
                                                        </td>
                                                        
                                                            <td>
                                                            <a data-toggle="tooltip" title="Carga" href="c.php?id=<?php echo $datosU[$i]["id"]; ?>"><i class="fa fa-book fa-2x"></i>
                                                            </a></td>
                                                            
                                                            
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
                            <form name="form2" class="form-horizontal" style="text-align: left;" action="user.php" method="POST">

                                <div class="row">
                                    
                                    <div class="control-label col-xs-4">
                                        
                                        <h4>Datos del Docente</h4>
                                        <div class="form-group">
                                            <label for="cedula" class="control-label col-xs-5">C&eacute;dula</label>
                                            <div class="col-xs-7">
                                                <input autocomplete="off" type="text" onkeyup="docenteExistente(this.value, 'hiddeHit', 'cajax/usere.php')" name="cedula" required="require" class="form-control" <?php if ($accion == 1) { ?> disabled <?php } ?> id="cedula" value="<?php
                                                if ($BANDM) {
                                                    echo $result[0]["cedula"];
                                                }
                                                ?>">
                                                <?php
                                                if ($BANDM) {?>
                                                
                                                <input type="hidden" name="cedulam" required="require" id="cedulam" value="<?php echo $result[0]["id"]; ?>">
                                                    <?php }
                                               ?>
                                                   <?php if ($accion == 1) { ?> <p class="help-block">Tu nombre de usuario esta siendo usado y no puede ser modificado.</p><?php } ?>
                                                <p class="help-block" id="hiddeHit" style="font-size: 12px;"></p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inss" class="control-label col-xs-5">INSS</label>
                                            <div class="col-xs-7">
                                                <input type="text" name="inss" class="form-control" id="inss" value="<?php
                                                if ($BANDM) {
                                                    echo $result[0]["inss"];
                                                }
                                                ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="pnombre" class="control-label col-xs-5">Primer nombre</label>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" id="pnombre" required="require" name="pnombre" value="<?php
                                                if ($BANDM) {
                                                    echo $result[0]["pnombre"];
                                                }
                                                ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="snombre" class="control-label col-xs-5">Segundo nombre</label>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" id="snombre" name="snombre" value="<?php
                                                if ($BANDM) {
                                                    echo $result[0]["snombre"];
                                                }
                                                ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="papellido" class="control-label col-xs-5">Primer apellido</label>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" id="papellido" required="require" name="papellido" value="<?php
                                                if ($BANDM) {
                                                    echo $result[0]["papellido"];
                                                }
                                                ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="sapellido" class="control-label col-xs-5">Segundo apellido</label>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" id="sapellido" name="sapellido" value="<?php
                                                if ($BANDM) {
                                                    echo $result[0]["sapellido"];
                                                }
                                                ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="email" class="control-label col-xs-5">Correo</label>
                                            <div class="col-xs-7">
                                                <input type="email" name="direccion" class="form-control" id="email" required="required" value="<?php
                                                if ($BANDM) {
                                                    echo $result[0]["direccion"];
                                                }
                                                ?>" >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="sexo" class="control-label col-xs-5">Sexo</label>
                                            <div class="col-xs-7">
                                                <select name="sexo" class="form-control" id="sexo" required>
                                                    <option value="" class="priElement">Seleccione una opci&oacute;n</option>
                                                    <?php
                                                    if ($BANDM) {
                                                        if ($result[0]["sexo"] == "M") {
                                                            ?>
                                                            <option value="M" selected="selected">M</option>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option value="M">M</option>
                                                            <?php
                                                        }
                                                        ?>

                                                        <?php
                                                        if ($result[0]["sexo"] == "F") {
                                                            ?>
                                                            <option value="F" selected="selected">F</option>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option value="F">F</option>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <option value="M">M</option>
                                                        <option value="F">F</option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>             
                                        <div class="form-group">
                                            <label for="telefono" class="control-label col-xs-5">Tel&eacute;fono</label>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php
                                                if ($BANDM) {
                                                    echo $result[0]["telefono"];
                                                }
                                                ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="direccion2"  class="control-label col-xs-5">Direcci&oacute;n</label>
                                            <div class="col-xs-7">
                                                <textarea class="form-control" name="direccion2" id="direccion2" cols="26" rows="10"><?php
                                                if ($BANDM) {
                                                    echo $result[0]["direccion2"];
                                                }
                                                ?></textarea>
                                                
                                            </div>
                                        </div>


                                    </div>
                                    <div class="control-label col-xs-5">
                                        <h4>Datos acad&eacute;micos</h4>
                                        <div class="form-group">
                                            <label for="tc" class="control-label col-xs-6">Tipo de contrataci&oacute;n</label>
                                            <div class="col-xs-6">
                                                <select name="tc" class="form-control" id="tc" required>
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>

                                                    <?php
                                                    $tc = $objUser_->getStatic_tipo_contratacion();

                                                    for ($i = 0; $i < count($tc); $i++) {
                                                        if ($BANDM) {

                                                            if ($result[0]["tipo_contratacion_id"] == $tc[$i]["id"]) {
                                                                ?>
                                                                <option value="<?php echo $tc[$i]["id"]; ?>" selected="selected"> <?php echo $tc[$i]["contratacion"]; ?></option>
                                                                <?php
                                                            } else {
                                                                ?>

                                                                <option value="<?php echo $tc[$i]["id"]; ?>"><?php echo $tc[$i]["contratacion"]; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="<?php echo $tc[$i]["id"]; ?>"><?php echo $tc[$i]["contratacion"]; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="cd" class="control-label col-xs-6">Categoria docente</label>
                                            <div class="col-xs-6">
                                                <select name="cd" class="form-control" id="cd" required>
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>
                                                    <?php
                                                    $cd = $objUser_->getStatic_categoria_docente();
                                                    for ($i = 0; $i < count($cd); $i++) {
                                                        if ($BANDM) {
                                                            if ($result[0]["categoria_docente_id"] == $cd[$i]["id"]) {
                                                                ?>
                                                                <option selected value="<?php echo $cd[$i]["id"]; ?>"><?php echo $cd[$i]["categoria"]; ?></option>           
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <option value="<?php echo $cd[$i]["id"]; ?>"><?php echo $cd[$i]["categoria"]; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="<?php echo $cd[$i]["id"]; ?>"><?php echo $cd[$i]["categoria"]; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="f" class="control-label col-xs-6">Facultad</label>
                                            <div class="col-xs-6">
                                                <select name="f" class="form-control" id="f" required onchange="from(this.value, 'd', 'cajax/departamento.php')">
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>
                                                    <?php
                                                    $dep_mas_fac = $BANDM ? $objUser_->getStatic_facultad_mas_departamento($result[0]["departamento_id"]) : '';

                                                    $f = $objUser_->getStatic_facultad();
                                                    for ($i = 0; $i < count($f); $i++) {
                                                        if (!empty($dep_mas_fac)) {
                                                            if ($dep_mas_fac[0]["idfacultad"] == $f[$i]["idfacultad"]) {
                                                                ?>

                                                                <option selected value="<?php echo $f[$i]["idfacultad"]; ?>"><?php echo $f[$i]["facultad"]; ?></option>
                                                                <?php
                                                            } else {
                                                                ?>

                                                                <option value="<?php echo $f[$i]["idfacultad"]; ?>"><?php echo $f[$i]["facultad"]; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="<?php echo $f[$i]["idfacultad"]; ?>"><?php echo $f[$i]["facultad"]; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="d" class="control-label col-xs-6">Departamento</label>
                                            <div class="col-xs-6">
                                                <select name="d" class="form-control" id="d" required>
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>
                                                    <?php
                                                    if ($BANDM) {
                                                        $depar = $objUser_->getStatic_departamento($dep_mas_fac[0]['idfacultad']);
                                                        for ($i = 0; $i < count($depar); $i++) {
                                                            if ($result[0]["departamento_id"] == $depar[$i]['id']) {
                                                                ?>
                                                                <option selected value="<?php echo $depar[$i]["id"]; ?>"><?php echo $depar[$i]["departamento"]; ?></option>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <option value="<?php echo $depar[$i]["id"]; ?>"><?php echo $depar[$i]["departamento"]; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="cc" class="control-label col-xs-6">Categoria del contrato</label>
                                            <div class="col-xs-6">
                                                <select name="cc" class="form-control" id="cc" required>
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>
                                                    <?php
                                                    $cc = $objUser_->getStatic_ccontrato();

                                                    for ($i = 0; $i < count($cc); $i++) {
                                                        if ($BANDM) {
                                                            if ($result[0]["ccontrato_id"] == $cc[$i]["id"]) {
                                                                ?>
                                                                <option selected value="<?php echo $cc[$i]["id"]; ?>"><?php echo $cc[$i]["nombre"]; ?></option>                       
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <option value="<?php echo $cc[$i]["id"]; ?>"><?php echo $cc[$i]["nombre"]; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="<?php echo $cc[$i]["id"]; ?>"><?php echo $cc[$i]["nombre"]; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="ec" class="control-label col-xs-6">Estado civil</label>
                                            <div class="col-xs-6">
                                                <select name="ec" class="form-control" id="ec" required="required">
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>
                                                    <?php
                                                    $ec = $objUser_->getStatic_ecivil();
                                                    for ($i = 0; $i < count($ec); $i++) {
                                                        if ($BANDM) {
                                                            if ($result[0]["ecivil_id"] == $ec[$i]["id"]) {
                                                                ?>
                                                                <option selected value="<?php echo $ec[$i]["id"]; ?>"><?php echo $ec[$i]["nombre"]; ?></option>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <option value="<?php echo $ec[$i]["id"]; ?>"><?php echo $ec[$i]["nombre"]; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="<?php echo $ec[$i]["id"]; ?>"><?php echo $ec[$i]["nombre"]; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="o" class="control-label col-xs-6">Oficio</label>
                                            <div class="col-xs-6">
                                                <select name="o" class="form-control" id="o" required="required">
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>
                                                    <?php
                                                    $o = $objUser_->getStatic_oficio();
                                                    for ($i = 0; $i < count($o); $i++) {
                                                        if ($BANDM) {
                                                            if ($result[0]["oficio_id"] == $o[$i]["id"]) {
                                                                ?>
                                                                <option selected value="<?php echo $o[$i]["id"]; ?>"><?php echo $o[$i]["nombre"]; ?></option>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <option value="<?php echo $o[$i]["id"]; ?>"><?php echo $o[$i]["nombre"]; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="<?php echo $o[$i]["id"]; ?>"><?php echo $o[$i]["nombre"]; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="n" class="control-label col-xs-6">Nacionalidad</label>
                                            <div class="col-xs-6">
                                                <select name="n" class="form-control" id="n" required="required">
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>
                                                    <?php
                                                    $n = $objUser_->getStatic_nacionalidad();
                                                    for ($i = 0; $i < count($n); $i++) {
                                                        if ($BANDM) {
                                                            if ($result[0]["nacionalidad_id"] == $n[$i]["id"]) {
                                                                ?>
                                                                <option selected value="<?php echo $n[$i]["id"]; ?>"><?php echo $n[$i]["nombre"]; ?></option>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <option value="<?php echo $n[$i]["id"]; ?>"><?php echo $n[$i]["nombre"]; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="<?php echo $n[$i]["id"]; ?>"><?php echo $n[$i]["nombre"]; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="na" class="control-label col-xs-6">Nivel academico</label>
                                            <div class="col-xs-6">
                                                <select name="na" class="form-control" id="na" required="required">
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>
                                                    <?php
                                                    $na = $objUser_->getStatic_nivel_academico();
                                                    for ($i = 0; $i < count($na); $i++) {

                                                        if ($BANDM) {
                                                            if ($result[0]["nivel_academico_id"] == $na[$i]["id"]) {
                                                                ?>
                                                                <option selected value="<?php echo $na[$i]["id"]; ?>"><?php echo $na[$i]["nivel"]; ?></option>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <option value="<?php echo $na[$i]["id"]; ?>"><?php echo $na[$i]["nivel"]; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="<?php echo $na[$i]["id"]; ?>"><?php echo $na[$i]["nivel"]; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-label col-xs-3">
                                        <h4>Datos del usuario</h4>
                                        <div class="form-group">
                                            <label for="password" class="control-label col-xs-5">Contrase&ntilde;a</label>
                                            <div class="col-xs-7">
                                                <input type="password" class="form-control" id="password" name="password" required="required">
                                                <?php
                                                if($BANDM)
                                                {
                                                ?>
                                                <label class="checkbox inline">
                                                    <input type="checkbox" name="desabilitar" id="desabilitar" /> <span id="dhpass">Desabilitar cambio de contrase&ntilde;a</span>
                                                </label>
                                                <?php } ?>
                                                <label class="checkbox inline">
                                                    <input type="checkbox" name="check" id="check" /> Ver contrase&ntilde;a
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="tu" class="control-label col-xs-5">Tipo de usuario</label>
                                            <div class="col-xs-7">
                                                <select name="tu" class="form-control" id="tu" required="required">
                                                    <option class="priElement" value="">Seleccione una opci&oacute;n</option>
                                                    <?php
                                                    $us = $objUser_->getStatic_tusuario();
                                                    for ($i = 0; $i < count($us); $i++) {
                                                        if ($BANDM) {

                                                            if ($user[0]["tusuario_id"] == $us[$i]["id"]) {
                                                                ?>
                                                                <option selected value="<?php echo $us[$i]["id"]; ?>"><?php echo $us[$i]["nombre"]; ?></option>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <option value="<?php echo $us[$i]["id"]; ?>"><?php echo $us[$i]["nombre"]; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="<?php echo $us[$i]["id"]; ?>"><?php echo $us[$i]["nombre"]; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <h4>Datos del beneficiario</h4>
                                    <div class="col-xs-3">
                                        <div class="form-group">
                                            <label for="cb" class="control-label col-xs-5">C&eacute;dula del beneficiario</label>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" id="cb" value="<?php
                                                       if ($BANDM) {
                                                           echo $beneficiario[0]["cedula"];
                                                       }
                                                       ?>" name="cb" required="required"> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group">
                                            <label for="nb" class="control-label col-xs-5">Nombres</label>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" id="nb" value="<?php
                                                       if ($BANDM) {
                                                           echo $beneficiario[0]["nombre"];
                                                       }
                                                       ?>" name="nb" required="required"> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group">
                                            <label for="ab" class="control-label col-xs-5">Apellidos</label>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" id="ab" value="<?php
                                                       if ($BANDM) {
                                                           echo $beneficiario[0]["apellidos"];
                                                       }
                                                       ?>" name="ab" required="required"> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group">
                                            <label for="db" class="control-label col-xs-5">Direcci&oacute;n</label>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" id="db" value="<?php
                                                       if ($BANDM) {
                                                           echo $beneficiario[0]["direccion"];
                                                       }
                                                       ?>" name="db" required="required"> 
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-actions">
                                    <?php
                                    if (!$BANDM) {
                                    ?>
                                    <button type="submit" name="SET" id="SET" class="btn btn-primary">Agregar Docente</button> 
                                    <?php
                                    }  else {
                                        ?>
                                    
                                        <button type="submit" name="EDI" id="SET" class="btn btn-primary">Modificar Docente</button> 
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
            
            $('#desabilitar').on('click',function ()
            {
                var check = $(this);
                if(check.is(':checked'))
                {
                    document.getElementById('password').disabled = true;
                    document.getElementById('dhpass').innerHTML = 'Habilitar cambio de contrase&ntilde;a';
                }
                else
                {
                    document.getElementById('password').disabled = false;
                    document.getElementById('dhpass').innerHTML = 'Desabilitar cambio de contrase&ntilde;a';
                    
                }
            });
            
        });
    </script>
</body>
</html>