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
                <div class="alert alert-success paleta" role="alert"><h3>Cambiar contrase&ntilde;a: </h3>
                </div>
                <hr />
                <div class="col-xs-6 col-xs-offset-3">
                    <?php require './respuesta.php'; ?>
                    
                    <br />
                    <fieldset>
                        
                           
 <div class="mensaje"></div>
                                        
 <form name="form" class="form-horizontal" style="text-align: left;" action="cpass.php" method="POST">
     
     <div class="panel panel-default">
            <div class="panel-heading"> Cambiar contraseña </div>
            <div class="panel-body">
              <p></p>
              <div class="control-label col-xs-12">
         <div class="form-group">
         <label for="pass" class="control-label col-xs-5">Contrase&ntilde;a</label>
                                            <div class="col-xs-7">
                                                <input type="password" name="pass" required="require" class="form-control"  id="pass">
                                            </div>
                                        </div>
     </div>
              
              <div class="control-label col-xs-12">
         <div class="form-group">
         <label for="rpass" class="control-label col-xs-5">Repetir contrase&ntilde;a</label>
                                            <div class="col-xs-7">
                                                <input type="password" name="rpass" required="require" class="form-control"  id="rpass">
                                            </div>
                                        </div>
     </div>
              <div class="form-group text-right">
                  <button type="submit" onclick="return validar();" class="btn btn-primary" id="enviar" >Cambiar contraseña</button>
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
        <script>
               function validar ()
               {
                   var pass1 = document.getElementById("pass").value;
                   var pass2 =  document.getElementById("rpass").value;
                   
                   if(pass1 == pass2)
                   {
                       return true;
                   }
                   else
                   {
                        $.prompt("Error! Las contraseñas son diferentes!!!", {
                                            title: "Error",
                                            buttons: { "Ok": true} });
                       return false;
                   }
               }
        </script>
    </body>
</html>
