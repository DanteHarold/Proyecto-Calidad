<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/styles.css">
</head>
<body>
    <?php require_once 'views/header.php';?>
    <?php require_once 'views/sidebar.php';?>
    <?php require_once 'main.php'; ?>
    <div id="modal" class="lightBox lightBox--show">
        <form action="<?php echo constant('URL') ?>pedidos/registrarPedido" id="form-modal" class="form" method="POST">
            <h2 class="form__title"><?php echo $this->mensaje; ?></h2>
            <div class="form__content">
                <div class="form__field form__field-50">
                    <label class="form__label">Id-Pedido: </label>
                    <input type="list"  value="<?php echo $pedido->getId();?>"  class="form__input">
                </div>
                <div class="form__field form__field-50">
                    <label class="form__label">Cliente: </label>
                    <input  value="<?php echo $this->cliente->getNombre().'-'.$this->cliente->getId(); ?>"  class="form__input">
                </div>
                <div class="form__field form__field-50">
                    <label class="form__label">Empleado: </label>
                    <input type="list"  value="<?php echo $this->empleado2->getNombre().'-'.$this->empleado2->getId(); ?>"  class="form__input">
                </div>
                <div class="form__field form__field-50">
                    <label class="form__label">Local: </label>
                    <input  value="<?php echo $this->local2->getNombre().'-'.$this->local2->getId(); ?>"  class="form__input">
                </div>
                <div class="form__field form__field-50">
                    <label class="form__label">Fecha: </label>
                    <input type="list"  value="<?php echo $this->pedido->getFecha();?>"  class="form__input">
                </div>
                <div class="form__field form__field-50">
                    <label class="form__label">Producto: </label>
                    <input  value="<?php echo $this->producto->getDescripcion().'-'.$this->producto->getId(); ?>"  class="form__input">
                </div>
                <div class="content-pedido">
                        <div class="content-pedido__header--pedido">
                            <p class="content-pedido__header--text">Descripcion</p>
                            <p class="content-pedido__header--text">Precio</p>
                            <p class="content-pedido__header--text">Cantidad</p>
                            <p class="content-pedido__header--text">Total</p>
                        </div>
                        <div id="content-pedido__pedidos"class="content-pedido__pedidos">  
                                <div id="content__pedido"   class="content-pedido__pedido" >
                                    <p id="nombreP" class="content__user--text nombreP" data-name="" ><?php echo $this->producto->getDescripcion(); ?></p>
                                    <p id="precioP" class="content__user--text precioP" ><?php echo $this->producto->getPrecio(); ?></p>
                                    <p id="cantidadP" class="content__user--text cantidadP"><?php echo $this->detallePedido->getCantidad();?>                            
                                    </p>
                                    <p id="totalP" class="content__user--text totalP" >    
                                    <?php echo $this->detallePedido->getTotal(); ?>
                                    </p>
                                </div>
                        </div>    
                </div>                                   
        </form>
    </div>
    <?php require_once 'views/footer.php';?>
    <!-- <h1>Esta es la Vista de Main</h1> -->
    <script src="<?php echo constant('URL'); ?>public/js/scripts.js"></script>
</body>
</html>
