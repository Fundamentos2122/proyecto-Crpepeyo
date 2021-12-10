<?php

class Usuario
{   
    private $_id;
    private $_nombre_usuario;
    private $_contrasena;
    private $_rol;

    public function __construct($id,$nombre_usuario,$contrasena,$rol)
    {
        $this->setId($id);
        $this->setNombreUsuario($nombre_usuario);
        $this->setContrasena($contrasena);
        $this->setRol($rol);
    }
    
    public function getId()
    {
        return $this->_id;
    }

    public function setId($id)
    {
        $this->_id=$id;
    }
    
    public function getNombreUsuario()
    {
        return $this->_nombre_usuario;
    }

    public function setNombreUsuario($nombre_usuario)
    {
        $this->_nombre_usuario=$nombre_usuario;
    }
    
    public function getContrasena()
    {
        return $this->_contrasena;
    }

    public function setContrasena($contrasena)
    {
        $this->_contrasena=$contrasena;
    }

    public function getRol()
    {
        return $this->_rol;
    }

    public function setRol($rol)
    {
        $this->_rol=$rol;
    }
}

?>
