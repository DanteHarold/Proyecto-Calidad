<?php
    require_once 'models/pedido.php';
    require_once 'models/database.php';
    require_once 'libs/IConexion.php';
    require_once 'libs/ConexionFabrica.php';
    class PedidosModel implements IConexion{
        
        public function __construct(){
            $this->fabrica = new ConexionFabrica();               
        }
        public function insert($datos){
            $pedido = $this->fabrica->getConexion("Pedido");
            $pedido->setFecha($datos['fecha']);
            $pedido->setIdCliente( $datos['idCliente']);
            $pedido->setIdEmpleado($datos['idEmpleado']);
            $pedido->setIdLocal($datos['idLocal']);

            

            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = 'INSERT INTO pedidos (fecha_pedido,id_cliente,id_empleado,id_local) values (:fecha,:idCliente,:idEmpleado,:idLocal);';
                $query = $db->connect()->prepare($sql);
                $query->execute(
                    ['fecha' => $pedido->getFecha(),
                    'idCliente' => $pedido->getIdCliente(),
                    'idEmpleado' => $pedido->getIdEmpleado(),
                    'idLocal' => $pedido->getIdLocal()
                ]);
                return true;
            }catch(PDOException $e){
                echo $pedido->getFecha();
                echo '<br>';
            echo $pedido->getIdCliente();
            echo '<br>';
            echo $pedido->getIdEmpleado();
            echo '<br>';
            echo $pedido->getIdLocal();
            echo '<br>';
            
                echo $e->getMessage();
                
                return false;
            }
            
        }       
        public function get(){       
            $items  = [];
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "SELECT id_pedido,fecha_pedido,id_cliente,id_empleado,id_local from pedidos;";                           
                $query = $db->connect()->query($sql);
                while($row = $query->fetch()){
                    $pedido = $this->fabrica->getConexion("Pedido");
                    $pedido->setId($row['id_pedido']);
                    $pedido->setFecha($row['fecha_pedido']);
                    $pedido->setIdCliente($row['id_cliente']);
                    $pedido->setIdEmpleado($row['id_empleado']);
                    $pedido->setIdLocal($row['id_local']);
                    array_push($items,$pedido);
                }
                
                return $items;
            }catch(PDOException $e){
                return [];
            }
        
        }    
        public function getById($id){
            $pedido =  $this->fabrica->getConexion("Pedido");
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "SELECT id_pedido,fecha_pedido,id_cliente,id_empleado,id_local from pedidos where id_pedido=:id;";
                $query = $db->connect()->prepare($sql);

                $query->execute(['id'=>$id]);

                while($row = $query->fetch()){
                    $pedido->setId($id);
                    $pedido->setFecha($row['fecha_pedido']);
                    $pedido->setIdCliente($row['id_cliente']);
                    $pedido->setIdEmpleado($row['id_empleado']);
                    $pedido->setIdLocal($row['id_local']);
                }
                return $pedido;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function update($item){           
        }     
        public function delete($id){
        }
        public function getLast(){
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "SELECT id_pedido,fecha_pedido,id_cliente,id_empleado,id_local  from pedidos WHERE id_pedido = (SELECT MAX(id_pedido) FROM pedidos);";                           
                $query = $db->connect()->query($sql);
                while($row = $query->fetch()){
                    $pedido = $this->fabrica->getConexion("Pedido");
                    $pedido->setId($row['id_pedido']);
                    $pedido->setFecha($row['fecha_pedido']);
                    $pedido->setIdCliente($row['id_cliente']);
                    $pedido->setIdEmpleado($row['id_empleado']);
                    $pedido->setIdLocal($row['id_local']);
                }
                
                return $pedido;
            }catch(PDOException $e){
                return [];
            }
        }        
    }
    
    

?>