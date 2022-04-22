<?php
    class Empleados extends Controller{

        function __construct(){
            parent::__construct();
            $this->view->mensaje = "";
            $this->view->datos = [];
            require_once 'models/user_session.php';
            require_once 'models/usuario.php';
            $userSession = new userSession();
            $this->view->username = $userSession->getCurrentUser();
        }
        function render(){
            //$productos = $this->view->datos = $this->model->get();
            $empleados = $this->model->get();
            $this->view->datos = $empleados;
            $this->view->mensaje = "";
            $this->view->render('empleados/index');
        }
        function agregarEmpleado(){
            $empleados = $this->model->get();
            $this->view->datos = $empleados;
            $this->view->render('empleados/registro');
        }
        function registrarEmpleado(){
            $name =     $_POST['name'];
            $surname =  $_POST['surname'];
            $dni =    $_POST['dni'];
            $fecha =    $_POST['fecha'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            $email =    $_POST['email'];
            $telefono =    $_POST['telefono'];
            
            $mensaje = "";

            if($this->model->insert(['name'=> $name , 'surname' => $surname , 'dni'=> $dni,'fecha' => $fecha , 'fecha_nacimiento'=> $fecha_nacimiento, 'email'=> $email,'telefono' => $telefono])){
                $mensaje = "Empleado Agregado";
            }else{
                $mensaje = "Empleado No Agregado!";
                echo 'ERROR';
            }

            $this->view->mensaje = $mensaje;
            $this->render();
        }
        function verEmpleado($param = null){
            
            $idEmpleado = $param[0];
            $empleado = $this->model->getById($idEmpleado);
            $this->view->empleado = $empleado;

            //CARGA LOS DATOS DE FONDO
            $empleados = $this->model->get();
            $this->view->datos = $empleados;
            
            $_SESSION['id_empleado'] =  $idEmpleado;
            $this->view->mensaje = "DETALLE DEL Empleado ".$_SESSION['id_empleado'] ;
            
            $this->view->render('empleados/consulta');
        }
        function actualizarEmpleado($param = null){
            
            $idEmpleado = $param[0];
            $empleado = $this->model->getById($idEmpleado);
            $this->view->empleado = $empleado;
            //CARGA LOS DATOS DE FONDO
            $empleados = $this->model->get();
            $this->view->datos = $empleados;

            
            $_SESSION['id_empleado'] =  $idEmpleado;
            $this->view->mensaje = "ACTUALIZANDO EMPLEADOS ".$_SESSION['id_empleado'] ;

            $this->view->render('empleados/editar');
        }
        function editarEmpleado(){
            $idEmpleado =  $_SESSION['id_empleado'];
            $name =     $_POST['name'];
            $surname =  $_POST['surname'];
            $dni =    $_POST['dni'];
            $fecha =    $_POST['fecha'];
            $fecha_nacimiento =    $_POST['fecha_nacimiento'];
            $email =    $_POST['email'];
            $telefono =    $_POST['telefono'];

            if($this->model->update(['id'=>$idEmpleado,'name'=> $name , 'surname' => $surname , 'dni'=> $dni,'fecha' => $fecha , 'fecha_nacimiento'=> $fecha_nacimiento,'email'=> $email,'telefono' => $telefono])){
                
                $empleado = new Empleado();
                $empleado->setId($idEmpleado);
                $empleado->setNombre($name);
                $empleado->setApellido($surname);
                $empleado->setDni($dni);
                $empleado->setFecha($fecha);
                $empleado->setFechaNacimiento($fecha_nacimiento);
                $empleado->setEmail($email);
                $empleado->setTelefono($telefono);

                $this->view->empleado = $empleado;
                $this->view->mensaje = "Actualizado correctamente";
            }else{
                $this->view->mensaje = "No actualizado";
            }

            $empleados = $this->model->get();
            $this->view->datos = $empleados;

            $this->view->render('empleados/editar');

        }
        function eliminarEmpleado($param = null){
            $idEmpleado = $param[0];
            
            if($this->model->delete($idEmpleado)){
                $this->view->mensaje = "Actualizado";
            }else{
                $this->view->mensaje = "No actualizado";
            }
            $empleados = $this->model->get();
            $this->view->datos = $empleados;
            $this->render();

        }
        function agregarCompra($param = null){

            require_once 'models/proveedoresmodel.php';
            $proveedores = new proveedoresModel();
            $this->view->datosProveedores = $proveedores->get();

            require_once 'models/materialesmodel.php';
            $materiales = new materialesModel();
            $this->view->datosMateriales = $materiales->get();

            $idEmpleado = $param[0];
            $empleado = $this->model->getById($idEmpleado);
            $this->view->empleado = $empleado;

            $empleados = $this->model->get();
            $this->view->datos = $empleados;
            $this->view->render('empleados/registroCompra');
            
        }
        function verificarCompra($param = null){
            require_once 'models/materialesmodel.php';
            $materiales = new materialesModel();
            $idMaterial = $param[0];
            $material = $materiales->getById($idMaterial);


            $ajaxMateriales = array('id' => $idMaterial,
            'descripcion' => $material->getDescripcion(),
            'precio' => $material->getPrecio());
        

            echo json_encode($ajaxMateriales);
        }
    }


?>