<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/styles.css">
</head>
<body>

    <?php require_once 'views/header.php';?>
    <?php require_once 'views/sidebar.php';?>
    <?php require_once 'main.php'; ?>
    <div id="modal" class="lightBox lightBox--show">
        <form action="<?php echo constant('URL') ?>proveedores/editarProveedor" id="form-modal" class="form" method="POST">
            <h2 class="form__title"><?php echo $this->mensaje;?></h2>
            <div class="form__content">
            <div class="form__field form__field-50">
                    <label for="name" class="form__label">Descripcion: </label>
                    <input type="text" id="form-name"  name="name" value="<?php echo $this->proveedor->getNombre(); ?>" class="form__input">
                </div>
                <div class="form__field form__field-50">
                    <label for="surname" class="form__label">Direccion: </label>
                    <input type="text" id="form-surname"  name="direccion" value="<?php echo $this->proveedor->getDireccion(); ?>" required class="form__input">
                </div>
                <div class="form__field form__field-50">
                    <label for="email" class="form__label">Fecha: </label>
                    <input type="text" id="form-email"  name="fecha" value="<?php echo $this->proveedor->getFecha(); ?>" required class="form__input">
                </div>
                <div class="form__field form__field-50">
                    <label for="surname" class="form__label">Email: </label>
                    <input type="email" id="form-surname"  name="email" value="<?php echo $this->proveedor->getEmail(); ?>" required class="form__input">
                </div>
                <div class="form__field form__field-100">
                    <label for="surname" class="form__label">Telefono: </label>
                    <input type="text" id="form-surname"  name="telefono" value="<?php echo $this->proveedor->getTelefono(); ?>" required class="form__input">
                </div>
                <div class="form__field form__field-50">
                    <input type="submit" value="Enviar"  class="form__submit">
                </div>
            </div>  
        </form>
        </div>
    <?php require_once 'views/footer.php';?>
    <script src="<?php echo constant('URL'); ?>public/js/scripts.js"></script>
</body>
</html>
        

