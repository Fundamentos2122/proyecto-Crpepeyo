<?php

class Producto_comprado
{   
    private $_id;
    private $_id_producto;
    private $_id_usuario;
    private $_fecha;
    private $_cantidad;
    private $_pagado;


    public function __construct($id,$id_producto,$id_usuario,$fecha,$cantidad,$pagado)
    {
        $this->setId($id);
        $this->setIdProducto($id_producto);
        $this->setIdUsuario($id_usuario);
        $this->setFecha($fecha);
        $this->setCantidad($cantidad);
        $this->setPagado($pagado);
    }
    
    public function getId()
    {
        return $this->_id;
    }

    public function setId($id)
    {
        $this->_id=$id;
    }

    public function getIdProducto()
    {
        return $this->_id_producto;
    }

    public function setIdProducto($id_producto)
    {
        $this->_id_producto=$id_producto;
    }

    public function getIdUsuario()
    {
        return $this->_id_usuario;
    }

    public function setIdUsuario($id_usuario)
    {
        $this->_id_usuario=$id_usuario;
    }

    public function getFecha()
    {
        return $this->_fecha;
    }

    public function setFecha($fecha)
    {
        $this->_fecha=$fecha;
    }

    public function getCantidad()
    {
        return $this->_cantidad;
    }

    public function setCantidad($cantidad)
    {
        $this->_cantidad=$cantidad;
    }

    public function getPagado()
    {
        return $this->_pagado;
    }

    public function setPagado($pagado)
    {
        $this->_pagado=$pagado;
    }
}

?>
