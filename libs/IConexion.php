<?php
    interface IConexion{
        public function insert($datos);
        public function get();
        public function getById($id);
        public function update($item);
        public function delete($id);
    }
?>