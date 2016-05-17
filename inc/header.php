<?php 
require_once './core/zona_privada.php';
require_once 'menu.php';

?>
<header id="main-header">
<div class="container">
    <div class="row">
            <div class="col-xs-1">
                <a href="index.php"><img src="img/logo-unan.png" width="70px" style="margin: 0; padding: 0;" /></a>
            </div>
            <div class="col-xs-11">
                <h1 id="main-logo"><a href="index.php"><span>Sistema de carga horaria</span></a></h1>
                <nav class="navbar navbar-default" style="margin: 0; padding: 0;">
  <div class="container-fluid">

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul id="main-menu" class="nav navbar-nav navbar-left">
        <?php  echo $objUser->get(); ?>
            </ul>
      <ul id="main-menu"  class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php
                            if (count($datos)>0)
                                echo $datos[0]["pnombre"]." ".$datos[0]["papellido"];
                            ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
              <li><a href="#">Cambio de contrase&ntilde;a</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="sesion.php" title="Cerrar Sesión" onClick="willReset=confirm('&iquest;Est&aacute; seguro que desea salir del Sistema?');return willReset;"><span> <i class="fa fa-sign-out"> Salir</i>
</a></li>
          </ul>
        </li>
      </ul>
        
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
                
            </div>
        </div>
        </div>
    </header>