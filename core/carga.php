<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of carga
 *
 * @author lmanuel
 */
class carga {
    public static function getStatic_existente_carga($id, $p)
    {
       
        $sql = "SELECT count(docentes_id) as cantidad FROM `carga` WHERE docentes_id = ? and periodo_id = ?";
        $data = array("ii", "{$id}", "{$p}");
        $fields = array("cantidad" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_departamento($id)
    {
       
        $sql = "SELECT departamento.id, departamento.departamento FROM `departamento` inner join docentes on departamento.id = docentes.departamento_id WHERE docentes.id = ?";
        //echo $sql;
        $data = array("i", "{$id}");
        $fields = array("id" => "", "departamento" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_facultad($id)
    {
       
        $sql = "SELECT facultad.idfacultad, facultad.facultad FROM `facultad` inner join docentes INNER JOIN departamento on departamento.id = docentes.departamento_id and facultad.idfacultad = departamento._idfacultad WHERE docentes.id = ?";
        //echo $sql;
        $data = array("i", "{$id}");
        $fields = array("id" => "", "facultad" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public function setCarga($id, $p)
    {
        
            $sql = "INSERT INTO `carga` (`docentes_id`, `periodo_id`) VALUES (?, ?);";
            $data = array("ii", "{$id}", "{$p}");
            $result = DBConnector::ejecutar($sql, $data);
            if (!$result)
            {
                header("Location: user.php?rc=1");
            }
    }
    
    public static function getStatic_activo()
    {
        $sql = "select periodo.id, semestre.nombre, periodo.anio_lectivo from periodo inner join semestre on semestre.id = periodo.semestre_id where estado = ?";
        $estado = 1;
        $data = array("i", "{$estado}");
        $fields = array("id" => "", "nombre" => "", "anio_lectivo" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        
        return DBConnector::$results;
    }
    
    public static function getStatic_Facultad2()
    {
        $sql = "SELECT * FROM facultad where idfacultad != ?";
        $data = array("i", "{-1}");
        $fields = array("idfacultad" => "", "facultad"=>"");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_DepartamentoDocente($id)
    {
        $sql = "SELECT idfacultad as id FROM `facultad` INNER JOIN departamento INNER JOIN docentes on facultad.idfacultad = departamento._idfacultad and docentes.departamento_id = departamento.id where docentes.id = ?";
        $data = array("i", "{$id}");
        $fields = array("id" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_DepartamentoC($id)
    {
        $sql = "select id, `departamento` from `departamento` where _idfacultad = ?";
        $data = array("i", "{$id}");
        $fields = array("id" => "", "departamento"=>"");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_carrera($id)
    {
        $sql = "select id, carreras from carreras where _id = ?";
        $data = array("i", "{$id}");
        $fields = array("id" => "", "carreras"=>"");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_turno($id)
    {
        $sql = "select idturno, turno from turno where carreras_id = ?";
        $data = array("i", "{$id}");
        $fields = array("idturno" => "", "turno"=>"");
        DBConnector::ejecutar($sql, $data, $fields);
        
        return DBConnector::$results;
    }
    
    
    public static function getStatic_asignaturas($id, $anio)
    {
        $sql = "select idasiganturas, asignaturas, plan, thoras from asignaturas where turno_idturno = ? and anio = ?";
        //echo $sql.$id.$anio;
        $data = array("ii", "{$id}", "{$anio}");
        $fields = array("idasiganturas" => "", "asignaturas"=>"", "plan"=>"", "thoras"=>"");
        DBConnector::ejecutar($sql, $data, $fields);
        
        return DBConnector::$results;
    }
    
    public static function getStatic_asignaturas2($id)
    {
        $sql = "SELECT asignaturas.asignaturas FROM asignaturas where asignaturas.idasiganturas = ?";
        //echo $sql.$id.$anio;
        $data = array("i", "{$id}");
        $fields = array("asignaturas"=>"");
        DBConnector::ejecutar($sql, $data, $fields);
        
        return DBConnector::$results;
    }
    
    //
    public static function getStatic_asignaturasID($id, $d, $p)
    {
        $sql = "SELECT COUNT(carga_asignatura._idasiganturas) as cantidad from carga_asignatura where carga_asignatura._idasiganturas = ? and carga_asignatura.carga_periodo_id = ? and carga_asignatura.carga_docentes_id = ?";
        //echo $sql.$id.$d.$p;
        $data = array("iii", "{$id}", "{$p}", "{$d}");
        $fields = array("cantidad" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        //echo DBConnector::$results;
        return DBConnector::$results;
    }
    
    public static function getStatic_CountCarga($d, $p)
    {
        $sql = "SELECT SUM(thoras) as cantidad FROM carga_asignatura WHERE carga_asignatura.carga_periodo_id = ? and carga_asignatura.carga_docentes_id = ?";
        //echo $sql.$id.$d.$p;
        $data = array("ii", "{$p}", "{$d}");
        $fields = array("cantidad" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        //echo DBConnector::$results;
        return DBConnector::$results;
    }
    
    public static function getStatic_anio($id)
    {
        $sql = "select DISTINCT anio from asignaturas where turno_idturno = ?";
        //echo $sql.$id;
        $data = array("i", "{$id}");
        $fields = array("anio" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        
        return DBConnector::$results;
    }
    
    public function setCargaAsig($asig, $p, $d, $th)
    {
          
            //echo $limite[0]["limite"]; echo $total[0]["horas"];
//            if ($limite[0]["limite"] > $total[0]["horas"])
//            {
            $sql = "INSERT INTO `carga_asignatura` (`_idasiganturas`, `carga_periodo_id`, `carga_docentes_id`, `thoras`) VALUES (?, ?, ?, ?);";
            //echo $sql;

            $data = array("iiii", "{$asig}", "{$p}", "{$d}", "{$th}");
            //print_r($data);
            $result1 = DBConnector::ejecutar($sql, $data);
            if ($result1)
            {
                return "La asignatura se agrego con exito";
            }else
            {
                return "Error! Contactese con su administrador!";
            }
//            }
// else {
//     return "Error! No puede agregar mas asignaturas (Sobrepasa el limite de horas)";
// }
    }
    
    
    public function setCargaAsigImport($asig, $p, $d, $th)
    {
        //echo self::getStatic_asignaturasID($asig, $d, $p)[0]["cantidad"];
        
        if(!(self::getStatic_asignaturasID($asig, $d, $p)[0]["cantidad"]>0))
        {
            //exit();
            $sql = "INSERT INTO `carga_asignatura` (`_idasiganturas`, `carga_periodo_id`, `carga_docentes_id`, `thoras`) VALUES (?, ?, ?, ?);";
            //echo $sql;
            $data = array("iiii", "{$asig}", "{$p}", "{$d}", "{$th}");
            //print_r($data);
            $result1 = DBConnector::ejecutar($sql, $data);
            return $result1;
        }
        else
        {
            return false;
        }
    }
    
    public function updateHoras($valor, $asig, $p, $d, $tipo)
    {
        switch ($tipo){
            case 'he':
                 $sql = "UPDATE `carga_asignatura` SET `hexcedentes` = ? WHERE _idasiganturas = ? and carga_periodo_id = ? and carga_docentes_id = ?;";
                $mensaje = "Las horas excedentes se modificaron con exito";
            break;
        case 'hr':
             $sql = "UPDATE `carga_asignatura` SET `hreducidas` = ? WHERE _idasiganturas = ? and carga_periodo_id = ? and carga_docentes_id = ?;";
            $mensaje = "Las horas reducidas se modificaron con exito";
            break;
        case 'ha':
             $sql = "UPDATE `carga_asignatura` SET `hadicionales` = ? WHERE _idasiganturas = ? and carga_periodo_id = ? and carga_docentes_id = ?;";
            $mensaje = "Las horas adicionales se modificaron con exito";
            break;
        
        case 'h':
             $sql = "UPDATE `carga_asignatura` SET `thoras` = ? WHERE _idasiganturas = ? and carga_periodo_id = ? and carga_docentes_id = ?;";
            $mensaje = "Las horas totales se modificaron con exito";
            break;
        }
            //echo $sql;

            $data = array("iiii", "{$valor}", "{$asig}", "{$p}", "{$d}");
            //print_r($data);
            $result1 = DBConnector::ejecutar($sql, $data);
            $result_c = DBConnector::$filaAfectada;
            
            if ($result1 or $result_c)
            {
                return $mensaje;
            }else
            {
                return "Usted no modifico el valor o hubo un error! Contactese con su administrador para mayor informaci&oacute;n!";
            }
    }
    
    public function ignorarLimite($p, $d, $valor)
    {
       
                 $sql = "UPDATE `carga` SET `permitir` = ? WHERE periodo_id = ? and docentes_id = ?;";
                 $mensaje = "";
          
            $data = array("iii", "{$valor}", "{$p}", "{$d}");
            //print_r($data);
            $result1 = DBConnector::ejecutar($sql, $data);
            $result_c = DBConnector::$filaAfectada;
            
            if ($result1 or $result_c)
            {
                return $mensaje;
            }else
            {
                return "Error! Contactese con su administrador!";
            }
    }
    //Volver a utilizar para mostrar carga importar
    public static function getStatic_carga_asignatura($id, $p)
    {
        $sql = "SELECT asignaturas.idasiganturas, asignaturas.asignaturas, asignaturas.plan, asignaturas.thoras, turno.turno, carga_asignatura.hexcedentes, carga_asignatura.hreducidas, carga_asignatura.hadicionales from carga_asignatura INNER join asignaturas INNER join turno ON carga_asignatura._idasiganturas = asignaturas.idasiganturas and turno.idturno = asignaturas.turno_idturno where carga_docentes_id = ? and carga_periodo_id = ?";
        //echo $sql.$id;
        $data = array("ii", "{$id}", "{$p}");
        $fields = array("idasiganturas" => "", "asignaturas" => "", "plan" => "", "thoras" => "", "turno" => "", "hexcedentes" => "", "hreducidas" => "", "hadicionales" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        
        return DBConnector::$results;
    }
    
    public static function getStatic_permitir($d, $p)
    {
        $sql = "SELECT permitir FROM carga where docentes_id = ? and periodo_id = ?";
        //echo $sql.$id;
        $data = array("ii", "{$d}", "{$p}");
        $fields = array("permitir" => "",);
        DBConnector::ejecutar($sql, $data, $fields);
        
        return DBConnector::$results;
    }
    
    public static function getStatic_Asignatura($id)
    {
        $sql = "SELECT thoras from asignaturas where idasiganturas = ?";
        
        $data = array("i", "{$id}");
        $fields = array("thoras" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        
        return DBConnector::$results;
    }
    
    //SELECT permitir FROM carga where docentes_id = 1 and periodo_id = 1;
    
    public function deleteCargaAsig($asig, $p, $d)
    {
            $sql_h = "select idcarga FROM `carga_asignatura` WHERE `_idasiganturas` = ? and `carga_periodo_id` = ? and `carga_docentes_id` = ?";
            $data = array("iii", "{$asig}", "{$p}", "{$d}");
            $fields = array("idcarga" => "");
            
            DBConnector::ejecutar($sql_h, $data, $fields);
            //print_r(DBConnector::$results);
            
            if (count(DBConnector::$results) > 0)
            {
                $sql = "DELETE FROM `horario` WHERE `carga_asignatura_idcarga` = ?";
                $id_h = DBConnector::$results[0]["idcarga"];
                $data = array("i", "{$id_h}");
                
                DBConnector::ejecutar($sql, $data);
            }
            
            $sql = "DELETE FROM `carga_asignatura` WHERE `_idasiganturas` = ? and `carga_periodo_id` = ? and `carga_docentes_id` = ?";
            //echo $sql;

            $data = array("iii", "{$asig}", "{$p}", "{$d}");
            
            $result1 = DBConnector::ejecutar($sql, $data);
            $result1_c = DBConnector::$filaAfectada;
            
            if ($result1 or $result1_c)
            {
                return "La asignatura se elimino con exito";
            }else
            {
                return "Error! Contactese con su administrador!";
            }
    }
    
    public static function getStatic_limite($id)
    {
        $sql = "select tipo_contratacion.limiteshoras as limite from docentes INNER JOIN tipo_contratacion ON
docentes.tipo_contratacion_id = tipo_contratacion.id where docentes.id = ?";
        //echo $sql.$id;
        $data = array("i", "{$id}");
        $fields = array("limite" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        
        return DBConnector::$results;
    } 
    
    public static function getStatic_horas($id, $p)
    {
        $sql = "SELECT SUM(asignaturas.thoras) as horas from carga_asignatura inner join asignaturas 
on carga_asignatura._idasiganturas = asignaturas.idasiganturas
WHERE carga_asignatura.carga_docentes_id = ? and carga_asignatura.carga_periodo_id = ?";
        //echo $sql.$id;
        $data = array("ii", "{$id}", "{$p}");
        $fields = array("horas" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        
        return DBConnector::$results;
    } 
    
    
    //
    
    public static function getStatic_import()
    {
        $anio_ = self::getStatic_activo();
        
        $anio = $anio_[0]["anio_lectivo"]-3;
        $aniof = $anio_[0]["anio_lectivo"]-1;
        //echo $anio;
        //echo $aniof;
        $sql = "SELECT periodo.id, periodo.anio_lectivo, semestre.nombre FROM `periodo` inner JOIN semestre ON periodo.semestre_id = semestre.id WHERE periodo.anio_lectivo BETWEEN ? and ? order by periodo.anio_lectivo";
        //echo $sql;
        $data = array("ii", "{$anio}", "{$aniof}");
        $fields = array("id" => "", "anio_lectivo" => "", "nombre" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        
        return DBConnector::$results;
    } 
}
