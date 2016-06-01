<?php
require_once './core/zona_privada.php';
require_once './core/user.php';
require_once 'menu.php';

if(isset($_POST) and isset($_POST["id"]))
{
    $objH = new horario();
    //print_r($_POST);
    //exit();
    $respuesta = $objH->setHorario($_POST['dia'], $_POST['hstart'], $_POST['hend'], $_POST['id']);
    header("Location: home.php");
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
                <div class="alert alert-success paleta" role="alert"><h3>Carga: <?php if ($BAND) { echo 'Semestre: '. $dato_periodo[0]['nombre'] . ' - A&ntilde;o lectivo: '. $dato_periodo[0]['anio_lectivo']; } ?></h3>
                </div>
                <div class="col-xs-12">
                    
                    
                    <fieldset>
 <div class="mensaje"></div>
                                        
                             </fieldset>

  <!-- Modal -->
  
  
</div>

        <?php
        include './inc/footer.php';
        ?>
        
        <?php
        include './inc/footer_common.php';
        ?>
    </body>
</html>
