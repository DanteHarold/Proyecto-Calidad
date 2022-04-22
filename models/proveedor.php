<?php
    class Proveedor{

        private $id;
        private $nombre;
        private $direccion;
        private $fecha;
        private $email;
        private $telefono;


        public function getId():int {
            return $this->id;
        }  
        public function setId(int $id) {
            $this->id = $id;
        }  


        public function getNombre():string {
            return $this->nombre;
        }
        public function setNombre(string $nombre) {
            $this->nombre = $nombre;
        }


        public function getDireccion():string {
            return $this->direccion;
        }
        public function setDireccion(string $direccion) {
            $this->direccion = $direccion;
        }


        public function getFecha():string {
            return $this->fecha;
        }
        public function setFecha(string $fecha) {
            $this->fecha = $fecha;
        }


        public function getEmail():string {
            return $this->email;
        } 
        public function setEmail(string $email) {
            $this->email = $email;
        }


        public function getTelefono():int {
            return $this->telefono;
        }
        public function setTelefono(int $telefono) {
            $this->telefono = $telefono;
        }

       
    }

?>