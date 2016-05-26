<?php
require_once './core/dompdf/autoload.inc.php';


use Dompdf\Dompdf;

$codigo = "<h1>Hola</h1>";

$codigo = utf8_decode($codigo);
$dompdf = new Dompdf();
$dompdf->loadHtml($codigo);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('Contrato');