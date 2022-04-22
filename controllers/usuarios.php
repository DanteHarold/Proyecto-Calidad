<?php
    class Usuarios extends Controller{

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
            $usuarios = $this->model->get();
            $this->view->datos = $usuarios;
            $this->view->mensaje = "Usuarios Actualmente";
            $this->view->render('usuarios/index');
        }
        function agregarUsuario(){
            $usuarios = $this->model->get();
            $this->view->datos = $usuarios;
            $this->view->render('usuarios/registro');
        }
        function registrarUsuario(){
            $name =     $_POST['name'];
            $surname =  $_POST['surname'];
            $email =    $_POST['email'];
            $username =    $_POST['username'];
            $password =    $_POST['password'];
            
            $mensaje = "";

            if($this->model->insert(['name'=> $name , 'surname' => $surname , 'email'=> $email,'username' => $username , 'password'=> $password])){

                $mensaje = "Usuario Agregado";
            }else{
                $mensaje = "Usuario No Agregado!";
            }

            $this->view->mensaje = $mensaje;
            $this->render();
        }
        function verUsuario($param = null){
            $idUsuario = $param[0];
            $usuario = $this->model->getById($idUsuario);
            $this->view->usuario = $usuario;

            //CARGA LOS DATOS DE FONDO
            $usuarios = $this->model->get();
            $this->view->datos = $usuarios;
            
            
            $_SESSION['id_usuario'] =  $idUsuario;
            $this->view->mensaje = "DETALLE DEL Usuario ".$_SESSION['id_usuario'] ;
            
            $this->view->render('usuarios/consulta');
        }
        function actualizarUsuario($param = null){
            
            $idUsuario = $param[0];
            $usuario = $this->model->getById($idUsuario);
            $this->view->usuario = $usuario;
            //CARGA LOS DATOS DE FONDO
            $usuarios = $this->model->get();
            $this->view->datos = $usuarios;

            
            $_SESSION['id_usuario'] =  $idUsuario;
            $this->view->mensaje = "ACTUALIZANDO Usuarios ".$_SESSION['id_usuario'] ;

            $this->view->render('usuarios/editar');
        }
        function editarUsuario(){
            $idUsuario =  $_SESSION['id_usuario'];
            $name =     $_POST['name'];
            $surname =  $_POST['surname'];
            $email =    $_POST['email'];

            if($this->model->update(['id'=>$idUsuario,'name'=>$name,'surname'=>$surname,'email'=>$email])){
                
                $usuario = new Usuario();
                $usuario->setId($idUsuario);
                $usuario->setNombre($name);
                $usuario->setApellido($surname);
                $usuario->setEmail($email);

                $this->view->usuario = $usuario;
                $this->view->mensaje = "Actualizado correctamente";
            }else{
                $this->view->mensaje = "No actualizado";
            }

            $usuarios = $this->model->get();
            $this->view->datos = $usuarios;

            $this->view->render('usuarios/editar');

        }
        function eliminarUsuario($param = null){
            $idUsuario = $param[0];
            
            if($this->model->delete($idUsuario)){
                $this->view->mensaje = "Actualizado";
            }else{
                $this->view->mensaje = "No actualizado";
            }
            $usuarios = $this->model->get();
            $this->view->datos = $usuarios;
            $this->render();

        }
    }
?>