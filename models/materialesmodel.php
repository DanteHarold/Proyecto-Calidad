<?php
    require_once 'models/material.php';
    require_once 'models/database.php';
    require_once 'libs/IConexion.php';
    require_once 'libs/ConexionFabrica.php';
    class materialesModel implements IConexion{
        
        public function __construct(){
            $this->fabrica = new ConexionFabrica();               
        }
        public function insert($datos){

            $material = $this->fabrica->getConexion("Material");
            $material->setDescripcion($datos['name']);
            $material->setFecha($datos['fecha']);
            $material->setPrecio($datos['precio']);
            $material->setStock($datos['stock']);

            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = 'INSERT INTO materiales (descripcion_material,fecha_material,precio_material,stock_material) values(:name,:fecha,:precio,:stock);';
                $query = $db->connect()->prepare($sql);
                $query->execute(
                    ['name' => $material->getDescripcion(),
                    'fecha' => $material->getFecha(),
                    'precio' => $material->getPrecio(),
                    'stock' => $material->getStock(),
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
                $sql = "SELECT id_material,descripcion_material,fecha_material,precio_material,stock_material from materiales;";                           
                 $query = $db->connect()->query($sql);
                while($row = $query->fetch()){
                    $material = $this->fabrica->getConexion("Material");
                    $material->setId($row['id_material']);
                    $material->setDescripcion($row['descripcion_material']);
                    $material->setFecha($row['fecha_material']);
                    $material->setPrecio($row['precio_material']);
                    $material->setStock($row['stock_material']);
                    array_push($items,$material);
                }              
                return $items;
            }catch(PDOException $e){
                return [];
            }
        
        }    
        public function getById($id){
            $material =  $this->fabrica->getConexion("Material");
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "SELECT id_material,descripcion_material,fecha_material,precio_material,stock_material from materiales where id_material=:id;";
                $query = $db->connect()->prepare($sql);

                $query->execute(['id'=>$id]);

                while($row = $query->fetch()){
                    $material->setId($row['id_material']);
                    $material->setDescripcion($row['descripcion_material']);
                    $material->setFecha($row['fecha_material']);
                    $material->setPrecio($row['precio_material']);
                    $material->setStock($row['stock_material']);
                }
                return $material;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function update($item){
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "UPDATE materiales SET descripcion_material=:name,fecha_material=:fecha,precio_material=:precio,stock_material=:stock where id_material=:id;";
                $query = $db->connect()->prepare($sql);
                $query->execute([
                    'id' => $item['id'],
                    'name' => $item['name'],
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
                $sql = "DELETE FROM materiales where id_material=:id;";
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