<?php

class asignatura {
    
    public function getDB($array, $limit)
    {
        foreach($array as $campo=>$valor)
        {
            $$campo = $valor;
        }
        
        $cadena = "";
        $data = array();
        $data_llenado = array();
        
        $sql = "SELECT asignaturas.idasiganturas, asignaturas.asignaturas, asignaturas.anio, asignaturas.plan, asignaturas.thoras, asignaturas.turno_idturno from asignaturas INNER join turno INNER join carreras INNER JOIN departamento
on asignaturas.turno_idturno = turno.idturno and turno.carreras_id = carreras.id and departamento.id = carreras._id ";
        $var = false;
        
            //Construir parametros
        if(isset($asignatura)){
            if (strlen($asignatura)>0)
            {
                    $sql.="where asignaturas.asignaturas LIKE ? ";
                    $cadena .= "s";
                    $asignatura = '%'.strtoupper($asignatura).'%';
                    $data_llenado[] = $asignatura;
                    $var = true;
            }
        }
	//$var = false;
        if(isset($departamento)){
	if (strlen($departamento)>0 and $var)
	{
		$sql.=" and departamento.id = ? ";
		$var = true;
                $cadena .= "s";
                $departamento = $departamento;
                $data_llenado[] = $departamento;
	}
	elseif (strlen($departamento)>0)
	{
		$sql.="WHERE departamento.id = ?";
		$var = true;
                $cadena .= "s";
                $departamento = $departamento;
                $data_llenado[] = $departamento;
	}
        }
        
        if(isset($carreras)){
	if (strlen($carreras)>0 and $var)
	{
		$sql.=" and carreras.id = ? ";
		$var = true;
                $cadena .= "s";
                $carreras = $carreras;
                $data_llenado[] = $carreras;
	}
	elseif (strlen($carreras)>0)
	{
		$sql.="WHERE carreras.id = ?";
		$var = true;
                $cadena .= "s";
                $carreras = $carreras;
                $data_llenado[] = $carreras;
	}
        }
        
        
        if(isset($plan)){
	if (strlen($plan)>0 and $var)
	{
		$sql.=" and asignaturas.plan = ? ";
		$var = true;
                $cadena .= "s";
                $plan = $plan;
                $data_llenado[] = $plan;
	}
	elseif (strlen($plan)>0)
	{
		$sql.="WHERE asignaturas.plan = ?";
		$var = true;
                $cadena .= "s";
                $plan = $plan;
                $data_llenado[] = $plan;
	}
        }
        
        if(isset($anio)){
	if (strlen($anio)>0 and $var)
	{
		$sql.=" and asignaturas.anio = ? ";
		$var = true;
                $cadena .= "s";
                $anio = $anio;
                $data_llenado[] = $anio;
	}
	elseif (strlen($anio)>0)
	{
		$sql.="WHERE asignaturas.anio = ?";
		$var = true;
                $cadena .= "s";
                $anio = $anio;
                $data_llenado[] = $anio;
	}
        }
        
        if(isset($turno_idturno)){
	if (strlen($turno_idturno)>0 and $var)
	{
		$sql.=" and turno.idturno = ? ";
		$var = true;
                $cadena .= "s";
                $turno_idturno = $turno_idturno;
                $data_llenado[] = $turno_idturno;
	}
	elseif (strlen($turno_idturno)>0)
	{
		$sql.="WHERE turno.idturno = ?";
		$var = true;
                $cadena .= "s";
                $turno_idturno = $turno_idturno;
                $data_llenado[] = $turno_idturno;
	}
        }
	
        $data[0] = $cadena;
        
        for ($index = 0; $index < count($data_llenado); $index++) {
            $data[$index+1] = "{$data_llenado[$index]}";
        }
        if (strlen($data[0]==0))
        {
            if(count($data)==0 or count($data)==1)
            {
                $sql.="WHERE asignaturas.idasiganturas != ? ";
                $data = array("i", "{-1}");
            }
        }

        $sql.=" Order by asignaturas.idasiganturas $limit";

        $fields = array("idasiganturas" => "", "asignaturas" => "", "anio"=>"", "plan"=>"", "thoras"=>"", "turno_idturno"=>"");
        DBConnector::ejecutar($sql, $data, $fields);

        return DBConnector::$results;
        
    }
    
