<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DBConnector
 *
 * @author lmanuel
 */
class DBConnector {

    protected static $conn;
    protected static $stmt;
    protected static $reflection;
    protected static $sql;
    protected static $data;
    public static $results;
    public static $id;
    public static $filaAfectada;
    private static $db_host = 'localhost';
    private static $db_user = 'root';
    private static $db_pass = 'sistemas';
    protected $db_name = 'carga';
    
    protected static function conectar() {
        self::$conn = new mysqli(self::$db_host, self::$db_user, self::$db_pass, 'carga');
        mysqli_set_charset(self::$conn, "utf8");
        if (self::$conn -> connect_errno) {
            die( "Fallo la conexión a MySQL: (" . self::$conn -> mysqli_connect_errno() . ") " . self::$conn -> mysqli_connect_error());
        }
    }

    protected static function preparar() {
        self::$stmt = self::$conn->prepare(self::$sql);
        self::$reflection = new ReflectionClass('mysqli_stmt');
    }

    protected static function set_params() {
        $method = self::$reflection->getMethod('bind_param');
        $method->invokeArgs(self::$stmt, self::$data);
    }

    protected static function get_data($fields) {
        $method = self::$reflection->getMethod('bind_result');
        $method->invokeArgs(self::$stmt, $fields);
        while (self::$stmt->fetch()) {
            self::$results[] = unserialize(serialize($fields));
        }
    }

    protected static function finalizar() {
        self::$stmt->close();
        self::$conn->close();
    }

    public static function ejecutar($sql, $data, $fields = False) {
        //$result = false;
        self::$results = array();
        self::$sql = $sql;
        self::$data = $data;
        //print_r(self::$data);
        self::conectar();
        self::preparar();
        self::set_params();

        $result = self::$stmt->execute();
        self::$filaAfectada = self::$stmt->affected_rows;
        if ($fields) {
            self::get_data($fields);
        } else {
            if (strpos(self::$sql, strtoupper('INSERT')) === 0) {
                self::$id = self::$stmt->insert_id;
                return $result;
            }
        }
        
        self::finalizar();
    }

}
