<?php
    class DetallePedido{

        private $id;
        private $cantidad;
        private $total;
        private $idProducto;
        private $idPedido;


        public function getId():int {
            return $this->id;
        }  
        public function setId(int $id) {
            $this->id = $id;
        }
    
        public function getCantidad():int {
            return $this->cantidad;
        }
        public function setCantidad(int $cantidad) {
            $this->cantidad = $cantidad;
        }

        public function getTotal():float {
            return $this->total;
        }
        public function setTotal(float $total) {
            $this->total = $total;
        }

        public function getIdProducto():int {
            return $this->idProducto;
        }
        public function setIdProducto(int $idProducto) {
            $this->idProducto = $idProducto;
        }

        public function getIdPedido():int {
            return $this->idPedido;
        }
        public function setIdPedido(int $idPedido) {
            $this->idPedido = $idPedido;
        }
       
    }

?>