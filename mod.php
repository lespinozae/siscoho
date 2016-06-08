<?php
require_once './core/zona_privada.php';
require_once './core/class.car.php';
require_once 'menu.php';


if (isset($_GET)) {
    if (isset($_GET["id"]) and isset($_GET["d"])) {
        $obj = new carreras();
        $result = $obj->deleteMod($_GET["id"]);
    }
}


if(isset($_POST) and isset($_POST["mod"]))
{
    $respuesta=array();
    $obj = new carreras();
    
    foreach ($_POST["mod"] as $value) {
       $respuesta[] = $obj->setModalidad($_POST["id"], $value);
       
    }
    $BANDR = false;
    
    foreach ($respuesta as $value) {
       if ($value)
       {
           $BANDR = true;
       }
       else
       {
           $BANDR = false;
       }
    }
    
    if ($BANDR)
    {
        echo '<script>window.location.href="car.php?r=1";</script>';
    }else
    {
        echo '<script>window.location.href="car.php?r=2";</script>';
    }
}

if(!isset($_GET["id"]))
{
    echo '<script>window.location.href="car.php";</script>';
}
else
{
    $obj = new carreras();
    $datosMO = $obj->getModalidad($_GET["id"]);
    
    $BANDP = false;
    $BANDPZ = false;
    $BANDE = false;
    $BANDMX = false;
    
    foreach ($datosMO as $value) {
        if($value["turno"] == "Presencial")
        {
            $BANDP = true;
            
        }
        
        if($value["turno"] == "Profesionalización")
        {
            $BANDPZ = true;
            
        }
        
        if($value["turno"] == "Por Encuentro")
        {
            $BANDE = true;
            
        }
        
        if($value["turno"] == "Mixta")
        {
            $BANDMX = true;
           
        }
        
    }
    $BANDAGRE = false;
    if($BANDP and $BANDPZ and $BANDE and $BANDMX)
    {
        $BANDAGRE = true;
    }
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
                <div class="alert alert-success paleta" role="alert"><h3>Agregar modalidad: </h3>
                </div>
                <hr />
                <div class="col-xs-6 col-xs-offset-3">
                    <?php require './respuesta.php'; ?>
                    
                    <br />
                    <fieldset>
                        
                           
 <div class="mensaje"></div>
                                        
 <form name="form" class="form-horizontal" style="text-align: left;" action="mod.php" method="POST">
     
     <div class="panel panel-default">
            <div class="panel-heading"> Modalidad </div>
            <div class="panel-body">
              <p></p>
              <?php if (!$BANDP) { 
?>
              <div class="control-label col-xs-3" style="padding-right: 90px;">
         <div class="form-group">
         <div class="checkbox">
             <label><input name="mod[]" type="checkbox" value="Presencial">Presencial</label>
        </div>
                                        </div>
     </div>
              <?php
                            }
?>
              <?php if (!$BANDPZ) { 
?>
              <div class="control-label col-xs-3">
         <div class="form-group">
         <div class="checkbox">
             <label><input name="mod[]" type="checkbox" value="Profesionalizaci&oacute;n">Profesionalizaci&oacute;n</label>
        </div>
                                        </div>
     </div>
              <?php
                            }
?>
              <?php if (!$BANDE) { 
?>
              <div class="control-label col-xs-3">
         <div class="form-group">
         <div class="checkbox">
             <label><input name="mod[]" type="checkbox" value="Por Encuentro">Por Encuentro</label>
        </div>
                                        </div>
     </div>
              <?php
                            }
?>
              <?php if (!$BANDMX) { 
?>
              <div class="control-label col-xs-3">
         <div class="form-group">
         <div class="checkbox">
             <label><input name="mod[]" type="checkbox" value="Mixta">Mixta</label>
        </div>
                                        </div>
     </div>
              <?php
                            }
?>
              <?php if (!$BANDAGRE) { 
?>
              <div class="form-group text-right">
                  <button type="submit" style="margin: 10px;"  onclick="return validar();" class="btn btn-primary" id="enviar" >Agregar modalidad</button>
              </div>
              <?php
                            }  else {
                            echo "<center><h4>Todas las modalidas estan agregadas para esta carrera</h4></center>";  
                            ?>
              <a href="car.php" class="btn btn-primary">Volver...</a>
              <?php
                            }
?>
            </div>
          </div>
     
     
     <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>"/>
     
 </form>
                             </fieldset>

  <!-- Modal -->
  
  
</div>



                </div><hr/>
                <div class="panel panel-default">
            <div class="panel-heading"> Modalidad agregada </div>
            <div class="panel-body">
              <table class="table table-hover">
    <thead>
      <tr>
        <th>Carrera</th>
        <th>Modalidad</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
        <?php
        $car = $obj->getCarrera($_GET["id"]);
        foreach ($datosMO as $value) {
                ?>
      <tr>
        <td><?php echo $car[0]["carreras"]; ?></td>
        <td><?php echo $value["turno"];?></td>
        <td><a id="eli" data-toggle="tooltip" title="Eliminar" onclick="alertDelete('mod.php?id=<?php echo $value["id"]; ?>&d=true&idC=<?php echo $_GET['id']; ?>')" href="#"><i class="fa fa-trash-o fa-2x"></i></a>
                                                        </td>
      </tr>
      <?php
       }
        ?>
    </tbody>
  </table>
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
