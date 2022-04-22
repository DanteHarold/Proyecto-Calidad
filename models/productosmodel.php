<?php
    //include_once 'models/producto.php';
    require_once 'models/producto.php';
    require_once 'models/database.php';
    require_once 'libs/IConexion.php';
    require_once 'libs/ConexionFabrica.php';
    require_once 'libs/descuentoDecorador.php';
    class ProductosModel implements IConexion{
        /*
        public function __construct(){
            parent::__construct();
        }
        */
        public function __construct(){
            $this->fabrica = new ConexionFabrica();               
        }
        public function insert($datos){

            $producto = $this->fabrica->getConexion("Producto");
            $producto->setDescripcion($datos['descripcion']);
            $producto->setCategoria($datos['categoria']);
            $producto->setFecha($datos['fecha']);
            $producto->setPrecio($datos['precio']);
            $producto->setStock($datos['stock']);

            /*
            $productoDesc = new DescuentoDecorador($producto);
            $productoDesc->AgregarDescuento($producto);
            */

            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = 'INSERT INTO productos (descripcion_producto,categoria_producto,fecha_producto,precio_producto,stock_producto) values (:desc,:cat,:fecha,:precio,:stock);';
                $query = $db->connect()->prepare($sql);
                $query->execute(
                    ['desc' => $producto->getDescripcion(),
                    'cat' => $producto->getCategoria(),
                    'fecha' => $producto->getFecha(),
                    'precio' => $producto->getPrecio(),
                    'stock' => $producto->getStock()
                ]);
                return true;
            }catch(PDOException $e){
               // echo $e->getMessage();
                return false;
            }
            
        }    
        public function get(){
            $items  = [];
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "SELECT id_producto,descripcion_producto,categoria_producto,fecha_producto,precio_producto,stock_producto from productos; ";            
                $query = $db->connect()->query($sql);
                while($row = $query->fetch()){
                    $producto = $this->fabrica->getConexion("Producto");
                    $producto->setId($row['id_producto']);
                    $producto->setDescripcion($row['descripcion_producto']);
                    $producto->setCategoria($row['categoria_producto']);
                    $producto->setFecha($row['fecha_producto']);
                    $producto->setPrecio($row['precio_producto']);
                    $producto->setStock($row['stock_producto']);
                    array_push($items,$producto);
                }
                return $items;
            }catch(PDOException $e){
                return [];
            }
        
        }    
        public function getById($id){
            $producto =  $this->fabrica->getConexion("Producto");
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "SELECT id_producto,descripcion_producto,categoria_producto,fecha_producto,precio_producto,stock_producto FROM productos where id_producto=:id;";
                $query = $db->connect()->prepare($sql);

                $query->execute(['id'=>$id]);

                while($row = $query->fetch()){
                    $producto->setId($row['id_producto']);
                    $producto->setDescripcion($row['descripcion_producto']);
                    $producto->setCategoria($row['categoria_producto']);
                    $producto->setFecha($row['fecha_producto']);
                    $producto->setPrecio($row['precio_producto']);
                    $producto->setStock($row['stock_producto']);
                }
                return $producto;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function update($item){
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "UPDATE productos SET descripcion_producto=:desc,categoria_producto=:cat,fecha_producto=:fecha,precio_producto=:precio,stock_producto=:stock where id_producto=:id;";
                $query = $db->connect()->prepare($sql);
                $query->execute([
                    'id' => $item['id'],
                    'desc' => $item['descripcion'],
                    'cat' => $item['categoria'],
                    'fecha' => $item['fecha'],
                    'precio' => $item['precio'],
                    'stock' => $item['stock'],
                ]);
                return true;
            }catch(PDOException $e){
                return false;
            }
            
        }     
        public function delete($id){
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "DELETE FROM productos where id_producto=:id;";
                $query = $db->connect()->prepare($sql);
                $query->execute([
                    'id' => $id
                ]);
                return true;
            }catch(PDOException $e){
                return false;
            }
        }
            
    }
    
    

?>