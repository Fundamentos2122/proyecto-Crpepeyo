<?php

class Producto
{   
    private $_id;
    private $_tipo;
    private $_descripcion;
    private $_precio;
    private $_color;
    private $_talla;
    private $_foto_tipo;
    private $_foto_diseno;

    public function __construct($id,$tipo,$descripcion,$precio,$color,$talla,$foto_tipo,$foto_diseno)
    {
        $this->setId($id);
        $this->setTipo($tipo);
        $this->setDescripcion($descripcion);
        $this->setPrecio($precio);
        $this->setColor($color);
        $this->setTalla($talla);
        $this->setFotoTipo($foto_tipo);
        $this->setFotoDiseno($foto_diseno);
    }
    
    public function getId()
    {
        return $this->_id;
    }

    public function setId($id)
    {
        $this->_id=$id;
    }

    public function getTipo()
    {
        return $this->_tipo;
    }

    public function setTipo($tipo)
    {
        $this->_tipo=$tipo;
    }

    public function getDescripcion()
    {
        return $this->_descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->_descripcion=$descripcion;
    }

    public function getPrecio()
    {
        return $this->_precio;
    }

    public function setPrecio($precio)
    {
        $this->_precio=$precio;
    }

    public function getColor()
    {
        return $this->_color;
    }

    public function setColor($color)
    {
        $this->_color=$color;
    }

    public function getTalla()
    {
        return $this->_talla;
    }

    public function setTalla($talla)
    {
        $this->_talla=$talla;
    }

    public function getFotoTipo()
    {
        return $this->_foto_tipo;
    }

    public function setFotoTipo($foto_tipo)
    {
        $this->_foto_tipo=base64_encode($foto_tipo);
    }

    public function getFotoDiseno()
    {
        return $this->_foto_diseno;
    }

    public function setFotoDiseno($foto_diseno)
    {
        $this->_foto_diseno=base64_encode($foto_diseno);
    }
    
    public function returnJson()
    {
            $producto =array();
            
            $producto["id"]=$this->getId();
            $producto["tipo"]=$this->getTipo();
            $producto["descripcion"]=$this->getDescripcion();
            $producto["precio"]=$this->getPrecio();
            $producto["color"]=$this->getColor();
            $producto["talla"]=$this->getTalla();
            $producto["foto_tipo"]=$this->getFotoTipo();
            $producto["foto_diseno"]=$this->getFotoDiseno();

            echo json_encode($producto);
    }

}

?>
