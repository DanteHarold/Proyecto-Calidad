<?php
    require_once 'models/cliente.php';
    require_once 'models/database.php';
    require_once 'libs/IConexion.php';
    require_once 'libs/ConexionFabrica.php';
    class clientesModel implements IConexion{
        
        public function __construct(){
            $this->fabrica = new ConexionFabrica();               
        }
        public function insert($datos){

            $cliente = $this->fabrica->getConexion("Cliente");
            $cliente->setNombre($datos['name']);
            $cliente->setApellido($datos['surname']);
            $cliente->setDni($datos['dni']);
            $cliente->setFecha($datos['fecha']);
            $cliente->setCiudad($datos['ciudad']);
            $cliente->setProvincia($datos['provincia']);
            $cliente->setDireccion($datos['direccion']);
            $cliente->setEmail($datos['email']);
            $cliente->setTelefono($datos['telefono']);


            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = 'INSERT INTO clientes (apellidos_cliente,nombres_cliente,dni_cliente,fecha_cliente,ciudad_cliente,provincia_cliente,direccion_cliente,email_cliente,telefono_cliente) values(:surname,:name,:dni,:fecha,:ciudad,:provincia,:direccion,:email,:telefono);';
                $query = $db->connect()->prepare($sql);
                $query->execute(
                    ['name' => $cliente->getNombre(),
                    'surname' => $cliente->getApellido(),
                    'dni' => $cliente->getDni(),
                    'fecha' => $cliente->getFecha(),
                    'ciudad' => $cliente->getCiudad(),
                    'provincia' => $cliente->getProvincia(),
                    'direccion' => $cliente->getDireccion(),
                    'email' => $cliente->getEmail(),
                    'telefono' => $cliente->getTelefono()
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
                $sql = "SELECT id_cliente,apellidos_cliente,nombres_cliente,dni_cliente,fecha_cliente,ciudad_cliente,provincia_cliente,direccion_cliente,email_cliente,telefono_cliente from clientes;";                            $query = $db->connect()->query($sql);
                while($row = $query->fetch()){
                    $cliente = $this->fabrica->getConexion("Cliente");
                    $cliente->setId($row['id_cliente']);
                    $cliente->setNombre($row['nombres_cliente']);
                    $cliente->setApellido($row['apellidos_cliente']);
                    $cliente->setDni($row['dni_cliente']);
                    $cliente->setFecha($row['fecha_cliente']);
                    $cliente->setCiudad($row['ciudad_cliente']);
                    $cliente->setProvincia($row['provincia_cliente']);
                    $cliente->setDireccion($row['direccion_cliente']);
                    $cliente->setEmail($row['email_cliente']);
                    $cliente->setTelefono($row['telefono_cliente']);
                    array_push($items,$cliente);
                }
                
                return $items;
            }catch(PDOException $e){
                return [];
            }
        
        }    
        public function getById($id){
            $cliente =  $this->fabrica->getConexion("Cliente");
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "SELECT apellidos_cliente,nombres_cliente,dni_cliente,fecha_cliente,ciudad_cliente,provincia_cliente,direccion_cliente,email_cliente,telefono_cliente from clientes where id_cliente=:id;";
                $query = $db->connect()->prepare($sql);

                $query->execute(['id'=>$id]);

                while($row = $query->fetch()){
                    $cliente->setId($id);
                    $cliente->setApellido($row['apellidos_cliente']);
                    $cliente->setNombre($row['nombres_cliente']);
                    $cliente->setDni($row['dni_cliente']);
                    $cliente->setFecha($row['fecha_cliente']);
                    $cliente->setCiudad($row['ciudad_cliente']);
                    $cliente->setProvincia($row['provincia_cliente']);
                    $cliente->setDireccion($row['direccion_cliente']);
                    $cliente->setEmail($row['email_cliente']);
                    $cliente->setTelefono($row['telefono_cliente']);
                }
                return $cliente;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function update($item){
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "UPDATE clientes SET apellidos_cliente=:surname,nombres_cliente=:name,dni_cliente=:dni,fecha_cliente=:fecha,ciudad_cliente=:ciudad,provincia_cliente=:provincia,direccion_cliente=:direccion,email_cliente=:email,telefono_cliente=:telefono where id_cliente=:id;";
                $query = $db->connect()->prepare($sql);
                $query->execute([
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'surname' => $item['surname'],
                    'dni' => $item['dni'],
                    'fecha' => $item['fecha'],
                    'ciudad' => $item['ciudad'],
                    'provincia' => $item['provincia'],
                    'direccion' => $item['direccion'],
                    'email' => $item['email'],
                    'telefono' => $item['telefono']
                ]);
                return true;
            }catch(PDOException $e){
                return false;
            }
            
        }     
        public function delete($id){
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "DELETE FROM clientes where id_cliente=:id;";
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