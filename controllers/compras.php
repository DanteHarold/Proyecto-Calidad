<?php
    class Compras extends Controller{

        function __construct(){
            parent::__construct();
            $this->view->mensaje = "";
            $this->view->datos = [];
            
            $this->view->datosClientes = [];
            $this->view->datosProductos = [];
            $this->view->datosLocales = [];
            $this->view->datosEmpleados = [];
            require_once 'models/user_session.php';
            require_once 'models/usuario.php';
            $userSession = new userSession();
            $this->view->username = $userSession->getCurrentUser();
        }
        function render(){
            //$productos = $this->view->datos = $this->model->get();
            $pedidos = $this->model->get();
            $this->view->datos = $pedidos;
            $this->view->mensaje = "";
            $this->view->render('compras/index');
        }
 
        function registrarCompra(){
            $fechaCompra = $_POST['fecha'];

            $idEmpleado = $_POST['empleado'];
            $url1 = explode('-',$idEmpleado);
            $empleado = $url1[1];
            echo "Empleado: ".$empleado;
            echo '<br>';


            $idProveedor = $_POST['proveedor'];
            $url2 = explode('-',$idProveedor);
            $proveedor = $url2[1];
            echo "proveedor: ".$proveedor;
            echo '<br>';

            //DETALLE PRODUCTO
            $cantidad = $_POST['cantidad'];
            echo "Cantidad : ".$cantidad;
            echo '<br>';

            $idMaterial = $_POST['material'];
            $url3 = explode('-',$idMaterial);
            $material = $url3[1];
            echo "Material : ".$material;
            echo '<br>';

            require_once 'models/materialesmodel.php';
            $materialPrecio = new materialesModel();
            $materialP = $materialPrecio->getById($material);


            $total = $cantidad*$materialP->getPrecio();;
            echo "Total : ".$total;
            echo '<br>';

            


            if($this->model->insert(['fecha'=> $fechaCompra , 'idEmpleado' => $empleado , 'idProveedor'=> $proveedor])){
                $mensaje = "Compra Agregada";
                
                $compra = $this->model->getLast();
                $idCompra= $compra->getId();
                
                require_once 'models/detallecomprasmodel.php';
                $detalleCompra = new detalleComprasModel();
                if($detalleCompra->insert(['cantidad' => $cantidad,'total' => $total,'idMaterial' => $material,'idCompra' => $idCompra])){
                    echo "Detalle Compra Agregado Exitosamente";
                }else{
                    echo "Detalle Compra Agregado Exitosamente";
                }            
            }else{
                $mensaje = "Pedido No Agregado!";
                echo 'ERROR';
            }
            /*
            
            */
            require_once 'models/proveedoresmodel.php';
            $proveedores = new proveedoresModel();
            $this->view->datosProveedores = $proveedores->get();

            require_once 'models/materialesmodel.php';
            $materiales = new materialesModel();
            $this->view->datosMateriales = $materiales->get();


            require_once 'models/empleadosmodel.php';
            $empleados = new empleadosModel();

            $idEmpleado = $url1[1];
            $empleado = $empleados->getById($idEmpleado);
            $this->view->empleado = $empleado;

            //FONDO
            $this->view->datos = $empleados->get();;

            $this->view->mensaje = $mensaje;
            $this->view->render('empleados/registroCompra');
            
        }
    
        function verCompra($param = null){
            $idCompra = $param[0];
            $compra = $this->model->getById($idCompra);
            $this->view->compra = $compra;
            //echo $this->view->compra->getFecha();
            /*
            echo $pedido->getId();
            echo '<br>';
            echo $pedido->getIdCliente();
            echo '<br>';
            echo $pedido->getIdEmpleado();
            echo '<br>';
            */
            //CARGA LOS DATOS DE FONDO
            $compras = $this->model->get();
            $this->view->datos = $compras;
            
            
            $_SESSION['id_compra'] =  $idCompra;
            $this->view->mensaje = "DETALLE DEL PEDIDO ".$_SESSION['id_compra'] ;
            
            //CARGAR LOS DATOS Compra
            require_once 'models/empleadosmodel.php';
            $empleado = new empleadosModel();
            $this->view->empleado  = $empleado->getById($compra->getIdEmpleado());

            require_once 'models/proveedoresmodel.php';
            $proveedor = new proveedoresModel();
            $this->view->proveedor  = $proveedor->getById($compra->getIdProveedor());
            //echo $this->view->proveedor->getNombre();


            //CARGAR LOS DATOS DEL DETALLE PEDIDO
            require_once 'models/detallecomprasModel.php';
            $detalleCompra = new detallecomprasModel();
            $this->view->detalleCompra  = $detalleCompra->getByIdCompra($compra->getId());


            require_once 'models/materialesmodel.php';
            $material = new materialesModel();
            $this->view->material  = $material->getById($this->view->detalleCompra->getIdMaterial());
            $this->view->render('compras/consulta');
            
        }
      
    }


?>