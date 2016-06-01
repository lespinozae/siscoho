<?php
require_once './core/zona_privada.php';
require_once './core/user.php';
require_once 'menu.php';

function data() {
    $data = array();

    if (array_key_exists('cedula', $_POST)) {
        $data["cedula"] = $_POST['cedula'];
    }
    if (array_key_exists('nombre', $_POST)) {
        $data["nombre"] = $_POST['nombre'];
    }
    if (array_key_exists('apellido', $_POST)) {
        $data["apellido"] = $_POST['apellido'];
    }
    if (array_key_exists('dir', $_POST)) {
        $data["dir"] = $_POST['dir'];
    }
    
    if (array_key_exists('cedulam', $_POST)) {
        $data["cedulam"] = $_POST['cedulam'];
    }
    return $data;
}

$objB = new user();
$datosB = $objB->getBeneficiario($_SESSION["user"]);

$BAND = false;

if(count($datosB)>0)
{
    $BAND = true;
}

if(isset($_POST) and isset($_POST["cedula"]))
{
    $obj = new user();
    $obj->setUpdateB(data());
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
                <div class="alert alert-success paleta" role="alert"><h3>Beneficiario: </h3>
                </div>
                <hr />
                <div class="col-xs-6 col-xs-offset-3">
                    <?php require './respuesta.php'; ?>
                    
                    <br />
                    <fieldset>
                        
                           
 <div class="mensaje"></div>
                                        
 <form name="form" class="form-horizontal" style="text-align: left;" action="b.php" method="POST">
     
     <div class="panel panel-default">
            <div class="panel-heading"> Actualizar beneficiario </div>
            <div class="panel-body">
              <p></p>
              <div class="control-label col-xs-12">
         <div class="form-group">
             <label for="cedula" class="control-label col-xs-3">C&eacute;dula</label>
                                            <div class="col-xs-9">
                                                <input type="text" name="cedula" pattern="[0-9]{13}[A-Z]{1}" required="require" class="form-control"  id="cedula" value="<?php if ($BAND) echo $datosB[0]["cedula"]; ?>">
                                            </div>
                                        </div>
     </div>
              
              <div class="control-label col-xs-12">
         <div class="form-group">
         <label for="nombre" class="control-label col-xs-3">Nombre</label>
                                            <div class="col-xs-9">
                                                <input type="text" name="nombre" required="require" class="form-control"  id="nombre" value="<?php if ($BAND) echo $datosB[0]["nombre"]; ?>">
                                            </div>
                                        </div>
     </div>
              
              <div class="control-label col-xs-12">
         <div class="form-group">
         <label for="apellido" class="control-label col-xs-3">Apellido</label>
                                            <div class="col-xs-9">
                                                <input type="text" name="apellido" required="require" class="form-control"  id="apellido" value="<?php if ($BAND) echo $datosB[0]["apellidos"]; ?>">
                                            </div>
                                        </div>
     </div>
            
            <div class="control-label col-xs-12">
         <div class="form-group">
             <label for="nombre" class="control-label col-xs-3">Direcci&oacute;n</label>
                                            <div class="col-xs-9">
                                                <textarea class="form-control" name="dir" cols="50"><?php if ($BAND) echo $datosB[0]["direccion"]; ?></textarea>
                                            </div>
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
