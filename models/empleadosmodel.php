<?php
    require_once 'models/empleado.php';
    require_once 'models/database.php';
    require_once 'libs/IConexion.php';
    require_once 'libs/ConexionFabrica.php';
    class empleadosModel implements IConexion{
        
        public function __construct(){
            $this->fabrica = new ConexionFabrica();               
        }
        public function insert($datos){

            $empleado = $this->fabrica->getConexion("Empleado");
            $empleado->setNombre($datos['name']);
            $empleado->setApellido($datos['surname']);
            $empleado->setDni($datos['dni']);
            $empleado->setFecha($datos['fecha']);
            $empleado->setFechaNacimiento($datos['fecha_nacimiento']);
            $empleado->setEmail($datos['email']);
            $empleado->setTelefono($datos['telefono']);


            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = 'INSERT INTO empleados (apellidos_empleado,nombres_empleado,dni_empleado,telefono_empleado,fecha_nacimiento_empleado,fecha_ingreso_empleado,email_empleado) values(:surname,:name,:dni,:telefono,:fechaN,:fechaI,:email);';
                $query = $db->connect()->prepare($sql);
                $query->execute(
                    ['name' => $empleado->getNombre(),
                    'surname' => $empleado->getApellido(),
                    'dni' => $empleado->getDni(),
                    'telefono' => $empleado->getTelefono(),
                    'fechaN' => $empleado->getFechaNacimiento(),
                    'fechaI' => $empleado->getFecha(),
                    'email' => $empleado->getEmail()
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
                $sql = "SELECT id_empleado,apellidos_empleado,nombres_empleado,dni_empleado,telefono_empleado,fecha_nacimiento_empleado,fecha_ingreso_empleado,email_empleado from empleados;";                           
                $query = $db->connect()->query($sql);
                while($row = $query->fetch()){
                    $empleado = $this->fabrica->getConexion("Empleado");
                    $empleado->setId($row['id_empleado']);
                    $empleado->setNombre($row['nombres_empleado']);
                    $empleado->setApellido($row['apellidos_empleado']);
                    $empleado->setDni($row['dni_empleado']);
                    $empleado->setFecha($row['fecha_ingreso_empleado']);
                    $empleado->setFechaNacimiento($row['fecha_nacimiento_empleado']);
                    $empleado->setEmail($row['email_empleado']);
                    $empleado->setTelefono($row['telefono_empleado']);
                    array_push($items,$empleado);
                }
                return $items;
            }catch(PDOException $e){
                return [];
            }
        
        }    
        public function getById($id){
            $empleado =  $this->fabrica->getConexion("Empleado");
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "SELECT apellidos_empleado,nombres_empleado,dni_empleado,telefono_empleado,fecha_nacimiento_empleado,fecha_ingreso_empleado,email_empleado from empleados where id_empleado=:id;";
                $query = $db->connect()->prepare($sql);

                $query->execute(['id'=>$id]);

                while($row = $query->fetch()){
                    $empleado->setId($id);
                    $empleado->setApellido($row['apellidos_empleado']);
                    $empleado->setNombre($row['nombres_empleado']);
                    $empleado->setDni($row['dni_empleado']);
                    $empleado->setFecha($row['fecha_ingreso_empleado']);
                    $empleado->setFechaNacimiento($row['fecha_nacimiento_empleado']);
                    $empleado->setEmail($row['email_empleado']);
                    $empleado->setTelefono($row['telefono_empleado']);
                }
                return $empleado;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function update($item){
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "UPDATE empleados SET apellidos_empleado=:surname,nombres_empleado=:name,dni_empleado=:dni,telefono_empleado=:telefono,fecha_nacimiento_empleado=:fechaN,fecha_ingreso_empleado=:fechaI,email_empleado=:email where id_empleado=:id;";
                $query = $db->connect()->prepare($sql);
                $query->execute([
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'surname' => $item['surname'],
                    'dni' => $item['dni'],
                    'telefono' => $item['telefono'],
                    'fechaI' => $item['fecha'],
                    'fechaN' => $item['fecha_nacimiento'],
                    'email' => $item['email'],
                ]);
                return true;
            }catch(PDOException $e){
                return false;
            }
            
        }     
        public function delete($id){
            $db = $this->fabrica->getConexion("Conexion");  
            try{
                $sql = "DELETE FROM empleados where id_empleado=:id;";
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