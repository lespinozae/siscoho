<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author lmanuel
 */
class user {
    
    public function getUser($idUSer)
    {
        $sql = "select id, cedula, inss, pnombre, snombre, papellido, sapellido, sexo, telefono, direccion, direccion2, tipo_contratacion_id, "
                . "categoria_docente_id, departamento_id, ccontrato_id, ecivil_id, oficio_id, nacionalidad_id, nivel_academico_id from docentes where id = ?";  
        $data = array("s", "{$idUSer}");
        $fields = array("id" => "", "cedula" => "", "inss"=>"", "pnombre"=>"", "snombre"=>"", 
            "papellido"=>"", "sapellido"=>"", "sexo"=>"", "telefono"=>"", "direccion"=>"", "direccion2"=>"", "tipo_contratacion_id"=>"",
            "categoria_docente_id"=>"", "departamento_id"=>"", "ccontrato_id"=>"", "ecivil_id"=>"", "oficio_id"=>"", "nacionalidad_id"=>"", "nivel_academico_id"=>"");
        DBConnector::ejecutar($sql, $data, $fields);

        return DBConnector::$results;
    }
    
    public function getUserC($array)
    {
        foreach($array as $campo=>$valor)
        {
            $$campo = $valor;
        }
        $cadena = "";
        $data = array();
        $data_llenado = array();
        
        $sql = "select cedula, pnombre, snombre, papellido, sapellido from docentes ";
        $var = false;
        
            //Construir parametros
        if(isset($cedula)){
            if (strlen($cedula)>0)
            {
                    $sql.="WHERE cedula like ? ";
                    $cadena .= "s";
                    $cedula = '%'.strtoupper(str_replace(' ', '', $cedula)).'%';
                    $data_llenado[] = strtoupper(str_replace(' ', '', $cedula));
                    $var = true;
            }
        }
	//$var = false;
        if(isset($pnombre)){
	if (strlen($pnombre)>0 and $var)
	{
		$sql.=" and pnombre like ? ";
		$var = true;
                $cadena .= "s";
                $pnombre = '%'.$pnombre.'%';
                $data_llenado[] = $pnombre;
	}
	elseif (strlen($pnombre)>0)
	{
		$sql.="WHERE pnombre like ?";
		$var = true;
                $cadena .= "s";
                $pnombre = '%'.$pnombre.'%';
                $data_llenado[] = $pnombre;
	}
        }
	//$var = false;
        if(isset($snombre)){
	if (strlen($snombre)>0 and $var)
	{
		$sql.=" and snombre like ? ";
		$var = true;
                $cadena .= "s";
                $snombre = '%'.$snombre.'%';
                $data_llenado[] = $snombre;
	}
	elseif (strlen($snombre)>0)
	{
		$sql.="WHERE snombre like ? ";
		$var = true;
                $cadena .= "s";
                $snombre = '%'.$snombre.'%';
                $data_llenado[] = $snombre;
	}
        }
        //$var = false;
        if(isset($papellido)){
	if (strlen($papellido)>0 and $var)
	{
		$sql.=" and papellido like ? ";
		$var = true;
                $cadena .= "s";
                $papellido = '%'.$papellido.'%';
                $data_llenado[] = $papellido;
	}
	elseif (strlen($papellido)>0)
	{
		$sql.="WHERE papellido like ?";
		$var = true;
                $cadena .= "s";
                $papellido = '%'.$papellido.'%';
                $data_llenado[] = $papellido;
	}
        }
        
        //$var = false;
        if(isset($sapellido)){
	if (strlen($sapellido)>0 and $var)
	{
		$sql.=" and sapellido like ? ";
		$var = true;
                $cadena .= "s";
                $sapellido = '%'.$sapellido.'%';
                $data_llenado[] = $sapellido;
	}
	elseif (strlen($sapellido)>0)
	{
		$sql.="WHERE sapellido like ?";
		$var = true;
                $cadena .= "s";
                $sapellido = '%'.$sapellido.'%';
                $data_llenado[] = $sapellido;
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
                $sql.="WHERE cedula != ? ";
                $data = array("s", "{-1}");
            }
        }

        $sql.=" Order by papellido";
//echo $sql;
        $fields = array("cedula" => "", "pnombre"=>"", "snombre"=>"", 
            "papellido"=>"", "sapellido"=>"");
        DBConnector::ejecutar($sql, $data, $fields);

        return DBConnector::$results;
        
    }
    
