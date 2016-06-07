<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of p
 *
 * @author lmanuel
 */
class p {
    //put your code here
    
    //Metodo de insercion de usuario
    public function setPeriodo($array = array())
    {
        foreach($array as $campo=>$valor)
        {
            $$campo = $valor;
        }
        
        $finicio = strtotime($finicio);
        $ffin = strtotime($ffin);
        
        if (self::getStatic_periodo_loop($anio_lectivo, $semestre_id)[0]["cantidad"])
        {
            header("Location: p.php?r=p1");
        }  
        else {
            $sql = "INSERT INTO `periodo` (`finicio`, `ffin`, `semestre_id`, `estado`, `descripcion`, `anio_lectivo`) VALUES (?, ?, ?, ?, ?, ?);";
            //echo $sql;

            $data = array("iiiisi", "{$finicio}", "{$ffin}", "{$semestre_id}", "{$estado}", "{$descripcion}", "{$anio_lectivo}");
            $result1 = DBConnector::ejecutar($sql, $data);
            if ($result1)
            {
                header("Location: p.php?r=1");
            }else
            {
                header("Location: p.php?r=2");
            }
        }
    }
    
    public static function getStatic_semestre()
    {
        $sql = "select id, nombre from semestre where id != ?";
        $data = array("i", "{-1}");
        $fields = array("id" => "", "nombre"=>"");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_semestreII($id)
    {
        $sql = "select nombre from semestre where id = ?";
        $data = array("i", "{$id}");
        $fields = array("nombre"=>"");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_activo()
    {
        $sql = "select count(id) as cantidad from periodo where estado = ?";
        $estado = 1;
        $data = array("i", "{$estado}");
        $fields = array("cantidad" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_activo_edit($id, $estado)
    {
        $sql = "select count(id) as cantidad from periodo where id = ? and estado = ?;";
        $data = array("ii", "{$id}", "{$estado}");
        $fields = array("cantidad" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function updateStatic_activo_cerrar()
    {
        $sql = "UPDATE `periodo` SET `estado` = ? WHERE estado = ?;";
        $estado1 = 0;
        $estado2 = 1;
        $data = array("ii", "{$estado1}", "{$estado2}");
        DBConnector::ejecutar($sql, $data);
        $result_update = DBConnector::$filaAfectada;
        return $result_update;
    }
    
    public static function getStatic_periodo_loop($anio_lectivo, $semestre_id)
    {
        $sql = "select count(id) as cantidad from periodo where anio_lectivo = ? and semestre_id = ?";
        $data = array("ii", "{$anio_lectivo}", "{$semestre_id}");
        $fields = array("cantidad" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public function getPC($array)
    {
        foreach($array as $campo=>$valor)
        {
            $$campo = $valor;
        }
        
        $cadena = "";
        $data = array();
        $data_llenado = array();
        
        $sql = "select anio_lectivo, semestre_id, estado from periodo ";
        $var = false;
        
            //Construir parametros
        if(isset($anio_lectivo)){
            if (strlen($anio_lectivo)>0)
            {
                    $sql.="WHERE anio_lectivo like ? ";
                    $cadena .= "s";
                    $anio_lectivo = '%'.strtoupper(str_replace(' ', '', $anio_lectivo)).'%';
                    $data_llenado[] = strtoupper(str_replace(' ', '', $anio_lectivo));
                    $var = true;
            }
        }
	//$var = false;
        if(isset($semestre_id)){
	if (strlen($semestre_id)>0 and $var)
	{
		$sql.=" and semestre_id like ? ";
		$var = true;
                $cadena .= "s";
                $semestre_id = '%'.$semestre_id.'%';
                $data_llenado[] = $semestre_id;
	}
	elseif (strlen($semestre_id)>0)
	{
		$sql.="WHERE semestre_id like ?";
		$var = true;
                $cadena .= "s";
                $semestre_id = '%'.$semestre_id.'%';
                $data_llenado[] = $semestre_id;
	}
        }
	//$var = false;
        if(isset($estado)){
	if (strlen($estado)>0 and $var)
	{
		$sql.=" and estado like ? ";
		$var = true;
                $cadena .= "s";
                $estado = '%'.$estado.'%';
                $data_llenado[] = $estado;
	}
	elseif (strlen($estado)>0)
	{
		$sql.="WHERE estado like ? ";
		$var = true;
                $cadena .= "s";
                $estado = '%'.$estado.'%';
                $data_llenado[] = $estado;
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

        $sql.=" Order by anio_lectivo";
        
        //print_r($array);echo $sql;exit();

        $fields = array("anio_lectivo" => "", "semestre_id"=>"", "estado"=>"");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
        
    }
    
    public function getPB($array, $limit)
    {
        foreach($array as $campo=>$valor)
        {
            $$campo = $valor;
        }
        $cadena = "";
        $data = array();
        $data_llenado = array();
        
        $sql = "select periodo.id, periodo.anio_lectivo, periodo.semestre_id, periodo.estado from periodo inner join semestre on periodo.semestre_id = semestre.id ";
        $var = false;
        
            //Construir parametros
        if(isset($anio_lectivo)){
            if (strlen($anio_lectivo)>0)
            {
                    $sql.="WHERE anio_lectivo like ? ";
                    $cadena .= "s";
                    $anio_lectivo = '%'.strtoupper(str_replace(' ', '', $anio_lectivo)).'%';
                    $data_llenado[] = strtoupper(str_replace(' ', '', $anio_lectivo));
                    $var = true;
            }
        }
	//$var = false;
        if(isset($semestre_id)){
	if (strlen($semestre_id)>0 and $var)
	{
		$sql.=" and semestre_id like ? ";
		$var = true;
                $cadena .= "s";
                $semestre_id = '%'.$semestre_id.'%';
                $data_llenado[] = $semestre_id;
	}
	elseif (strlen($semestre_id)>0)
	{
		$sql.="WHERE semestre_id like ?";
		$var = true;
                $cadena .= "s";
                $semestre_id = '%'.$semestre_id.'%';
                $data_llenado[] = $semestre_id;
	}
        }
	//$var = false;
        if(isset($estado)){
	if (strlen($estado)>0 and $var)
	{
		$sql.=" and estado like ? ";
		$var = true;
                $cadena .= "s";
                $estado = '%'.$estado.'%';
                $data_llenado[] = $estado;
	}
	elseif (strlen($estado)>0)
	{
		$sql.="WHERE estado like ? ";
		$var = true;
                $cadena .= "s";
                $estado = '%'.$estado.'%';
                $data_llenado[] = $estado;
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
                $sql.="WHERE periodo.id != ? ";
                $data = array("i", "{-1}");
            }
        }

        $sql.=" Order by anio_lectivo, semestre.nombre $limit";
//echo $sql;
        $fields = array("id" => "", "anio_lectivo" => "", "semestre_id"=>"", "estado"=>"");
        DBConnector::ejecutar($sql, $data, $fields);

        return DBConnector::$results;
        
    }
    
    public function delete($id)
    {
        $sql = "DELETE FROM `periodo` WHERE `id` = ?";
        $data = array("i", "{$id}");
        $result1 = DBConnector::ejecutar($sql, $data);
        $result1_c = DBConnector::$filaAfectada;
        
        if ($result1 or ($result1_c > 0))
        {
            header("Location: p.php?d=1");
        }else
        {
            header("Location: p.php?d=2");
        }
    }
    
    public function open($id)
    {
        $sql = "UPDATE `periodo` SET `estado` = '1' WHERE `id` = ?;";
            $data = array("i", "{$id}");
            $result = DBConnector::ejecutar($sql, $data);
            $result_c = DBConnector::$filaAfectada;
            
            if ($result or $result_c > 0)
        {
            
            echo '<script>window.location.href="p.php?o=1";</script>';
        }else
        {
            
            echo '<script>window.location.href="p.php?o=2";</script>';
        }
    }
    
    public function close($id)
    {
        $sql = "UPDATE `periodo` SET `estado` = '0' WHERE `id` = ?;";
            $data = array("i", "{$id}");
            $result = DBConnector::ejecutar($sql, $data);
            $result_c = DBConnector::$filaAfectada;
            
        if ($result or $result_c > 0)
        {
            echo '<script>window.location.href="p.php?c=1";</script>';
        }else
        {
            
            echo '<script>window.location.href="p.php?c=2";</script>';
        }
    }
    
    public function getPerido($id)
    {
        $sql = "select id, finicio, ffin, semestre_id, estado, descripcion, anio_lectivo from periodo where id = ?";  
        $data = array("i", "{$id}");
        $fields = array("id" => "", "finicio" => "", "ffin"=>"", "semestre_id"=>"", "estado"=>"", "descripcion"=>"", "anio_lectivo"=>"");
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
        
        $finicio = strtotime($finicio);
        $ffin = strtotime($ffin);
        
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
    //
}
