<?php
require_once './core/dompdf/autoload.inc.php';
require_once './core/zona_privada.php';

require_once './core/carga.php';
require_once './core/user.php';
require_once './core/horario.php';

use Dompdf\Dompdf;

$id = $_GET["id"];
$dato_periodo = carga::getStatic_activo();
$horario = new horario();
$carga_asignatura = $horario->get_existente_carga($id, $dato_periodo[0]['id']);
    
$codigo = "<table class='table table-hover editinplace_p' id='ad'>
                                           <thead>
                                                <tr>
                                                    <th>Asignatura</th>
                                                    <th>Horas</th>
                                                    <th>Pago</th>
                                                    <th>Total</th>
                                                    <th>Modalidad</th>
                                                    <th>Carrera</th>
                                                    <th>Departamento</th>
                                                    <th>Horario</th>
                                                    <th></th>
                                                </tr>
                                           </thead>
                                            <tbody>";
                                                    
                                                   
                                                    if(count($carga_asignatura)>0)
                                                    {
                                                        $total_h = 0;
                                                        $total_p = 0;
                                                    for($z = 0; $z<count($carga_asignatura); $z++)
                                                    {
                                                        $dato_horario = horario::get_horario($carga_asignatura[$z]["idcarga"]);
                                                        
                                              
                                        $codigo .= "<tr>
                                            <td><input type='hidden' name='id' value=' ". $carga_asignatura[$z]["idcarga"]. "/>". $carga_asignatura[$z]["asignaturas"] . "</td>";
                                        $codigo .= "<td>" . $carga_asignatura[$z]["thoras"]. "</td>";
                                        $codigo .= "<td>C$ " .number_format($carga_asignatura[$z]["pagoxhora"], 2, ',', ' '). "</td>";
                                        $codigo .= "<td>C$ " . number_format($carga_asignatura[$z]["pago"], 2, ',', ' ') . "</td>";
                                        $codigo .="<td>".$carga_asignatura[$z]["turno"]. "</td>";
                                        $codigo .="<td>". $carga_asignatura[$z]["carreras"] ."</td>";
                                        $codigo .="<td>".$carga_asignatura[$z]["departamento"]."</td>";
                                        
                                       
                                        $codigo .="<td>
                                            <table>
                                               
                                                ";
                                                    if(count($dato_horario)>0)
                                                    {
                                                    for($i = 0; $i<count($dato_horario); $i++)
                                                    {
                                                
                                        $codigo .="<tr>
                                            <td style='padding-right: 10px;'>". $dato_horario[$i]["dia"]."</td>";
                                        $codigo .="<td style='padding-right: 10px;'>".date('h:i A', strtotime($dato_horario[$i]["inicio"]))."</td>";
                                        $codigo .="<td style='padding-right: 10px;'>".date('h:i A', strtotime($dato_horario[$i]["fin"]))."</td>";
                                        $codigo .="</tr>";
                                                    }
                                                    
                                                    }
                                                    
                                                    
                                        $codigo .="</table>";
                                        $codigo .="</td>";
                                        
                                        
                                       
                                    $codigo .="</tr>";
                                    
                         } 
}
                                                    
                                            $codigo .="</tbody>";
                                        $codigo .="</table>";

$codigo = utf8_decode($codigo);
$dompdf = new Dompdf();
$dompdf->loadHtml($codigo);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('letter', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('Carga');