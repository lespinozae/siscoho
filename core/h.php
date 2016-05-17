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
class tc_y_p {
    //put your code here
    
    public static function getStatic_tc()
    {
        $sql = "select id, contratacion, limiteshoras from tipo_contratacion where id != ? order by id asc";
        $data = array("i", "{-1}");
        $fields = array("id" => "", "contratacion"=>"", "limiteshoras"=>"");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public static function getStatic_n()
    {
        $sql = "select id, nivel, pagoxhora from nivel_academico where id != ? order by id asc";
        $data = array("i", "{-1}");
        $fields = array("id" => "", "nivel"=>"", "pagoxhora"=>"");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public function setEdit_tc($campo, $valor, $id)
    {
        $sql = "UPDATE `tipo_contratacion` SET `$campo` = ? WHERE `id` = ?;";//echo $sql;
        
        $data = array("di", "{$valor}", "{$id}");
        //print_r($data);
        $result = DBConnector::ejecutar($sql, $data);
        $result_c = DBConnector::$filaAfectada;
        
        if ($result or ($result_c > 0))
        {
            
            return true;
        }else
        {
            
            return false;
        }
    }
    
    public function setEdit_n($campo, $valor, $id)
    {
        $sql = "UPDATE `nivel_academico` SET `$campo` = ? WHERE `id` = ?;";//echo $sql;
        $data = array("di", "{$valor}", "{$id}");
        //print_r($data);
        $result = DBConnector::ejecutar($sql, $data);
        $result_c = DBConnector::$filaAfectada;
        
        if ($result or ($result_c > 0))
        {
            
            return true;
        }else
        {
            
            return false;
        }
    }
}
