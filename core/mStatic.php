<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mStatic
 *
 * @author lmanuel
 */

class mStatic {
    
    static function fechas($fecha)
    {
        $d = "";
        $fecha = explode("/", $date);
        $d = $fecha[2]."-".$fecha[1]."-".$fecha[0];
        return $d;
    }
    
    static function checkbrute($user_id){
    // Obtiene el timestamp del tiempo actual.
    $now = time();
    // Todos los intentos de inicio de sesión se cuentan desde las 2 horas anteriores.
    $valid_attempts = $now - (2 * 60 * 60);
    $sql="SELECT tiempo
                             FROM acceso 
                             WHERE usuario_docentes_id = ?
                            AND tiempo > ?";
    //echo $sql;
    $data = array("ss", "{$user_id}", "{$valid_attempts}");
    
    $fields = array("tiempo" => "");
    DBConnector::ejecutar($sql, $data, $fields);
    
    if (count(DBConnector::$results)>=3)
    {        
            return true;
        } else {
            return false;
        }
}

public static function delete($user_id = '') {
        $sql = "DELETE FROM `acceso` WHERE `usuario_docentes_id`= ?;";
        $data = array("s", "{$user_id}");
        DBConnector::ejecutar($sql, $data);
    }
    
public static function setCheckbrute($user_id)
    {
        $now = time();
        $sql = "INSERT INTO `acceso`(`tiempo`, `usuario_docentes_id`) VALUES (?, ?)";
        $data = array("ss", "{$now}", "{$user_id}");
        DBConnector::ejecutar($sql, $data);
    }

    static function cantidad_logueo($user_id) {
        $sql = "SELECT tiempo FROM acceso WHERE usuario_docentes_id = ? ";
        $data = array("s", "{$user_id}");
        $fields = array("tiempo" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        //var_dump(DBConnector::$results);
        return 3 - count(DBConnector::$results);
    }
    
    static function url_acces($user) {
        $sql = "SELECT archivo FROM menu inner join tusuario_has_menu inner join tusuario inner join usuario on menu.id = tusuario_has_menu.menu_id and tusuario.id = tusuario_has_menu.tusuario_id and usuario.tusuario_id = tusuario.id where usuario.docentes_id = ? ";
        $data = array("i", "{$user}");
        $fields = array("archivo" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        //var_dump(DBConnector::$results);
        return DBConnector::$results;
    }
}
