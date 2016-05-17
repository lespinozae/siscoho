<?php
require_once './core/cargar_menu.php';
$objUser = new menu();
$datos = $objUser->getNombreUsuario($_SESSION["user"]);

    ?>
