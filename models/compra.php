<?php
    class Compra{

        private $id;
        private $fecha;
        private $idEmpleado;
        private $idProveedor;


        public function getId():int {
            return $this->id;
        }  
        public function setId(int $id) {
            $this->id = $id;
        }
    
        public function getFecha():string {
            return $this->fecha;
        }
        public function setFecha(string $fecha) {
            $this->fecha = $fecha;
        }

        public function getIdEmpleado():int {
            return $this->idEmpleado;
        }
        public function setIdEmpleado(int $idEmpleado) {
            $this->idEmpleado = $idEmpleado;
        }

        public function getIdProveedor():int {
            return $this->idProveedor;
        }
        public function setIdProveedor(int $idProveedor) {
            $this->idProveedor = $idProveedor;
        }
       
    }

?>