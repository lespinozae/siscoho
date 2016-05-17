<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of horario
 *
 * @author lmanuel
 */
class horario {
    //SELECT carga_asignatura.idcarga, carga_asignatura.thoras, asignaturas.asignaturas, departamento.departamento, carreras.carreras, turno.turno, nivel_academico.pagoxhora, (carga_asignatura.thoras * nivel_academico.pagoxhora) as pago

// FROM carga_asignatura inner join asignaturas INNER join turno inner join carreras INNER join departamento INNER JOIN docentes INNER JOIN nivel_academico

// ON carga_asignatura._idasiganturas = asignaturas.idasiganturas and asignaturas.turno_idturno = turno.idturno and carreras.id = turno.carreras_id and departamento.id = carreras._id and carga_asignatura.carga_docentes_id = docentes.id and nivel_academico.id = docentes.nivel_academico_id

// where carga_asignatura.idcarga = ?
    
    public function get_existente_carga($d, $p)
    {
       
        $sql = "SELECT carga_asignatura.idcarga, carga_asignatura.thoras, asignaturas.asignaturas, departamento.departamento, carreras.carreras, turno.turno, nivel_academico.pagoxhora, (carga_asignatura.thoras * nivel_academico.pagoxhora) as pago FROM carga_asignatura inner join asignaturas INNER join turno inner join carreras INNER join departamento INNER JOIN docentes INNER JOIN nivel_academico ON carga_asignatura._idasiganturas = asignaturas.idasiganturas and asignaturas.turno_idturno = turno.idturno and carreras.id = turno.carreras_id and departamento.id = carreras._id and carga_asignatura.carga_docentes_id = docentes.id and nivel_academico.id = docentes.nivel_academico_id where carga_asignatura.carga_periodo_id = ? and carga_asignatura.carga_docentes_id = ?";
        
        $data = array("ii", "{$p}", "{$d}");
        $fields = array("idcarga" => "", "thoras" => "", "asignaturas" => "", "departamento" => "", "carreras" => "", "turno" => "", "pagoxhora" => "", "pago" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    
    public static function get_horario($id)
    {
       
        $sql = "SELECT idhorario, dia, inicio, fin from horario WHERE carga_asignatura_idcarga = ?;";
        //echo $sql;
        $data = array("i", "{$id}");
        $fields = array("idhorario" => "", "dia" => "", "inicio" => "", "fin" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
  public function deleteHorario($id)
    {
            $sql = "DELETE FROM `horario` WHERE `idhorario` = ?";
            //echo $sql;

            $data = array("i", "{$id}");
            //print_r($data);
            $result1 = DBConnector::ejecutar($sql, $data);
            $result1_c = DBConnector::$filaAfectada;
            
            if ($result1 or $result1_c)
            {
                return "El horario fue eliminado con exito";
            }else
            {
                return "Error! Contactese con su administrador!";
            }
    }  
    
    public function setHorario($dia, $inicio, $fin, $idCarga)
    {
            //echo $limite[0]["limite"]; echo $total[0]["horas"];
//            if ($limite[0]["limite"] > $total[0]["horas"])
//            {
            $sql = "INSERT INTO `horario` (`dia`, `inicio`, `fin`, `carga_asignatura_idcarga`) VALUES (?, ?, ?, ?);";
            //echo $sql;
            $data = array("sssi", "{$dia}", "{$inicio}", "{$fin}", "{$idCarga}");
            //print_r($data);
            $result = DBConnector::ejecutar($sql, $data);
            //exit();
            if ($result)
            {
                return 1;
            }else
            {
                return 2;
            }
//            }
// else {
//     return "Error! No puede agregar mas asignaturas (Sobrepasa el limite de horas)";
// }
    }
}
