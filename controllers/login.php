<?php
    class Login extends Controller{

        function __construct(){
            parent::__construct();
            $this->view->mensaje = "";
            $this->view->datos = [];
        }
        function render(){
            $this->view->mensaje = "Usuarios Actualmente";
            $this->view->render('login');
        }
        function verificarUsuario(){
            require_once 'models/user_session.php';
            require_once 'models/usuario.php';
            $usuario = new Usuario();
            $userSession = new userSession();

            if(isset($_SESSION['user'])){
                /*
                $usuario->setUsername($userSession->getCurrentUser());
                */
                $this->view->username = $userSession->getCurrentUser();
                $this->view->render('main/index');
               //echo "Sesión Iniciada : ".$userSession->getCurrentUser();
            }else if(isset($_POST['username']) && isset($_POST['password'])){
                $username = $_POST['username'];
                $password = $_POST['password'];
                if($this->model->getValidacion(['username'=> $username , 'password' => $password ])){

                    $userSession->setCurrentUser($username);            
                    $usuario->setUsername($username);
                    
                    $this->view->username = $userSession->getCurrentUser();
                    $this->view->render('main/index');
                }else{
                    echo "No Entró";
                    $this->render();
                }
            }else{
                echo "LOGIN";
            }
        }
        function cerrarUsuario(){
            require_once 'models/user_session.php';
            require_once 'models/usuario.php';
            $userSession = new userSession();
            $userSession->closeSession();
            $this->render('login');
        }
        function agregarUsuario(){
            $this->view->render('register');
        }
        function registrarUsuario(){
            $name =     $_POST['name'];
            $surname =  $_POST['surname'];
            $email =    $_POST['email'];
            $username =    $_POST['username'];
            $password =    $_POST['password'];
            
            $mensaje = "";

            if($this->model->insert(['name'=> $name , 'surname' => $surname , 'email'=> $email,'username' => $username , 'password'=> $password])){

                $this->render('login');
            }else{
                $mensaje = "Usuario No Agregado!";
            }

            $this->view->mensaje = $mensaje;
            
        }
    }
?>