<?php 
require_once './core/zona_privada.php';
require_once 'menu.php';

?>
<style>
            .navbar-brand{
                padding: 0px 15px;
            }
        </style>
<header id="main-header">
<div class="container">
    <div class="row">
<!--            <div class="col-xs-1">
                <a href="index.php"><img src="img/logo-unan.png" width="70px" style="margin: 0; padding: 0;" /></a>
            </div>-->
            <div class="col-xs-12">
                <h1 id="main-logo"><a href="index.php"><span>Sistema de carga horaria</span></a></h1>
                <nav class="navbar navbar-default" role="navigation">
  <!-- El logotipo y el icono que despliega el menú se agrupan
       para mostrarlos mejor en los dispositivos móviles -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse"
            data-target=".navbar-ex1-collapse">
      <span class="sr-only">Desplegar navegación</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
      <a class="navbar-brand" data-toggle="tooltip" title="Inicio" href="index.php"><img src="img/logo-unan.png" width="35" /></a>
  </div>
  
  
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
      <?php  echo $objUser->get(); ?>
    </ul>
 
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <?php
                            if (count($datos)>0)
                                echo $datos[0]["pnombre"]." ".$datos[0]["papellido"];
                            ?> <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="#">Cambio de contrase&ntilde;a</a></li>
          <li><a href="#">Acción #2</a></li>
          <li><a href="#">Acción #3</a></li>
          <li class="divider"></li>
          <li><a href="sesion.php" title="Cerrar Sesión" onClick="willReset=confirm('&iquest;Est&aacute; seguro que desea salir del Sistema?');return willReset;"><span> <i class="fa fa-sign-out"> Salir</i>
</a></li>
        </ul>
      </li>
    </ul>
  </div>
  
  
  </nav>
                
            </div>
        </div>
        </div>
    </header>
        