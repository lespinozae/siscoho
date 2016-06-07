<?php

class departamento {
    
    public function getDB($array, $limit)
    {
        foreach($array as $campo=>$valor)
        {
            $$campo = $valor;
        }
        
        $cadena = "";
        $data = array();
        $data_llenado = array();
        
        $sql = "SELECT departamento.id, departamento.departamento, facultad.facultad FROM facultad INNER join departamento ON facultad.idfacultad = departamento._idfacultad ";
        $var = false;
        
            //Construir parametros
        if(isset($departamento)){
            if (strlen($departamento)>0)
            {
                    $sql.="WHERE departamento like ? ";
                    $cadena .= "s";
                    $departamento = '%'.strtoupper(str_replace(' ', '', $departamento)).'%';
                    $data_llenado[] = strtoupper(str_replace(' ', '', $departamento));
                    $var = true;
            }
        }
	//$var = false;
        if(isset($facultad)){
	if (strlen($facultad)>0 and $var)
	{
		$sql.=" and _idfacultad like ? ";
		$var = true;
                $cadena .= "s";
                $facultad = '%'.$facultad.'%';
                $data_llenado[] = $facultad;
	}
	elseif (strlen($facultad)>0)
	{
		$sql.="WHERE _idfacultad like ?";
		$var = true;
                $cadena .= "s";
                $facultad = '%'.$facultad.'%';
                $data_llenado[] = $facultad;
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
                $sql.="WHERE departamento.id != ? ";
                $data = array("i", "{-1}");
            }
        }

        $sql.=" Order by departamento $limit";
//echo $sql;
        $fields = array("id" => "", "departamento" => "", "facultad"=>"");
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
        
        $sql = "select id from departamento ";
        $var = false;
        
            //Construir parametros
        if(isset($departamento)){
            if (strlen($departamento)>0)
            {
                    $sql.="WHERE departamento like ? ";
                    $cadena .= "s";
                    $departamento = '%'.strtoupper(str_replace(' ', '', $departamento)).'%';
                    $data_llenado[] = strtoupper(str_replace(' ', '', $departamento));
                    $var = true;
            }
        }
	//$var = false;
        if(isset($facultad)){
	if (strlen($facultad)>0 and $var)
	{
		$sql.=" and _idfacultad like ? ";
		$var = true;
                $cadena .= "s";
                $facultad = '%'.$facultad.'%';
                $data_llenado[] = $facultad;
	}
	elseif (strlen($facultad)>0)
	{
		$sql.="WHERE _idfacultad like ?";
		$var = true;
                $cadena .= "s";
                $facultad = '%'.$facultad.'%';
                $data_llenado[] = $facultad;
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

        $sql.=" Order by departamento";
        
        //print_r($array);echo $sql;exit();

        $fields = array("id" => "");
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
    
    public function setDepartamento($array = array())
    {
        foreach($array as $campo=>$valor)
        {
            $$campo = $valor;
        }
        $sql = "INSERT INTO `departamento` (`departamento`, `_idfacultad`) VALUES (?, ?);";
        //echo $sql;
        //print_r($array);
        $data = array("si", "{$departamento}", "{$facultad}");
        $result1 = DBConnector::ejecutar($sql, $data);
        if ($result1)
        {
            header("Location: dc.php?r=1");
        }else
        {
            header("Location: dc.php?r=2");
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
    
    public function setEditP($array = array())
    {
        //print_r($array);
        //exit();
        foreach($array as $campo=>$valor)
        {
            $$campo = $valor;
        }
        
        
        
//Beneficiario
        $sql = "UPDATE `periodo` SET `finicio` = ?, `ffin` = ?, `semestre_id` = ?, `estado` = ?, `descripcion` = ?, `anio_lectivo` = ? WHERE `id` = ?;";
        
        
        $data = array("iiiisii", "{$finicio}", "{$ffin}", "{$semestre_id}", "{$estado}", "{$descripcion}", "{$anio_lectivo}", "{$id}");
        $result = DBConnector::ejecutar($sql, $data);
        $result_c = DBConnector::$filaAfectada;
        
        if ($result or ($result_c > 0))
        {
            
            header("Location: p.php?e=1");
        }else
        {
            
            header("Location: p.php?e=2");
        }
    }
}