    public function getUserB($array, $limit)
    {
        foreach($array as $campo=>$valor)
        {
            $$campo = $valor;
        }
        $cadena = "";
        $data = array();
        $data_llenado = array();
        
        $sql = "select id, cedula, pnombre, snombre, papellido, sapellido from docentes ";
        
        $var = false;
        
            //Construir parametros
        if(isset($cedula)){
            if (strlen($cedula)>0)
            {
                    $sql.="WHERE cedula like ? ";
                    $cadena .= "s";
                    $cedula = '%'.strtoupper(str_replace(' ', '', $cedula)).'%';
                    $data_llenado[] = strtoupper(str_replace(' ', '', $cedula));
                    $var = true;
            }
        }
	//$var = false;
        if(isset($pnombre)){
	if (strlen($pnombre)>0 and $var)
	{
		$sql.=" and pnombre like ? ";
		$var = true;
                $cadena .= "s";
                $pnombre = '%'.$pnombre.'%';
                $data_llenado[] = $pnombre;
	}
	elseif (strlen($pnombre)>0)
	{
		$sql.="WHERE pnombre like ?";
		$var = true;
                $cadena .= "s";
                $pnombre = '%'.$pnombre.'%';
                $data_llenado[] = $pnombre;
	}
        }
	//$var = false;
        if(isset($snombre)){
	if (strlen($snombre)>0 and $var)
	{
		$sql.=" and snombre like ? ";
		$var = true;
                $cadena .= "s";
                $snombre = '%'.$snombre.'%';
                $data_llenado[] = $snombre;
	}
	elseif (strlen($snombre)>0)
	{
		$sql.="WHERE snombre like ? ";
		$var = true;
                $cadena .= "s";
                $snombre = '%'.$snombre.'%';
                $data_llenado[] = $snombre;
	}
        }
        //$var = false;
        if(isset($papellido)){
	if (strlen($papellido)>0 and $var)
	{
		$sql.=" and papellido like ? ";
		$var = true;
                $cadena .= "s";
                $papellido = '%'.$papellido.'%';
                $data_llenado[] = $papellido;
	}
	elseif (strlen($papellido)>0)
	{
		$sql.="WHERE papellido like ?";
		$var = true;
                $cadena .= "s";
                $papellido = '%'.$papellido.'%';
                $data_llenado[] = $papellido;
	}
        }
        
        //$var = false;
        if(isset($sapellido)){
	if (strlen($sapellido)>0 and $var)
	{
		$sql.=" and sapellido like ? ";
		$var = true;
                $cadena .= "s";
                $sapellido = '%'.$sapellido.'%';
                $data_llenado[] = $sapellido;
	}
	elseif (strlen($sapellido)>0)
	{
		$sql.="WHERE sapellido like ?";
		$var = true;
                $cadena .= "s";
                $sapellido = '%'.$sapellido.'%';
                $data_llenado[] = $sapellido;
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
                $sql.="WHERE cedula != ? ";
                $data = array("s", "{-1}");
            }
        }

        $sql.=" Order by papellido $limit";
//echo $sql;
        $fields = array("id" => "", "cedula" => "", "pnombre"=>"", "snombre"=>"", 
            "papellido"=>"", "sapellido"=>"");
        DBConnector::ejecutar($sql, $data, $fields);

        return DBConnector::$results;
        
    }
    
    //Metodos estaticos de las categorias de cada docente
    
