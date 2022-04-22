<?php
    require_once 'models/usuario.php';
    require_once 'models/database.php';
    require_once 'libs/IConexion.php';
    require_once 'libs/ConexionFabrica.php';
    class usuariosModel implements IConexion{
        
        public function __construct(){
            $this->fabrica = new ConexionFabrica();               
        }
        public function insert($datos){

            $usuario = $this->fabrica->getConexion("Usuario");
            $usuario->setNombre($datos['name']);
            $usuario->setApellido($datos['surname']);
            $usuario->setEmail($datos['email']);
            $usuario->setUsername($datos['username']);
            $usuario->setPassword($datos['password']);


            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = 'INSERT INTO usuarios (nombre_usuario,apellido_usuario,email_usuario,username_usuario,password_usuario) values (:name,:surname,:email,:username,:password);';
                $query = $db->connect()->prepare($sql);
                $query->execute(
                    ['name' => $usuario->getNombre(),
                    'surname' => $usuario->getApellido(),
                    'email' => $usuario->getEmail(),
                    'username' => $usuario->getUsername(),
                    'password' => $usuario->getPassword()
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
                $sql = "SELECT id_usuario,nombre_usuario,apellido_usuario,email_usuario from usuarios;";            
                $query = $db->connect()->query($sql);
                while($row = $query->fetch()){
                    $usuario = $this->fabrica->getConexion("Usuario");
                    $usuario->setId($row['id_usuario']);
                    $usuario->setNombre($row['nombre_usuario']);
                    $usuario->setApellido($row['apellido_usuario']);
                    $usuario->setEmail($row['email_usuario']);
                    array_push($items,$usuario);
                }
                return $items;
            }catch(PDOException $e){
                return [];
            }
        
        }    
        public function getById($id){
            $usuario =  $this->fabrica->getConexion("Usuario");
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "SELECT nombre_usuario,apellido_usuario,email_usuario from usuarios where id_usuario=:id;";
                $query = $db->connect()->prepare($sql);

                $query->execute(['id'=>$id]);

                while($row = $query->fetch()){
                    $usuario->setNombre($row['nombre_usuario']);
                    $usuario->setApellido($row['apellido_usuario']);
                    $usuario->setEmail($row['email_usuario']);
                }
                return $usuario;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function update($item){
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "UPDATE usuarios SET nombre_usuario=:name,apellido_usuario=:surname,email_usuario=:email where id_usuario=:id;";
                $query = $db->connect()->prepare($sql);
                $query->execute([
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'surname' => $item['surname'],
                    'email' => $item['email']
                ]);
                return true;
            }catch(PDOException $e){
                return false;
            }
            
        }     
        public function delete($id){
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "DELETE FROM usuarios where id_usuario=:id;";
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