<?php
    require_once("productoDecorador.php");
    require_once("models/producto.php");
    class DescuentoDecorador extends ProductoDecorador{
        public function __construct($productoDecorado){
            parent::__construct($productoDecorado);        
        }
        public function AgregarDescuento($c){
            $c->setNombre($c->getNombre().'-Extra');
        }
    }

?>