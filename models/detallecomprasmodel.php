<?php
    require_once 'models/detalleCompra.php';
    require_once 'models/database.php';
    require_once 'libs/IConexion.php';
    require_once 'libs/ConexionFabrica.php';
    class detalleComprasModel implements IConexion{
        
        public function __construct(){
            $this->fabrica = new ConexionFabrica();               
        }
        public function insert($datos){
            $detalleCompra = $this->fabrica->getConexion("DetalleCompra");
            $detalleCompra->setCantidad($datos['cantidad']);
            $detalleCompra->setTotal( $datos['total']);
            $detalleCompra->setIdMaterial($datos['idMaterial']);
            $detalleCompra->setIdCompra($datos['idCompra']);

            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = 'INSERT INTO detalle_compra (cantidad_material,total_compra,id_material,id_compra) values (:cantidad,:total,:idMaterial,:idCompra);';
                $query = $db->connect()->prepare($sql);
                $query->execute(
                    ['cantidad' => $detalleCompra->getCantidad(),
                    'total' => $detalleCompra->getTotal(),
                    'idMaterial' => $detalleCompra->getIdMaterial(),
                    'idCompra' => $detalleCompra->getIdCompra()
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
                $sql = "SELECT id_detalle_compra,cantidad_material,total_compra,id_material,id_compra from detalle_compra;";                           
                $query = $db->connect()->query($sql);
                while($row = $query->fetch()){
                    $detalleCompra = $this->fabrica->getConexion("DetalleCompra");
                    $detalleCompra->setId($row['id_detalle_compra']);
                    $detalleCompra->setCantidad($row['cantidad_material']);
                    $detalleCompra->setTotal($row['total_compra']);
                    $detalleCompra->setIdMaterial($row['id_material']);
                    $detalleCompra->setIdCompra($row['id_compra']);
                    array_push($items,$detalleCompra);
                }              
                return $items;
            }catch(PDOException $e){
                return [];
            }
        
        }    
        public function getById($id){
            $detalleCompra =  $this->fabrica->getConexion("DetalleCompra");
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "SELECT id_detalle_compra,cantidad_material,total_compra,id_material,id_compra from detalle_compra where id_detalle_compra =:id;";
                $query = $db->connect()->prepare($sql);

                $query->execute(['id'=>$id]);

                while($row = $query->fetch()){
                    $detalleCompra->setId($id);
                    $detalleCompra->setCantidad($row['cantidad_material']);
                    $detalleCompra->setTotal($row['total_compra']);
                    $detalleCompra->setIdMaterial($row['id_material']);
                    $detalleCompra->setIdCompra($row['id_compra']);
                }
                return $detalleCompra;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function update($item){           
        }     
        public function delete($id){
        }       
        public function getByIdCompra($id){
            $detalleCompra =  $this->fabrica->getConexion("DetalleCompra");
            
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "SELECT id_detalle_compra,cantidad_material,total_compra,id_material,id_compra from detalle_compra where id_compra =:id;";
                $query = $db->connect()->prepare($sql);

                $query->execute(['id'=>$id]);

                while($row = $query->fetch()){
                    $detalleCompra->setId($row['id_detalle_compra']);
                    $detalleCompra->setCantidad($row['cantidad_material']);
                    $detalleCompra->setTotal($row['total_compra']);
                    $detalleCompra->setIdMaterial($row['id_material']);
                    $detalleCompra->setIdCompra($row['id_compra']);
                }
                return $detalleCompra;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    }
    
    

?>