    public static function getStatic_tipo_contratacion()
    {
        $sql = "select id, contratacion, descripcion from tipo_contratacion where id != ?";
        $data = array("i", "{-1}");
        $fields = array("id" => "", "contratacion"=>"", "descripcion"=>"");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_categoria_docente()
    {
        $sql = "select id, categoria, descripcion from categoria_docente where id != ?";
        $data = array("i", "{-1}");
        $fields = array("id" => "", "categoria"=>"", "descripcion"=>"");
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
    
    public static function getStatic_facultad_mas_departamento($dep)
    {
        $sql = "select idfacultad from facultad inner join departamento on facultad.idfacultad = departamento._idfacultad where departamento.id = ?";
        $data = array("i", "{$dep}");
        $fields = array("idfacultad" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_departamento($idf)
    {
        $sql = "select id, departamento, _idfacultad from departamento where _idfacultad = ?";
        $data = array("i", "{$idf}");
        $fields = array("id" => "", "departamento"=>"", "_idfacultad"=>"");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    public static function getStatic_ccontrato()
    {
        $sql = "select id, nombre from ccontrato where id != ?";
        $data = array("i", "{-1}");
        $fields = array("id" => "", "nombre"=>"");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_ecivil()
    {
        $sql = "select id, nombre from ecivil where id != ?";
        $data = array("i", "{-1}");
        $fields = array("id" => "", "nombre"=>"");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_oficio()
    {
        $sql = "select id, nombre from oficio where id != ?";
        $data = array("i", "{-1}");
        $fields = array("id" => "", "nombre"=>"");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_nacionalidad()
    {
        $sql = "select id, nombre from nacionalidad where id != ?";
        $data = array("i", "{-1}");
        $fields = array("id" => "", "nombre"=>"");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_nivel_academico()
    {
        $sql = "select id, nivel, pagoxhora from nivel_academico where id != ?";
        $data = array("i", "{-1}");
        $fields = array("id" => "", "nivel"=>"", "pagoxhora"=>"");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_tusuario()
    {
        $sql = "select id, nombre from tusuario where id != ?";
        $data = array("i", "{-1}");
        $fields = array("id" => "", "nombre"=>"");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_departamento_v2($fac)
    {
        $sql = "select id, departamento, _idfacultad from `departamento` where id = ?";
        $data = array("i", "{-1}");
        $fields = array("id" => "", "departamento"=>"", "_idfacultad"=>"");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_id($cedula)
    {
        $cedula = strtoupper(str_replace(' ', '', $cedula));
        echo $cedula;
        $sql = "select id from docentes where cedula = ?";
        $data = array("s", "{$cedula}");
        $fields = array("id" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        print_r(DBConnector::$results);
        return DBConnector::$results;
    }
    
    //Metodo de insercion de usuario
    public function setUser($array = array())
    {
        //ini_set('display_errors', 1);
//error_reporting(E_ALL);
        //print_r($array);
        foreach($array as $campo=>$valor)
        {
            $$campo = $valor;
        }
        $cedula = strtoupper(str_replace(' ', '', $cedula));
        
//Docente
        $sql = "INSERT INTO docentes (cedula, inss, pnombre, snombre, papellido, sapellido, sexo, telefono, tipo_contratacion_id, direccion, direccion2, categoria_docente_id, departamento_id, ccontrato_id, ecivil_id, oficio_id, nacionalidad_id, nivel_academico_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        //echo $sql;
        
        $data = array("sssssssissssssiiii", "{$cedula}", "{$inss}", "{$pnombre}", "{$snombre}", "{$papellido}", "{$sapellido}", "{$sexo}", "{$telefono}", "{$tc}", "{$direccion}", "{$direccion2}","{$cd}", "{$d}", "{$cc}", "{$ec}", "{$o}", "{$n}", "{$na}");
        $result1 = DBConnector::ejecutar($sql, $data);
        
        $cedula = self::getStatic_id($cedula)[0]["id"];
        //echo $cedula;
        //exit();
//Usuario
        $sql = "INSERT INTO `usuario` (`pass`, `docentes_id`, `tusuario_id`) VALUES (?, ?, ?);";
        //echo $sql;
        $password = md5($password);
        $data = array("ssi", "{$password}", "{$cedula}", "{$tu}");
        $result2 = DBConnector::ejecutar($sql, $data);
        //echo $sql;
//Beneficiario
        $sql = "INSERT INTO `beneficiario` (`cedula`, `nombre`, `apellidos`, `direccion`, `docentes_id`) VALUES (?, ?, ?, ?, ?);";
        //echo $sql;
        
        $data = array("sssss", "{$cb}", "{$nb}", "{$ab}", "{$db}", "{$cedula}");
        $result3 = DBConnector::ejecutar($sql, $data);
        //echo $sql;
        
        //exit();
        if ($result1 and $result2 and $result3)
        {
            
            header("Location: user.php?r=1");
        }else
        {
            
            header("Location: user.php?r=2");
        }
    }
    
    public function setEditUser($array = array())
    {
        //print_r($array);
        //exit();
        foreach($array as $campo=>$valor)
        {
            $$campo = $valor;
        }
        
//Docente
        if(isset($cedula))
        {
        $cedula = strtoupper(str_replace(' ', '', $cedula));
        $sql = "UPDATE `docentes` SET `cedula` = ?, `inss` = ?, `pnombre` = ?, `snombre` = ?, `papellido` = ?, `sapellido` = ?, `sexo` = ?, `telefono` = ?, `direccion` = ?, `direccion2` = ?, `tipo_contratacion_id` = ?, `categoria_docente_id` = ?, `departamento_id` = ?, `ccontrato_id` = ?, `ecivil_id` = ?, `oficio_id` = ?, `nacionalidad_id` = ?, `nivel_academico_id` = ? WHERE `id` = ?";
        //echo $sql;
        
        $data = array("sssssssissssssiiiis", "{$cedula}", "{$inss}", "{$pnombre}", "{$snombre}", "{$papellido}", "{$sapellido}", "{$sexo}", "{$telefono}", "{$direccion}", "{$direccion2}", "{$tc}", "{$cd}", "{$d}", "{$cc}", "{$ec}", "{$o}", "{$n}", "{$na}", "{$cedulam}");
        $result1 = DBConnector::ejecutar($sql, $data);
        $result1_c = DBConnector::$filaAfectada;
        }
        else
        {
            $sql = "UPDATE `docentes` SET `inss` = ?, `pnombre` = ?, `snombre` = ?, `papellido` = ?, `sapellido` = ?, `sexo` = ?, `telefono` = ?, `direccion` = ?, `direccion2` = ?, `tipo_contratacion_id` = ?, `categoria_docente_id` = ?, `departamento_id` = ?, `ccontrato_id` = ?, `ecivil_id` = ?, `oficio_id` = ?, `nacionalidad_id` = ?, `nivel_academico_id` = ? WHERE `id` = ?";
        //echo $sql;
        
        $data = array("ssssssissssssiiiis", "{$inss}", "{$pnombre}", "{$snombre}", "{$papellido}", "{$sapellido}", "{$sexo}", "{$telefono}", "{$direccion}", "{$direccion2}", "{$tc}", "{$cd}", "{$d}", "{$cc}", "{$ec}", "{$o}", "{$n}", "{$na}", "{$cedulam}");
        $result1 = DBConnector::ejecutar($sql, $data);
        $result1_c = DBConnector::$filaAfectada;
        }

//Usuario
        if(!isset($password))
        {
            $sql = "UPDATE `usuario` SET `tusuario_id` = ? WHERE `docentes_id` = ?;";
            $data = array("ii", "{$tu}", "{$cedulam}");
            $result2 = DBConnector::ejecutar($sql, $data);
            $result2_c = DBConnector::$filaAfectada;
        }
        else
        {
            $sql = "UPDATE `usuario` SET `pass` = ?, `tusuario_id` = ? WHERE `docentes_id` = ?;";
            $password = md5($password);
            $data = array("sii", "{$password}", "{$tu}", "{$cedulam}");
            $result2 = DBConnector::ejecutar($sql, $data);
            $result2_c = DBConnector::$filaAfectada;
        }
        //echo $result2_c;exit();
//Beneficiario
        $sql = "UPDATE `beneficiario` SET `cedula` = ?, `nombre` = ?, `apellidos` = ?, `direccion` = ? WHERE `docentes_id` = ?;";
        //echo $sql;
        
        $data = array("ssssi", "{$cb}", "{$nb}", "{$ab}", "{$db}", "{$cedulam}");
        $result3 = DBConnector::ejecutar($sql, $data);
        $result3_c = DBConnector::$filaAfectada;
        
        
        if ($result1 and $result2 and $result3 or ($result1_c > 0 or $result2_c > 0 or $result3_c > 0))
        {
            
            header("Location: user.php?e=1");
        }else
        {
            
            header("Location: user.php?e=2");
        }
    }
    
    public function getBeneficiario($cedula)
    {
        $sql = "select cedula, nombre, apellidos, direccion from beneficiario where docentes_id = ?";
        $data = array("s", "{$cedula}");
        $fields = array("cedula" => "", "nombre"=>"", "apellidos"=>"", "direccion"=>"");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public function getDatoUser($cedula)
    {
        $sql = "select tusuario_id from usuario where docentes_id = ?";
        $data = array("s", "{$cedula}");
        $fields = array("tusuario_id" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    //DELETE FROM `beneficiario` WHERE `beneficiario`.`cedula` = \'1\'
    //DELETE FROM `usuario` WHERE `usuario`.`docentes_cedula` = \'4\'
    //DELETE FROM `docentes` WHERE `docentes`.`cedula` = \'4\'
    
    public function delete($cedula)
    {
        echo $cedula;
        $sql = "DELETE FROM `beneficiario` WHERE `docentes_id` = ?";
        $data = array("i", "{$cedula}");
        $result1 = DBConnector::ejecutar($sql, $data);
        $result1_c = DBConnector::$filaAfectada;
        //echo $result1;exit();
        $sql = "DELETE FROM `usuario` WHERE `docentes_id` = ?";
        $data = array("i", "{$cedula}");
        $result2 = DBConnector::ejecutar($sql, $data);
        $result2_c = DBConnector::$filaAfectada;
        $sql = "DELETE FROM `docentes` WHERE `id` = ?";
        $data = array("i", "{$cedula}");
        $result3 = DBConnector::ejecutar($sql, $data);
       $result3_c = DBConnector::$filaAfectada;
        if ($result1 and $result2 and $result3 or ($result1_c > 0 or $result2_c > 0 or $result3_c > 0))
        {
            header("Location: user.php?d=1");
        }else
        {
            header("Location: user.php?d=2");
        }
    }
    
    public static function getStatic_existente_user($id)
    {
        $id = strtoupper(str_replace(' ', '', $id));
        $sql = "select count(cedula) as cantidad from docentes where cedula = ?";
        $data = array("s", "{$id}");
        $fields = array("cantidad" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public function setUpdatePass($pass, $id)
    {
            $sql = "UPDATE `usuario` SET `pass` = ? WHERE `docentes_id` = ?;";
            $pass = md5($pass);
            $data = array("si", "{$pass}", "{$id}");
            $result = DBConnector::ejecutar($sql, $data);
            $result_c = DBConnector::$filaAfectada;
            

        
        if ($result or $result_c > 0)
        {
            echo '<script>window.location.href="cpass.php?ecp=1";</script>';
        }else
        {
            echo '<script>window.location.href="cpass.php?ecp=2";</script>';
        }
    }
    
}
