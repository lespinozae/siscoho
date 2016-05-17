<?php
include './DBConnector.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of consulta
 *
 * @author lmanuel
 */
class consulta {
    //put your code here
    public function insertar($inss, $nombre1, $nombre2, $cedula, $apellido1, $apellido2, $nacimiento, $email, $comision, $sexo)
    {
        $sql = "INSERT INTO tlbdocente (inss, Nombre1, Nombre2, Cedula, Apellido1, Apellido2, FechaNacimiento, email, comision, sexo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $data = array("isssssssss", "{$inss}", "{$nombre1}", "{$nombre2}", "{$cedula}", "{$apellido1}", "{$apellido2}", "{$nacimiento}", "{$email}", "{$comision}", "{$sexo}");
        $insert_id = DBConnector::ejecutar($sql, $data);
        print $insert_id;
    }
    
    public function mostrar($inss)
    {
        $valor = "lmanuel";
        $sql="SELECT idUsuarios FROM tlbusuarios WHERE user = ? ";
        $data = array("s", "{$valor}");
        $fields = array("idUsuarios" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
}

$consulta = new consulta();
//$consulta->insertar(925000, 'Luis', 'Manuel', '001-051189-0052Z', 'Espinoza', 'Estrada', '1989-11-05', 'luis@manuel.com', 'Ninguna', 'M');
$datos = $consulta->mostrar('%lu%');
var_dump($datos);

