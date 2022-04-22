<?php
    class Producto{

        private $id;
        private $descripcion;
        private $categoria;
        private $fecha;
        private $precio;
        private $stock;
        
        public function __construct(){
           
        }    
        /*
        public function __construct(int $id,string $nombre,string $apellido,string $email){
            $this->id = $id;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->email = $email;
        }
        */
        
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
        public function getCategoria():string {
            return $this->categoria;
        }
    
        public function setCategoria(string $categoria) {
            $this->categoria = $categoria;
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
    
        public function setStock(int $stock) {
            $this->stock = $stock;
        }

    }

?>