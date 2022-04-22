<?php
    class DetalleCompra{

        private $id;
        private $cantidad;
        private $total;
        private $idMaterial;
        private $idCompra;


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

        public function getIdMaterial():int {
            return $this->idMaterial;
        }
        public function setIdMaterial(int $idMaterial) {
            $this->idMaterial = $idMaterial;
        }

        public function getIdCompra():int {
            return $this->idCompra;
        }
        public function setIdCompra(int $idCompra) {
            $this->idCompra = $idCompra;
        }
       
    }

?>