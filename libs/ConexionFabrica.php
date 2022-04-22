<?php
    require_once("IConexion.php");
    require_once("models/database.php");
    require_once("models/producto.php");
    require_once("models/empleado.php");
    require_once("models/cliente.php");
    require_once("models/usuario.php");
    require_once("models/local.php");
    require_once("models/pedido.php");
    class ConexionFabrica{
        public function getConexion($obj){
            if($obj == null){
                return new ConexionVacia();
            }
            if(strcmp($obj,"Conexion") === 0){
                return new Database();
            }
            if(strcmp($obj,"Producto") === 0){
                return new Producto();
            }
            if(strcmp($obj,"Usuario") === 0){
                return new Usuario();
            }
            if(strcmp($obj,"Empleado") === 0){
                return new Empleado();
            }
            if(strcmp($obj,"Cliente") === 0){
                return new Cliente();
            }
            if(strcmp($obj,"Proveedor") === 0){
                return new Proveedor();
            }
            if(strcmp($obj,"Material") === 0){
                return new Material();
            }
            if(strcmp($obj,"Local") === 0){
                return new Local();
            }
            if(strcmp($obj,"Pedido") === 0){
                return new Pedido();
            }
            if(strcmp($obj,"DetallePedido") === 0){
                return new DetallePedido();
            }
            if(strcmp($obj,"Compra") === 0){
                return new Compra();
            }
            if(strcmp($obj,"DetalleCompra") === 0){
                return new DetalleCompra();
            }
            return new ConexionVacia();
        }
    }

?>