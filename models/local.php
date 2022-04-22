<?php
    class Local{

        private $id;
        private $direccion;
        private $nombre;


        public function getId():int {
            return $this->id;
        }  
        public function setId(int $id) {
            $this->id = $id;
        }
    

        public function getDireccion():string {
            return $this->direccion;
        }
        public function setDireccion(string $direccion) {
            $this->direccion = $direccion;
        }


        public function getNombre():string {
            return $this->nombre;
        }
        public function setNombre(string $nombre) {
            $this->nombre = $nombre;
        }
       
    }

?>