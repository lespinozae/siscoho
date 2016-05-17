<?php

class menu {
    
    public function get($id_padre = 0) {
        $menu = '';
        $sql = "select menu.id as id, menu.menu as menu, menu.archivo as archivo, id_padre from usuario inner join tusuario inner join tusuario_has_menu inner join menu
on tusuario.id = usuario.tusuario_id and tusuario.id = tusuario_has_menu.tusuario_id and menu.id = tusuario_has_menu.menu_id
where usuario.docentes_id = ? and menu.id_padre = ? and m =1";
        
        $user = $_SESSION["user"];
        $data = array("si", "{$user}","{$id_padre}");
        $fields = array("id" => "", "menu" => "", "archivo" => "", "id_padre" => "");
        DBConnector::ejecutar($sql, $data, $fields);
  
        $cant = count(DBConnector::$results);
        $resultados = DBConnector::$results;
        //print_r($resultados);
        if ($cant > 0) {
            
            for ($i = 0; $i< count($resultados); $i++) {
                
                if($resultados[$i]["id_padre"]==0)
                {
                    
                    $menu .= 
                        '<li class="dropdown">';
                    
                    if ($this->getCantidadSubMenu($resultados[$i]["id"])>0)
                    {
                        $menu .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'
                        . $resultados[$i]["menu"];
                        $menu.= ' <span class="caret"></span></a>';
                    }
                    else
                    {
                        $menu .= '<a href="'.$resultados[$i]["archivo"].'">'
                        . $resultados[$i]["menu"];
                    }
                    $menu .= ' <ul class="dropdown-menu">';
                }
                else
                {
                    $menu .= 
                        '<li><a href="'.$resultados[$i]["archivo"].'">' 
                        . $resultados[$i]["menu"] . '</a><li>';
                }
                
                $menu .= $this->get($resultados[$i]["id"]);
                
                if($resultados[$i]["id_padre"]==0)
                {
                    $menu .= '</ul></li>';
                }
            }
        }
        return $menu;
    }
    
    public function getCantidadSubMenu($id_padre = 0) {
        $menu = '';
        $sql = "select menu.id as id from usuario inner join tusuario inner join tusuario_has_menu inner join menu
on tusuario.id = usuario.tusuario_id and tusuario.id = tusuario_has_menu.tusuario_id and menu.id = tusuario_has_menu.menu_id
where usuario.docentes_id = ? and menu.id_padre = ? and m = 1";
        
        $user = $_SESSION["user"];
        $data = array("si", "{$user}","{$id_padre}");
        $fields = array("id" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        
        $cant = count(DBConnector::$results);
        return $cant;
    }
    
    public function getUsuario($id) {
        $sql = "select inss, idTipoUsuario, idUsuarios from tlbusuarios where idUsuarios=?";
        $data = array("i", "{$id}");
        $fields = array("inss" => "", "idTipoUsuario" => "", "idUsuarios" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
    public function getNombreUsuario($cedula) {
        
        $sql = "select pnombre, papellido FROM docentes WHERE id=?";
        $data = array("s", "{$cedula}");
        $fields = array("pnombre" => "", "papellido" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
    
     public function getTipoUsuario($tipo) {
        $sql = "select idTipoUsuario from tlbtipousuario where descipcion = ?";
        $data = array("s", "{$tipo}");
        $fields = array("idTipoUsuario" => "");
        DBConnector::ejecutar($sql, $data, $fields);
        return DBConnector::$results;
    }
}
