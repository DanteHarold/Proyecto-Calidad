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
        <form action="<?php echo constant('URL') ?>empleados/editarEmpleado" id="form-modal" class="form" method="POST">
            <h2 class="form__title"><?php echo $this->mensaje;?></h2>
            <div class="form__content">
            <div class="form__field form__field-50">
                    <label for="name" class="form__label">Nombre: </label>
                    <input type="text" id="form-name"  name="name" value="<?php echo $this->empleado->getNombre(); ?>" class="form-input">
                </div>
                <div class="form__field form__field-50">
                    <label for="surname" class="form__label">Apellido: </label>
                    <input type="text" id="form-surname"  name="surname" value="<?php echo $this->empleado->getApellido(); ?>" required class="form-input">
                </div>
                <div class="form__field form__field-50">
                    <label for="email" class="form__label">Dni: </label>
                    <input type="text" id="form-email"  name="dni" value="<?php echo $this->empleado->getDni(); ?>" required class="form-input">
                </div>
                <div class="form__field form__field-50">
                    <label for="surname" class="form__label">Fecha: </label>
                    <input type="text" id="form-surname"  name="fecha" value="<?php echo $this->empleado->getFecha(); ?>" required class="form-input">
                </div>
                <div class="form__field form__field-50">
                    <label for="email" class="form__label">Fecha Nacimiento: </label>
                    <input type="text" id="form-email"  name="fecha_nacimiento" value="<?php echo $this->empleado->getFechaNacimiento(); ?>" required class="form-input">
                </div>
                <div class="form__field form__field-50">
                    <label for="surname" class="form__label">Email: </label>
                    <input type="text" id="form-surname"  name="email" value="<?php echo $this->empleado->getEmail(); ?>" required class="form-input">
                </div>
                <div class="form__field form__field-100">
                    <label for="email" class="form__label">Telefono: </label>
                    <input type="text" id="form-email"  name="telefono" value="<?php echo $this->empleado->getTelefono(); ?>" required class="form-input">
                </div>
                <div class="form__field form__field-50">
                    <input type="submit" value="Enviar"  class="form__submit ">
                </div>
            </div>  
        </form>
        </div>
    <?php require_once 'views/footer.php';?>
    <script src="<?php echo constant('URL'); ?>public/js/scripts.js"></script>
</body>
</html>
        

