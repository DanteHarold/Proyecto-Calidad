<?php
    require_once 'models/detallepedido.php';
    require_once 'models/database.php';
    require_once 'libs/IConexion.php';
    require_once 'libs/ConexionFabrica.php';
    class detallePedidosModel implements IConexion{
        
        public function __construct(){
            $this->fabrica = new ConexionFabrica();               
        }
        public function insert($datos){
            $detallePedido = $this->fabrica->getConexion("DetallePedido");
            $detallePedido->setCantidad($datos['cantidad']);
            $detallePedido->setTotal( $datos['total']);
            $detallePedido->setIdProducto($datos['idProducto']);
            $detallePedido->setIdPedido($datos['idPedido']);

            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = 'INSERT INTO detalle_pedido (cantidad_detalle_pedido,total_detalle_pedido,id_producto,id_pedido) values (:cantidad,:total,:idProducto,:idPedido);';
                $query = $db->connect()->prepare($sql);
                $query->execute(
                    ['cantidad' => $detallePedido->getCantidad(),
                    'total' => $detallePedido->getTotal(),
                    'idProducto' => $detallePedido->getIdProducto(),
                    'idPedido' => $detallePedido->getIdPedido()
                ]);
                return true;
            }catch(PDOException $e){
                echo $e->getMessage();            
                return false;
            }
            
        }       
        public function get(){       
            $items  = [];
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "SELECT id_detalle_pedido,cantidad_detalle_pedido,total_detalle_pedido,id_producto,id_pedido from detalle_pedido;";                           
                $query = $db->connect()->query($sql);
                while($row = $query->fetch()){
                    $detallePedido = $this->fabrica->getConexion("DetallePedido");
                    $detallePedido->setId($row['id_detalle_pedido']);
                    $detallePedido->setCantidad($row['cantidad_detalle_pedido']);
                    $detallePedido->setTotal($row['total_detalle_pedido']);
                    $detallePedido->setIdProducto($row['id_producto']);
                    $detallePedido->setIdPedido($row['id_pedido']);
                    array_push($items,$detallePedido);
                }              
                return $items;
            }catch(PDOException $e){
                return [];
            }
        
        }    
        public function getById($id){
            $detallePedido =  $this->fabrica->getConexion("DetallePedido");
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "SELECT id_detalle_pedido,cantidad_detalle_pedido,total_detalle_pedido,id_producto,id_pedido from detalle_pedido where id_detalle_pedido =:id;";
                $query = $db->connect()->prepare($sql);

                $query->execute(['id'=>$id]);

                while($row = $query->fetch()){
                    $detallePedido->setId($id);
                    $detallePedido->setCantidad($row['cantidad_detalle_pedido']);
                    $detallePedido->setTotal($row['total_detalle_pedido']);
                    $detallePedido->setIdProducto($row['id_producto']);
                    $detallePedido->setIdPedido($row['id_pedido']);
                }
                return $detallePedido;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function update($item){           
        }     
        public function delete($id){
        }       
        public function getByIdPedido($id){
            $detallePedido =  $this->fabrica->getConexion("DetallePedido");
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "SELECT id_detalle_pedido,cantidad_detalle_pedido,total_detalle_pedido,id_producto,id_pedido from detalle_pedido where id_pedido =:id;";
                $query = $db->connect()->prepare($sql);

                $query->execute(['id'=>$id]);

                while($row = $query->fetch()){
                    $detallePedido->setId($row['id_detalle_pedido']);
                    $detallePedido->setCantidad($row['cantidad_detalle_pedido']);
                    $detallePedido->setTotal($row['total_detalle_pedido']);
                    $detallePedido->setIdProducto($row['id_producto']);
                    $detallePedido->setIdPedido($row['id_pedido']);
                }
                return $detallePedido;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    }
    
    

?>