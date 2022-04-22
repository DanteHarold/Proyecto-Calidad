<?php
    require_once("libs/IConexion.php");
    require_once("models/producto.php");
    abstract class ProductoDecorador implements IConexion{
        protected  $productoDecorado;

        public function __construct($productoDecorado){
            $this->productoDecorado = $productoDecorado;
        }
        public function insert($datos){
            $this->productoDecorado->insert($datos);
        }
        public function get(){
            $this->productoDecorado->get();
        }
        public function getById($id){
            $this->productoDecorado->getById($id);
        }
        public function update($item){
            $this->productoDecorado->update($item);
        }
        public function delete($id){
            $this->productoDecorado->delete($id);
        }
    }

?>