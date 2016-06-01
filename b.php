<?php
require_once './core/zona_privada.php';
require_once './core/user.php';
require_once 'menu.php';

if(isset($_POST) and isset($_POST["pass"]))
{
    $obj = new user();
    $respuesta = $obj->setUpdatePass($_POST["pass"], $_SESSION["user"]);
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
                                        
 <form name="form" class="form-horizontal" style="text-align: left;" action="cpass.php" method="POST">
     
     <div class="panel panel-default">
            <div class="panel-heading"> Actualizar beneficiario </div>
            <div class="panel-body">
              <p></p>
              <div class="control-label col-xs-12">
         <div class="form-group">
             <label for="cedula" class="control-label col-xs-3">C&eacute;dula</label>
                                            <div class="col-xs-9">
                                                <input type="text" name="cedula" required="require" class="form-control"  id="cedula">
                                            </div>
                                        </div>
     </div>
              
              <div class="control-label col-xs-12">
         <div class="form-group">
         <label for="nombre" class="control-label col-xs-3">Nombre</label>
                                            <div class="col-xs-9">
                                                <input type="text" name="nombre" required="require" class="form-control"  id="nombre">
                                            </div>
                                        </div>
     </div>
              
              <div class="control-label col-xs-12">
         <div class="form-group">
         <label for="apellido" class="control-label col-xs-3">Apellido</label>
                                            <div class="col-xs-9">
                                                <input type="text" name="apellido" required="require" class="form-control"  id="apellido">
                                            </div>
                                        </div>
     </div>
            
            <div class="control-label col-xs-12">
         <div class="form-group">
             <label for="nombre" class="control-label col-xs-3">Direcci&oacute;n</label>
                                            <div class="col-xs-9">
                                                <textarea name="dir" cols="50"></textarea>
                                            </div>
                                        </div>
     </div>
              <div class="form-group text-right">
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
