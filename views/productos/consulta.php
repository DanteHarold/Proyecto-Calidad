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
            <form action="<?php echo constant('URL') ?>productos/registrarProducto" id="form-modal" class="form" method="POST">
                <h2 class="form__title"><?php echo $this->mensaje; ?></h2>
                <div class="form__content">
                    <div class="form__field form__field-100">
                        <label for="name" class="form__label">Descripcion: </label>
                        <input type="text" id="form-name" disabled name="descripcion" value="<?php echo $this->producto->getDescripcion(); ?>" class="form__input">
                    </div>
                    <div class="form__field form__field-50">
                        <label for="surname" class="form__label">Categoria: </label>
                        <input type="text" id="form-surname" disabled name="categoria" value="<?php echo $this->producto->getCategoria(); ?>" required class="form-input">
                    </div>
                    <div class="form__field form__field-50">
                        <label for="email" class="form__label">Fecha: </label>
                        <input type="text" id="form-email" disabled name="fecha" value="<?php echo $this->producto->getFecha(); ?>" required class="form-input">
                    </div>
                    <div class="form__field form__field-50">
                        <label for="surname" class="form__label">Precio: </label>
                        <input type="text" id="form-surname" disabled name="precio" value="<?php echo $this->producto->getPrecio(); ?>" required class="form-input">
                    </div>
                    <div class="form__field form__field-50">
                        <label for="email" class="form__label">Stock: </label>
                        <input type="number" id="form-email" disabled name="stock" value="<?php echo $this->producto->getStock(); ?>" required class="form-input">
                    </div>
                </div>  
            </form>
        </div>
    <?php require_once 'views/footer.php';?>
    <!-- <h1>Esta es la Vista de Main</h1> -->
    <script src="<?php echo constant('URL'); ?>public/js/scripts.js"></script>
</body>
</html>

