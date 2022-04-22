<?php
    class Empleado{

        private $id;
        private $nombre;
        private $apellido;
        private $dni;
        private $fecha;
        private $fecha_nacimiento;
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


        public function getFechaNacimiento():string {
            return $this->fecha_nacimiento;
        }
        public function setFechaNacimiento(string $fecha_nacimiento) {
            $this->fecha_nacimiento = $fecha_nacimiento;
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