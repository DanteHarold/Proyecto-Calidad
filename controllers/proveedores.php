<?php
    class Proveedores extends Controller{

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
            $proveedores = $this->model->get();
            $this->view->datos = $proveedores;
            $this->view->mensaje = "";
            $this->view->render('proveedores/index');
        }
        function agregarProveedor(){
            $proveedores = $this->model->get();
            $this->view->datos = $proveedores;
            $this->view->render('proveedores/registro');
        }
        function registrarProveedor(){
            $name =     $_POST['name'];
            $direccion =  $_POST['direccion'];
            $fecha =    $_POST['fecha'];
            $email =    $_POST['email'];
            $telefono =    $_POST['telefono'];

            $mensaje = "";

            if($this->model->insert(['name'=> $name , 'direccion' => $direccion , 'fecha'=> $fecha,'email' => $email , 'telefono'=> $telefono])){
                $mensaje = "Proveedor Agregado";
            }else{
                $mensaje = "Proveedor No Agregado!";
                echo 'ERROR';
            }

            $this->view->mensaje = $mensaje;
            $this->render();
        }
        function verProveedor($param = null){
            
            $idProveedor = $param[0];
            $proveedor = $this->model->getById($idProveedor);
            $this->view->proveedor = $proveedor;

            //CARGA LOS DATOS DE FONDO
            $proveedores = $this->model->get();
            $this->view->datos = $proveedores;
            
            
            $_SESSION['id_proveedor'] =  $idProveedor;
            $this->view->mensaje = "Detalle Del Proveedor ".$_SESSION['id_proveedor'] ;
            
            $this->view->render('proveedores/consulta');
        }
        function actualizarProveedor($param = null){
            
            $idProveedor = $param[0];
            $proveedor = $this->model->getById($idProveedor);
            $this->view->proveedor = $proveedor;
            //CARGA LOS DATOS DE FONDO
            $proveedores = $this->model->get();
            $this->view->datos = $proveedores;

            
            $_SESSION['id_proveedor'] =  $idProveedor;
            $this->view->mensaje = "ACTUALIZANDO Usuarios ".$_SESSION['id_proveedor'] ;

            $this->view->render('proveedores/editar');
        }
        function editarProveedor(){
            $idProveedor =  $_SESSION['id_proveedor'];
            $name =     $_POST['name'];
            $direccion =  $_POST['direccion'];
            $fecha =    $_POST['fecha'];
            $email =    $_POST['email'];
            $telefono =    $_POST['telefono'];

            if($this->model->update(['id'=>$idProveedor,'name'=> $name , 'direccion' => $direccion , 'fecha'=> $fecha,'email' => $email , 'telefono'=> $telefono])){
                
                $proveedor = new Proveedor();
                $proveedor->setId($idProveedor);
                $proveedor->setNombre($name);
                $proveedor->setDireccion($direccion);
                $proveedor->setFecha($fecha);
                $proveedor->setEmail($email);
                $proveedor->setTelefono($telefono);

                $this->view->proveedor = $proveedor;
                $this->view->mensaje = "Actualizado correctamente";
            }else{
                $this->view->mensaje = "No actualizado";
            }

            $proveedores = $this->model->get();
            $this->view->datos = $proveedores;

            $this->view->render('proveedores/editar');

        }
        function eliminarProveedor($param = null){
            $idProveedor = $param[0];
            
            if($this->model->delete($idProveedor)){
                $this->view->mensaje = "Actualizado";
            }else{
                $this->view->mensaje = "No actualizado";
            }
            $proveedores = $this->model->get();
            $this->view->datos = $proveedores;
            $this->render();

        }
    }


?>