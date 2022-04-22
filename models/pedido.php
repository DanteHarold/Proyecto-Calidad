<?php
    class Pedido{

        private $id;
        private $fecha;
        private $idCliente;
        private $idEmpleado;
        private $idLocal;


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

        public function getIdCliente():int {
            return $this->idCliente;
        }
        public function setIdCliente(int $idCliente) {
            $this->idCliente = $idCliente;
        }

        public function getIdEmpleado():int {
            return $this->idEmpleado;
        }
        public function setIdEmpleado(int $idEmpleado) {
            $this->idEmpleado = $idEmpleado;
        }

        public function getIdLocal():int {
            return $this->idLocal;
        }
        public function setIdLocal(int $idLocal) {
            $this->idLocal = $idLocal;
        }
       
    }

?>