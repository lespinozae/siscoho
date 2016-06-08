<?php

class carreras {
    
    public function getDB($array, $limit)
    {
        foreach($array as $campo=>$valor)
        {
            $$campo = $valor;
        }
        
        $cadena = "";
        $data = array();
        $data_llenado = array();
        
        $sql = "SELECT carreras.id, carreras.carreras, departamento.departamento FROM departamento INNER join carreras ON departamento.id = carreras._id ";
        $var = false;
        
            //Construir parametros
        if(isset($carreras)){
            if (strlen($carreras)>0)
            {
                    $sql.="WHERE carreras like ? ";
                    $cadena .= "s";
                    $carreras = '%'.strtoupper($carreras).'%';
                    $data_llenado[] = $carreras;
                    $var = true;
            }
        }
	//$var = false;
        if(isset($departamento)){
	if (strlen($departamento)>0 and $var)
	{
		$sql.=" and _id like ? ";
		$var = true;
                $cadena .= "s";
                $departamento = '%'.$departamento.'%';
                $data_llenado[] = $departamento;
	}
	elseif (strlen($departamento)>0)
	{
		$sql.="WHERE _id like ?";
		$var = true;
                $cadena .= "s";
                $departamento = '%'.$departamento.'%';
                $data_llenado[] = $departamento;
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
                $sql.="WHERE carreras.id != ? ";
                $data = array("i", "{-1}");
            }
        }

        $sql.=" Order by carreras $limit";
        //echo $sql;
        //print_r($data);exit();
        $fields = array("id" => "", "carreras" => "", "departamento"=>"");
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
        
        $sql = "select id from carreras ";
        $var = false;
        
            //Construir parametros
        if(isset($carreras)){
            if (strlen($carreras)>0)
            {
                    $sql.="WHERE carreras like ? ";
                    $cadena .= "s";
                    $carreras = '%'.strtoupper($carreras).'%';
                    $data_llenado[] = $carreras;
                    $var = true;
            }
        }
	//$var = false;
        if(isset($departamento)){
	if (strlen($departamento)>0 and $var)
	{
		$sql.=" and _id like ? ";
		$var = true;
                $cadena .= "s";
                $departamento = '%'.$departamento.'%';
                $data_llenado[] = $departamento;
	}
	elseif (strlen($departamento)>0)
	{
		$sql.="WHERE _id like ?";
		$var = true;
                $cadena .= "s";
                $departamento = '%'.$departamento.'%';
                $data_llenado[] = $departamento;
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
                $sql.="WHERE id != ? ";
                $data = array("i", "{-1}");
            }
        }

        $sql.=" Order by carreras";
        
        //print_r($array);echo $sql;exit();

        $fields = array("id" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
        
    }
    
    public static function getStatic_departamento()
    {
        $sql = "select id, departamento from departamento where id != ? order by id";
        $data = array("i", "{-1}");
        $fields = array("id" => "", "departamento"=>"");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_departamentoUSER($user)
    {
        $sql = "SELECT departamento.id from departamento INNER join carreras INNER JOIN docentes ON departamento.id = carreras._id and departamento.id = docentes.departamento_id WHERE docentes.id = ?";
        $data = array("i", "{$user}");
        $fields = array("id" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_departamentoETIQUETA($id)
    {
        $sql = "SELECT departamento from departamento where id = ?";
        $data = array("i", "{$id}");
        $fields = array("departamento" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public function setCarrera($array = array())
    {
        foreach($array as $campo=>$valor)
        {
            $$campo = $valor;
        }
        $sql = "INSERT INTO `carreras` (`carreras`, `_id`) VALUES (?, ?);";
        $data = array("si", "{$carreras}", "{$departamento}");
        $result1 = DBConnector::ejecutar($sql, $data);
        $result_c = DBConnector::$filaAfectada;
        
        

        if ($result1 or $result_c>0)
        {
            echo '<script>window.location.href="car.php?r=1&idC='.DBConnector::$id.'";</script>';
        }else
        {
            echo '<script>window.location.href="car.php?r=2";</script>';
        }
    }
    
    public function setModalidad($id, $mod)
    {

        $sql = "INSERT INTO `turno` (`turno`, `carreras_id`) VALUES (?, ?);";
        $data = array("si", "{$mod}", "{$id}");
        $result1 = DBConnector::ejecutar($sql, $data);
        $result_c = DBConnector::$filaAfectada;
        return $result1;
    }
    
    public function getCarrera($id)
    {
        $sql = "select id, carreras, _id from carreras where id = ?";  
        $data = array("i", "{$id}");
        $fields = array("id" => "", "carreras" => "", "_id"=>"");
        DBConnector::ejecutar($sql, $data, $fields);

        return DBConnector::$results;
    }
    
    public function getModalidad($id)
    {
        $sql = "select idturno, turno from turno where carreras_id = ?";  
        $data = array("i", "{$id}");
        $fields = array("id" => "", "turno" => "");
        DBConnector::ejecutar($sql, $data, $fields);

        return DBConnector::$results;
    }
    
    public function setEditC($array = array())
    {
        foreach($array as $campo=>$valor)
        {
            $$campo = $valor;
        }

        $sql = "UPDATE `carreras` SET `carreras` = ?, `_id` = ? WHERE `id` = ?;";
        
        
        $data = array("sii", "{$carreras}", "{$departamento}", "{$id}");
        $result = DBConnector::ejecutar($sql, $data);
        $result_c = DBConnector::$filaAfectada;
        
        if ($result or ($result_c > 0))
        {
            echo '<script>window.location.href="car.php?e=1";</script>';
            
        }else
        {
            echo '<script>window.location.href="car.php?e=2";</script>';
            
        }
    }
    
    public function delete($id)
    {
        $sql = "DELETE FROM `carreras` WHERE `id` = ?";
        $data = array("i", "{$id}");
        $result1 = DBConnector::ejecutar($sql, $data);
        $result1_c = DBConnector::$filaAfectada;
        
        if ($result1 or ($result1_c > 0))
        {
           echo '<script>window.location.href="car.php?d=1";</script>';
        }else
        {
            echo '<script>window.location.href="car.php?d=2";</script>';
        }
    }
    
    
    public function deleteMod($id, $idC)
    {
        $sql = "DELETE FROM `turno` WHERE `idturno` = ?";
        $data = array("i", "{$id}");
        $result1 = DBConnector::ejecutar($sql, $data);
        $result1_c = DBConnector::$filaAfectada;
        
        if ($result1 or ($result1_c > 0))
        {
           echo '<script>window.location.href="mod.php?d=1&id='.$idC.'&BAND='.md5(true).'";</script>';
        }else
        {
            echo '<script>window.location.href="mod.php?d=2";</script>';
        }
    }
}