<?php
    class Cliente{

        private $id;
        private $nombre;
        private $apellido;
        private $dni;
        private $fecha;
        private $provincia;
        private $ciudad;
        private $direccion;
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


        public function getApellido():string {
            return $this->apellido;
        }
        public function setApellido(string $apellido) {
            $this->apellido = $apellido;
        }


        public function getDni():int {
            return $this->dni;
        }
        public function setDni(int $dni) {
            $this->dni = $dni;
        }


        public function getFecha():string {
            return $this->fecha;
        } 
        public function setFecha(string $fecha) {
            $this->fecha = $fecha;
        }


        public function getProvincia():string {
            return $this->provincia;
        }
        public function setProvincia(string $provincia) {
            $this->provincia = $provincia;
        }


        public function getCiudad():string {
            return $this->ciudad;
        }
        public function setCiudad(string $ciudad) {
            $this->ciudad = $ciudad;
        }


        public function getDireccion():string {
            return $this->direccion;
        }
        public function setDireccion(string $direccion) {
            $this->direccion = $direccion;
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