    public function getDC($array)
    {
        
        foreach($array as $campo=>$valor)
        {
            $$campo = $valor;
        }
        
        $cadena = "";
        $data = array();
        $data_llenado = array();
        
        $sql = "SELECT asignaturas.idasiganturas from asignaturas INNER join turno INNER join carreras INNER JOIN departamento
on asignaturas.turno_idturno = turno.idturno and turno.carreras_id = carreras.id and departamento.id = carreras._id ";
        $var = false;
        
            //Construir parametros
        if(isset($asignatura)){
            if (strlen($asignatura)>0)
            {
                    $sql.="where asignaturas.asignaturas LIKE ? ";
                    $cadena .= "s";
                    $asignatura = '%'.strtoupper($asignatura).'%';
                    $data_llenado[] = $asignatura;
                    $var = true;
            }
        }
	//$var = false;
        if(isset($departamento)){
	if (strlen($departamento)>0 and $var)
	{
		$sql.=" and departamento.id = ? ";
		$var = true;
                $cadena .= "s";
                $departamento = $departamento;
                $data_llenado[] = $departamento;
	}
	elseif (strlen($departamento)>0)
	{
		$sql.="WHERE departamento.id = ?";
		$var = true;
                $cadena .= "s";
                $departamento = $departamento;
                $data_llenado[] = $departamento;
	}
        }
        
        if(isset($carreras)){
	if (strlen($carreras)>0 and $var)
	{
		$sql.=" and carreras.id = ? ";
		$var = true;
                $cadena .= "s";
                $carreras = $carreras;
                $data_llenado[] = $carreras;
	}
	elseif (strlen($carreras)>0)
	{
		$sql.="WHERE carreras.id = ?";
		$var = true;
                $cadena .= "s";
                $carreras = $carreras;
                $data_llenado[] = $carreras;
	}
        }
        
        
        if(isset($plan)){
	if (strlen($plan)>0 and $var)
	{
		$sql.=" and asignaturas.plan = ? ";
		$var = true;
                $cadena .= "s";
                $plan = $plan;
                $data_llenado[] = $plan;
	}
	elseif (strlen($plan)>0)
	{
		$sql.="WHERE asignaturas.plan = ?";
		$var = true;
                $cadena .= "s";
                $plan = $plan;
                $data_llenado[] = $plan;
	}
        }
        
        if(isset($anio)){
	if (strlen($anio)>0 and $var)
	{
		$sql.=" and asignaturas.anio = ? ";
		$var = true;
                $cadena .= "s";
                $anio = $anio;
                $data_llenado[] = $anio;
	}
	elseif (strlen($anio)>0)
	{
		$sql.="WHERE asignaturas.anio = ?";
		$var = true;
                $cadena .= "s";
                $anio = $anio;
                $data_llenado[] = $anio;
	}
        }
        
        if(isset($turno_idturno)){
	if (strlen($turno_idturno)>0 and $var)
	{
		$sql.=" and turno.idturno = ? ";
		$var = true;
                $cadena .= "s";
                $turno_idturno = $turno_idturno;
                $data_llenado[] = $turno_idturno;
	}
	elseif (strlen($turno_idturno)>0)
	{
		$sql.="WHERE turno.idturno = ?";
		$var = true;
                $cadena .= "s";
                $turno_idturno = $turno_idturno;
                $data_llenado[] = $turno_idturno;
	}
        }

        $data[0] = $cadena;
        
        for ($index = 0; $index < count($data_llenado); $index++) {
            $data[$index+1] = "{$data_llenado[$index]}";
        }
        if (strlen($data[0]==0))
        {
            if(count($data)==0 or count($data)==1)
            {
                $sql.="WHERE asignaturas.idasiganturas != ? ";
                $data = array("i", "{-1}");
            }
        }

        $sql.=" Order by asignaturas.idasiganturas";
        
        //print_r($array);echo $sql;exit();

        $fields = array("id" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
        
    }
    
    public static function getStatic_Modalidad($idCar)
    {
        $sql = "select idturno, turno from turno where carreras_id = ?";
        $data = array("i", "{$idCar}");
        $fields = array("idturno" => "", "turno"=>"");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    
    
    public static function getStatic_facultad()
    {
        $sql = "select idfacultad, facultad from facultad where idfacultad != ?";
        $data = array("i", "{-1}");
        $fields = array("idfacultad" => "", "facultad"=>"");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_facultadUSER($user)
    {
        $sql = "SELECT idfacultad from facultad INNER join departamento INNER JOIN docentes ON facultad.idfacultad = departamento._idfacultad and departamento.id = docentes.departamento_id WHERE docentes.id = ?";
        $data = array("i", "{$user}");
        $fields = array("idfacultad" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_CarreraEtiqueta($id)
    {
        $sql = "SELECT carreras.carreras FROM carreras WHERE carreras.id = ?";
        $data = array("i", "{$id}");
        $fields = array("carreras" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    
    public static function getStatic_departamento($fac)
    {
        $sql = "select id, departamento from departamento where _idfacultad = ? order by id";
        $data = array("i", "{$fac}");
        $fields = array("id" => "", "departamento"=>"");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_carreras($dep)
    {
        $sql = "SELECT carreras.id, carreras.carreras, carreras._id from carreras WHERE carreras._id = ?";
        $data = array("i", "{$dep}");
        $fields = array("id" => "", "carreras"=>"", "_id"=>"");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_departamentoUSER($user)
    {
        $sql = "SELECT departamento.id from departamento INNER JOIN docentes ON departamento.id = docentes.departamento_id WHERE docentes.id = ?";
        $data = array("i", "{$user}");
        $fields = array("id" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_ModalidadUSER($user)
    {
        $sql = "SELECT idfacultad from facultad INNER join departamento INNER JOIN docentes ON facultad.idfacultad = departamento._idfacultad and departamento.id = docentes.departamento_id WHERE docentes.id = ?";
        $data = array("i", "{$user}");
        $fields = array("idfacultad" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_facultadETIQUETA($id)
    {
        $sql = "SELECT facultad from facultad where idfacultad = ?";
        $data = array("i", "{$id}");
        $fields = array("facultad" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_ModalidadETIQUETA($id)
    {
        $sql = "SELECT turno from turno WHERE turno.idturno = ?";
        $data = array("i", "{$id}");
        $fields = array("turno" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public function setDepartamento($array = array())
    {
        foreach($array as $campo=>$valor)
        {
            $$campo = $valor;
        }
        $sql = "INSERT INTO `departamento` (`departamento`, `_idfacultad`) VALUES (?, ?);";
        $data = array("si", "{$departamento}", "{$facultad}");
        $result1 = DBConnector::ejecutar($sql, $data);
        if ($result1)
        {
            echo '<script>window.location.href="dc.php?r=1";</script>';
        }else
        {
            echo '<script>window.location.href="dc.php?r=2";</script>';
        }
    }
    
    public function getDepartamento($id)
    {
        $sql = "select id, departamento, _idfacultad from departamento where id = ?";  
        $data = array("i", "{$id}");
        $fields = array("id" => "", "departamento" => "", "_idfacultad"=>"");
        DBConnector::ejecutar($sql, $data, $fields);

        return DBConnector::$results;
    }
    
    public function setEditD($array = array())
    {
        foreach($array as $campo=>$valor)
        {
            $$campo = $valor;
        }

        $sql = "UPDATE `departamento` SET `departamento` = ?, `_idfacultad` = ? WHERE `id` = ?;";
        
        
        $data = array("sii", "{$departamento}", "{$facultad}", "{$id}");
        $result = DBConnector::ejecutar($sql, $data);
        $result_c = DBConnector::$filaAfectada;
        
        if ($result or ($result_c > 0))
        {
            echo '<script>window.location.href="dc.php?e=1";</script>';
            
        }else
        {
            echo '<script>window.location.href="dc.php?e=2";</script>';
            
        }
    }
    
    public function delete($id)
    {
        $sql = "DELETE FROM `departamento` WHERE `id` = ?";
        $data = array("i", "{$id}");
        $result1 = DBConnector::ejecutar($sql, $data);
        $result1_c = DBConnector::$filaAfectada;
        
        if ($result1 or ($result1_c > 0))
        {
           echo '<script>window.location.href="dc.php?d=1";</script>';
        }else
        {
            echo '<script>window.location.href="dc.php?d=2";</script>';
        }
    }
    
    public static function getStatic_departamentoETIQUETA($id)
    {
        $sql = "SELECT departamento from departamento where id = ?";
        $data = array("i", "{$id}");
        $fields = array("departamento" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
}