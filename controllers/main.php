<?php
    class Main extends Controller{

        function __construct(){
            parent::__construct();
            //echo "<p>Nuevo Controlador MAIN</p>";
            require_once 'models/user_session.php';
            require_once 'models/usuario.php';
            $userSession = new userSession();
            $this->view->username = $userSession->getCurrentUser();
        }
        function render(){
            $this->view->render('main/index');
        }
        //Metodos
        public function hola(){

            echo "hola";
        }
        
    }


?>