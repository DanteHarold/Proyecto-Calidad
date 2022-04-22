<?php
    class Usuario{

        private $id;
        private $nombre;
        private $apellido;
        private $email;
        private $username;
        private $password;

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
    
        public function getEmail():string {
            return $this->email;
        }
    
        public function setEmail(string $email) {
            $this->email = $email;
        }
        public function getUsername():string {
            return $this->username;
        }
    
        public function setUsername(string $username) {
            $this->username = $username;
        }
        public function getPassword():string {
            return $this->password;
        }
    
        public function setPassword(string $password) {
            $this->password = $password;
        }

    }

?>