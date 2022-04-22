<?php
    require_once 'models/local.php';
    require_once 'models/database.php';
    require_once 'libs/IConexion.php';
    require_once 'libs/ConexionFabrica.php';
    class LocalesModel implements IConexion{
        
        public function __construct(){
            $this->fabrica = new ConexionFabrica();               
        }
        public function insert($datos){
        }    
        public function get(){
            $items  = [];
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "SELECT id_local,direccion_local,nombre_local from locales;";                           
                $query = $db->connect()->query($sql);
                while($row = $query->fetch()){
                    $local = $this->fabrica->getConexion("Local");
                    $local->setId($row['id_local']);
                    $local->setDireccion($row['direccion_local']);
                    $local->setNombre($row['nombre_local']);
                    array_push($items,$local);
                }
                
                return $items;
            }catch(PDOException $e){
                return [];
            }
        
        }    
        public function getById($id){
            $local =  $this->fabrica->getConexion("Local");
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "SELECT id_local,direccion_local,nombre_local from locales where id_local=:id;";
                $query = $db->connect()->prepare($sql);

                $query->execute(['id'=>$id]);

                while($row = $query->fetch()){
                    $local->setId($id);
                    $local->setDireccion($row['direccion_local']);
                    $local->setNombre($row['nombre_local']);
                }
                return $local;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function update($item){           
        }     
        public function delete($id){
        }       
    }
    
    

?>