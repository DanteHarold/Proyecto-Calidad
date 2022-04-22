<?php
    class Clientes extends Controller{

        function __construct(){
            parent::__construct();
            $this->view->mensaje = "";
            $this->view->datos = [];
            $this->view->datosProductos = [];
            $this->view->datosLocales = [];
            $this->view->datosEmpleados = [];
            $this->view->product = [];
            require_once 'models/user_session.php';
            require_once 'models/usuario.php';
            $userSession = new userSession();
            $this->view->username = $userSession->getCurrentUser();
        }
        function render(){
            //$productos = $this->view->datos = $this->model->get();
            
            $clientes = $this->model->get();
            $this->view->datos = $clientes;
            $this->view->mensaje = "";
            $this->view->render('clientes/index');
        }
        function agregarCliente(){
            $clientes = $this->model->get();
            $this->view->datos = $clientes;
            $this->view->render('clientes/registro');
        }
        function registrarCliente(){
            $name =     $_POST['name'];
            $surname =  $_POST['surname'];
            $dni =    $_POST['dni'];
            $fecha =    $_POST['fecha'];
            $ciudad =    $_POST['ciudad'];
            $provincia =    $_POST['provincia'];
            $direccion =    $_POST['direccion'];
            $email =    $_POST['email'];
            $telefono =    $_POST['telefono'];
            
            $mensaje = "";

            if($this->model->insert(['name'=> $name , 'surname' => $surname , 'dni'=> $dni,'fecha' => $fecha , 'ciudad'=> $ciudad,'provincia'=> $provincia , 'direccion' => $direccion , 'email'=> $email,'telefono' => $telefono])){
                $mensaje = "Cliente Agregado";
            }else{
                $mensaje = "Cliente No Agregado!";
                echo 'ERROR';
            }

            $this->view->mensaje = $mensaje;
            $this->render();
        }
        function verCliente($param = null){
            
            $idCliente = $param[0];
            $cliente = $this->model->getById($idCliente);
            $this->view->cliente = $cliente;

            //CARGA LOS DATOS DE FONDO
            $clientes = $this->model->get();
            $this->view->datos = $clientes;
            
            
            $_SESSION['id_cliente'] =  $idCliente;
            $this->view->mensaje = "DETALLE DEL Usuario ".$_SESSION['id_cliente'] ;
            
            $this->view->render('clientes/consulta');
        }
        function actualizarCliente($param = null){
            
            $idCliente = $param[0];
            $cliente = $this->model->getById($idCliente);
            $this->view->cliente = $cliente;
            //CARGA LOS DATOS DE FONDO
            $clientes = $this->model->get();
            $this->view->datos = $clientes;

            
            $_SESSION['id_cliente'] =  $idCliente;
            $this->view->mensaje = "ACTUALIZANDO Usuarios ".$_SESSION['id_cliente'] ;

            $this->view->render('clientes/editar');
        }
        function editarCliente(){
            $idCliente =  $_SESSION['id_cliente'];
            $name =     $_POST['name'];
            $surname =  $_POST['surname'];
            $dni =    $_POST['dni'];
            $fecha =    $_POST['fecha'];
            $ciudad =    $_POST['ciudad'];
            $provincia =    $_POST['provincia'];
            $direccion =    $_POST['direccion'];
            $email =    $_POST['email'];
            $telefono =    $_POST['telefono'];

            if($this->model->update(['id'=>$idCliente,'name'=> $name , 'surname' => $surname , 'dni'=> $dni,'fecha' => $fecha , 'ciudad'=> $ciudad,'provincia'=> $provincia , 'direccion' => $direccion , 'email'=> $email,'telefono' => $telefono])){
                
                $cliente = new Cliente();
                $cliente->setId($idCliente);
                $cliente->setNombre($name);
                $cliente->setApellido($surname);
                $cliente->setDni($dni);
                $cliente->setFecha($fecha);
                $cliente->setCiudad($ciudad);
                $cliente->setProvincia($provincia);
                $cliente->setDireccion($direccion);
                $cliente->setEmail($email);
                $cliente->setTelefono($telefono);

                $this->view->cliente = $cliente;
                $this->view->mensaje = "Actualizado correctamente";
            }else{
                $this->view->mensaje = "No actualizado";
            }

            $clientes = $this->model->get();
            $this->view->datos = $clientes;

            $this->view->render('clientes/editar');

        }
        function eliminarCliente($param = null){
            $idCliente = $param[0];
            
            if($this->model->delete($idCliente)){
                $this->view->mensaje = "Actualizado";
            }else{
                $this->view->mensaje = "No actualizado";
            }
            $clientes = $this->model->get();
            $this->view->datos = $clientes;
            $this->render();

        }
        function agregarPedido($param = null){

            require_once 'models/empleadosmodel.php';
            $empleados = new EmpleadosModel();
            $this->view->datosEmpleados = $empleados->get();

            require_once 'models/localesmodel.php';
            $locales = new LocalesModel();
            $this->view->datosLocales = $locales->get();

            require_once 'models/productosmodel.php';
            $productos = new ProductosModel();
            $this->view->datosProductos = $productos->get();

            $idCliente = $param[0];
            $cliente = $this->model->getById($idCliente);
            $this->view->cliente = $cliente;

            $clientes = $this->model->get();
            $this->view->datos = $clientes;
            $this->view->render('clientes/registroPedido');
            
        }
        function verificarPedido($param = null){
            require_once 'models/productosmodel.php';
            $productos = new ProductosModel();
            $idProducto2 = $param[0];
            $product = $productos->getById($idProducto2);


            $ajaxProductos = array('id' => $idProducto2,
            'descripcion' => $product->getDescripcion(),
            'precio' => $product->getPrecio());
        

            echo json_encode($ajaxProductos);
        }
    }


?>