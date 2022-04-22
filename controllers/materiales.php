<?php
    class Materiales extends Controller{
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
            $materiales = $this->model->get();
            $this->view->datos = $materiales;
            $this->view->mensaje = "";
            $this->view->render('materiales/index');
        }
        function agregarMaterial(){
            $materiales = $this->model->get();
            $this->view->datos = $materiales;
            $this->view->render('materiales/registro');
        }
        function registrarMaterial(){
            $name =     $_POST['name'];
            $fecha =  $_POST['fecha'];
            $precio =    $_POST['precio'];
            $stock =    $_POST['stock'];
    
            $mensaje = "";
            if($this->model->insert(['name'=> $name , 'fecha' => $fecha , 'precio'=> $precio,'stock' => $stock])){
                $mensaje = "Material Agregado";
            }else{
                $mensaje = "Material No Agregado!";
                echo 'ERROR';
            }

            $this->view->mensaje = $mensaje;
            $this->render();
        }
        function verMaterial($param = null){
            
            $idMaterial = $param[0];
            $material = $this->model->getById($idMaterial);
            $this->view->material = $material;

            //CARGA LOS DATOS DE FONDO
            $materiales = $this->model->get();
            $this->view->datos = $materiales;
            
            
            $_SESSION['id_material'] =  $idMaterial;
            $this->view->mensaje = "DETALLE DEL MATERIAL ".$_SESSION['id_material'] ;
            
            $this->view->render('materiales/consulta');
        }
        function actualizarMaterial($param = null){
            
            $idMaterial = $param[0];
            $material = $this->model->getById($idMaterial);
            $this->view->material = $material;
            //CARGA LOS DATOS DE FONDO
            $materiales = $this->model->get();
            $this->view->datos = $materiales;

            
            $_SESSION['id_material'] =  $idMaterial;
            $this->view->mensaje = "ACTUALIZANDO Materiales ".$_SESSION['id_material'] ;

            $this->view->render('materiales/editar');
        }
        function editarMaterial(){
            $idMaterial =  $_SESSION['id_material'];
            $name =     $_POST['name'];
            $fecha =  $_POST['fecha'];
            $precio =    $_POST['precio'];
            $stock =    $_POST['stock'];
 
            if($this->model->update(['id'=>$idMaterial,'name'=> $name , 'fecha' => $fecha , 'precio'=> $precio,'stock' => $stock])){
                
                $material = new Material();
                $material->setId($idMaterial);
                $material->setDescripcion($name);
                $material->setFecha($fecha);
                $material->setPrecio($precio);
                $material->setStock($stock);

                $this->view->material = $material;
                $this->view->mensaje = "Actualizado correctamente";
            }else{
                $this->view->mensaje = "No actualizado";
            }

            $materiales = $this->model->get();
            $this->view->datos = $materiales;

            $this->view->render('materiales/editar');

        }
        function eliminarMaterial($param = null){
            $idMaterial = $param[0];
            
            if($this->model->delete($idMaterial)){
                $this->view->mensaje = "Actualizado";
            }else{
                $this->view->mensaje = "No actualizado";
            }
            $materiales = $this->model->get();
            $this->view->datos = $materiales;
            $this->render();

        }
    }


?>