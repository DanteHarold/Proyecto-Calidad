<?php
    require_once 'models/proveedor.php';
    require_once 'models/database.php';
    require_once 'libs/IConexion.php';
    require_once 'libs/ConexionFabrica.php';
    class proveedoresModel implements IConexion{
        
        public function __construct(){
            $this->fabrica = new ConexionFabrica();               
        }
        public function insert($datos){

            $proveedor = $this->fabrica->getConexion("Proveedor");
            $proveedor->setNombre($datos['name']);
            $proveedor->setDireccion($datos['direccion']);
            $proveedor->setFecha($datos['fecha']);
            $proveedor->setEmail($datos['email']);
            $proveedor->setTelefono($datos['telefono']);

            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = 'INSERT INTO proveedores (nombre_proveedor,direccion_proveedor,fecha_proveedor,email_proveedor,telefono_proveedor) values(:name,:direccion,:fecha,:email,:telefono);';
                $query = $db->connect()->prepare($sql);
                $query->execute(
                    ['name' => $proveedor->getNombre(),
                    'direccion' => $proveedor->getDireccion(),
                    'fecha' => $proveedor->getFecha(),
                    'email' => $proveedor->getEmail(),
                    'telefono' => $proveedor->getTelefono(),
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
                $sql = "SELECT id_proveedor,nombre_proveedor,direccion_proveedor,fecha_proveedor,email_proveedor,telefono_proveedor from proveedores;";                           
                 $query = $db->connect()->query($sql);
                while($row = $query->fetch()){
                    $proveedor = $this->fabrica->getConexion("Proveedor");
                    $proveedor->setId($row['id_proveedor']);
                    $proveedor->setNombre($row['nombre_proveedor']);
                    $proveedor->setDireccion($row['direccion_proveedor']);
                    $proveedor->setFecha($row['fecha_proveedor']);
                    $proveedor->setEmail($row['email_proveedor']);
                    $proveedor->setTelefono($row['telefono_proveedor']);
                    array_push($items,$proveedor);
                }              
                return $items;
            }catch(PDOException $e){
                return [];
            }
        
        }    
        public function getById($id){
            $proveedor =  $this->fabrica->getConexion("Proveedor");
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "SELECT id_proveedor,nombre_proveedor,direccion_proveedor,fecha_proveedor,email_proveedor,telefono_proveedor from proveedores where id_proveedor=:id;";
                $query = $db->connect()->prepare($sql);

                $query->execute(['id'=>$id]);

                while($row = $query->fetch()){
                    $proveedor->setId($row['id_proveedor']);
                    $proveedor->setNombre($row['nombre_proveedor']);
                    $proveedor->setDireccion($row['direccion_proveedor']);
                    $proveedor->setFecha($row['fecha_proveedor']);
                    $proveedor->setEmail($row['email_proveedor']);
                    $proveedor->setTelefono($row['telefono_proveedor']);
                }
                return $proveedor;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function update($item){
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "UPDATE proveedores SET nombre_proveedor=:name,direccion_proveedor=:direccion,fecha_proveedor=:fecha,email_proveedor=:email,telefono_proveedor=:telefono where id_proveedor=:id;";
                $query = $db->connect()->prepare($sql);
                $query->execute([
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'direccion' => $item['direccion'],
                    'fecha' => $item['fecha'],
                    'email' => $item['email'],
                    'telefono' => $item['telefono'],
                ]);
                return true;
            }catch(PDOException $e){
                return false;
            }
            
        }     
        public function delete($id){
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "DELETE FROM proveedores where id_proveedor=:id;";
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