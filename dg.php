<?php
require_once './core/zona_privada.php';
require_once './core/user.php';
require_once 'menu.php';

function data() {
    $data = array();

    if (array_key_exists('inss', $_POST)) {
        $data["inss"] = $_POST['inss'];
    }
    if (array_key_exists('pnombre', $_POST)) {
        $data["pnombre"] = $_POST['pnombre'];
    }
    if (array_key_exists('snombre', $_POST)) {
        $data["snombre"] = $_POST['snombre'];
    }
    
    if (array_key_exists('papellido', $_POST)) {
        $data["papellido"] = $_POST['papellido'];
    }
    
    if (array_key_exists('sapellido', $_POST)) {
        $data["sapellido"] = $_POST['sapellido'];
    }
    
    if (array_key_exists('direccion', $_POST)) {
        $data["direccion"] = $_POST['direccion'];
    }
    
    if (array_key_exists('sexo', $_POST)) {
        $data["sexo"] = $_POST['sexo'];
    }
    
    if (array_key_exists('telefono', $_POST)) {
        $data["telefono"] = $_POST['telefono'];
    }
    if (array_key_exists('direccion2', $_POST)) {
        $data["direccion2"] = $_POST['direccion2'];
    }
    
    if (array_key_exists('cedulam', $_POST)) {
        $data["cedulam"] = $_POST['cedulam'];
    }
    return $data;
}

$objB = new user();
$result = $objB->getUser($_SESSION["user"]);

$BAND = false;

if(count($result)>0)
{
    $BAND = true;
}

if(isset($_POST) and isset($_POST["cedulam"]))
{
    $obj = new user();
    $obj->setUpdateDG(data());
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
                <div class="alert alert-success paleta" role="alert"><h3>Datos Generales: </h3>
                </div>
                <hr />
                <div class="col-xs-6 col-xs-offset-3">
                    <?php require './respuesta.php'; ?>
                    
                    <br />
                    <fieldset>
                        
                           
 <div class="mensaje"></div>
                                        
 <form name="form" class="form-horizontal" style="text-align: left;" action="dg.php" method="POST">
     
     <div class="panel panel-default">
            <div class="panel-heading"> Actualizar datos generales </div>
            <div class="panel-body">
              <p></p>
              
              <div class="form-group">
                                            <label for="cedula" class="control-label col-xs-5">C&eacute;dula</label>
                                            <div class="col-xs-7">
                                                <input type="text" readonly="" class="form-control" id="cedula" value="<?php
                                                if ($BAND) {
                                                    echo $result[0]["cedula"];
                                                }
                                                ?>"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inss" class="control-label col-xs-5">INSS</label>
                                            <div class="col-xs-7">
                                                <input type="text" name="inss" class="form-control" id="inss" value="<?php
                                                if ($BAND) {
                                                    echo $result[0]["inss"];
                                                }
                                                ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="pnombre" class="control-label col-xs-5">Primer nombre</label>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" id="pnombre" required="require" name="pnombre" value="<?php
                                                if ($BAND) {
                                                    echo $result[0]["pnombre"];
                                                }
                                                ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="snombre" class="control-label col-xs-5">Segundo nombre</label>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" id="snombre" name="snombre" value="<?php
                                                if ($BAND) {
                                                    echo $result[0]["snombre"];
                                                }
                                                ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="papellido" class="control-label col-xs-5">Primer apellido</label>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" id="papellido" required="require" name="papellido" value="<?php
                                                if ($BAND) {
                                                    echo $result[0]["papellido"];
                                                }
                                                ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="sapellido" class="control-label col-xs-5">Segundo apellido</label>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" id="sapellido" name="sapellido" value="<?php
                                                if ($BAND) {
                                                    echo $result[0]["sapellido"];
                                                }
                                                ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="email" class="control-label col-xs-5">Correo</label>
                                            <div class="col-xs-7">
                                                <input type="email" name="direccion" class="form-control" id="email" required="required" value="<?php
                                                if ($BAND) {
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
                                                    if ($BAND) {
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
                                                if ($BAND) {
                                                    echo $result[0]["telefono"];
                                                }
                                                ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="direccion2"  class="control-label col-xs-5">Direcci&oacute;n</label>
                                            <div class="col-xs-7">
                                                <textarea class="form-control" name="direccion2" id="direccion2" cols="26" rows="10"><?php
                                                if ($BAND) {
                                                    echo $result[0]["direccion2"];
                                                }
                                                ?></textarea>
                                                
                                            </div>
                                        </div>
              
              <div class="form-group text-right">
                  <input type="hidden" name="cedulam" value="<?php echo $_SESSION['user']; ?>"/>
                  <button style="margin: 10px;" type="submit" class="btn btn-primary" id="enviar" >Actualizar beneficiario</button>
              </div>
            </div>
          </div>
     
     
     
 </form>
                             </fieldset>

  <!-- Modal -->
  
  
</div>



                </div>
            </div>
        </div>
        <?php
        include './inc/footer.php';
        ?>
        
        <?php
        include './inc/footer_common.php';
        ?>
        
    </body>
</html>
