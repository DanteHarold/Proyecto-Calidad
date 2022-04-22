<?php
    class Errores extends Controller{

        function __construct(){
            parent::__construct();
            $this->view->mensaje = "Ventana no Disponible :(";
            $this->view->render('errores/index');
            //echo "<p>Error al Cargar Recurso</p>";
        }
    }

?>