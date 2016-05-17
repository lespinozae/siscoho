<?php
# Importar modelo de abstracción de base de datos
require_once('DBConnector.php');
require_once('mStatic.php');

class Usuario
{
    ################################# MÉTODOS ##################################
    # Traer datos de un usuario
    public function get($user_data = array()) {
        if (array_key_exists('user', $user_data) and array_key_exists('password', $user_data)) {
            
            $sql = "select id from docentes WHERE cedula = ?";
            
            $data = array("s", "{$user_data["user"]}");
            $fields = array("id" => "");
            DBConnector::ejecutar($sql, $data, $fields);
            
            if (count(DBConnector::$results) > 0) {
                $id = DBConnector::$results[0]["id"];

                if (!mStatic::checkbrute(filter_var(strip_tags($user_data["user"]), FILTER_SANITIZE_STRING))) {
                    
                    $sql = "select docentes_id FROM usuario WHERE docentes_id = ? and pass = ?";
                    
                    $data = array("is", "{$id}", "{$user_data["password"]}");
                    $fields = array("docentes_id" => "");
                    
                    DBConnector::ejecutar($sql, $data, $fields);
                    
                    if (count(DBConnector::$results) == 1) {
                        session_start();
                        $_SESSION["time"] = time();
                        $_SESSION["user"] = $id;
                        
                        mStatic::delete(filter_var(strip_tags($id), FILTER_SANITIZE_STRING));
                        header("Location: home.php");
                    } else {
                        mStatic::setCheckbrute(filter_var(strip_tags($id), FILTER_SANITIZE_STRING));
                        header("Location: index.php?valid=".base64_encode($id));
                    }
                } else {
                    header("Location: index.php?valid=2");
                }
            } else {
                header('Location: index.php?token=' . md5('$#find#$'));
            }
        }
    }

# Método destructor del objeto
    function __destruct(){
        unset($this);
    }
}
?>