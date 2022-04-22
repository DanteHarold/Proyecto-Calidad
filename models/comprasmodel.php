<?php
    require_once 'models/compra.php';
    require_once 'models/database.php';
    require_once 'libs/IConexion.php';
    require_once 'libs/ConexionFabrica.php';
    class ComprasModel implements IConexion{
        
        public function __construct(){
            $this->fabrica = new ConexionFabrica();               
        }
        public function insert($datos){
            $compra = $this->fabrica->getConexion("Compra");
            $compra->setFecha($datos['fecha']);
            $compra->setIdEmpleado($datos['idEmpleado']);
            $compra->setIdProveedor($datos['idProveedor']);

            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = 'INSERT INTO compras (fecha_compra,id_empleado,id_proveedor) values (:fecha,:idEmpleado,:idProveedor);';
                $query = $db->connect()->prepare($sql);
                $query->execute(
                    ['fecha' => $compra->getFecha(),
                    'idEmpleado' => $compra->getIdEmpleado(),
                    'idProveedor' => $compra->getIdProveedor()
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
                $sql = "SELECT id_compra,fecha_compra,id_empleado,id_proveedor from compras;";                           
                $query = $db->connect()->query($sql);
                while($row = $query->fetch()){
                    $compra = $this->fabrica->getConexion("Compra");
                    $compra->setId($row['id_compra']);
                    $compra->setFecha($row['fecha_compra']);
                    $compra->setIdEmpleado($row['id_empleado']);
                    $compra->setIdProveedor($row['id_proveedor']);
                    array_push($items,$compra);
                }             
                return $items;
            }catch(PDOException $e){
                return [];
            }
        
        }    
        public function getById($id){
            $compra =  $this->fabrica->getConexion("Compra");
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "SELECT id_compra,fecha_compra,id_empleado,id_proveedor from compras where id_compra=:id;";
                $query = $db->connect()->prepare($sql);

                $query->execute(['id'=>$id]);

                while($row = $query->fetch()){
                    $compra->setId($id);
                    $compra->setFecha($row['fecha_compra']);
                    $compra->setIdEmpleado($row['id_empleado']);
                    $compra->setIdProveedor($row['id_proveedor']);
                }
                return $compra;
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
                $sql = "SELECT id_compra,fecha_compra,id_empleado,id_proveedor from compras WHERE id_compra = (SELECT MAX(id_compra) FROM compras);";                           
                $query = $db->connect()->query($sql);
                while($row = $query->fetch()){
                    $compra = $this->fabrica->getConexion("Compra");
                    $compra->setId($row['id_compra']);
                    $compra->setFecha($row['fecha_compra']);
                    $compra->setIdEmpleado($row['id_empleado']);
                    $compra->setIdProveedor($row['id_proveedor']);
                }        
                return $compra;
            }catch(PDOException $e){
                return [];
            }
        }        
    }
    
    

?>