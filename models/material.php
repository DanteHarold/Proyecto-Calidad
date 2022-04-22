<?php
    class Material{

        private $id;
        private $descripcion;
        private $fecha;
        private $precio;
        private $stock;


        public function getId():int {
            return $this->id;
        }  
        public function setId(int $id) {
            $this->id = $id;
        }
    

        public function getDescripcion():string {
            return $this->descripcion;
        }
        public function setDescripcion(string $descripcion) {
            $this->descripcion = $descripcion;
        }


        public function getFecha():string {
            return $this->fecha;
        }
        public function setFecha(string $fecha) {
            $this->fecha = $fecha;
        }


        public function getPrecio():float {
            return $this->precio;
        }
        public function setPrecio(float $precio) {
            $this->precio = $precio;
        }


        public function getStock():int {
            return $this->stock;
        } 
        public function setStock(string $stock) {
            $this->stock = $stock;
        }


  
    }

?>