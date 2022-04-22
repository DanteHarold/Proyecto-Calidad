<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Responsive</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/styles.css">
</head>
<body>
    <form action="<?php echo constant('URL') ?>login/registrarUsuario" method="POST" class="form-register" ">
        <h2 class="form-title">Crea Tu Cuenta</h2>
        <div class="container-inputs">
            <input type="text" id="name" name="name" placeholder="Nombres" class="input-50" >
            <input type="text" id="surname" name="surname" placeholder="Apellidos" class="input-50" >
            <input type="email" id="email" name="email" placeholder="Email" class="input-100" >
            <input type="text" id="Username" name="username" placeholder="Username" class="input-50" >
            <input type="password" id="password" name="password" placeholder="Contraseña" class="input-50" >
            <input type="submit" value="Sign In" class="btn-enviar">
            <p class="form-link"><a href="<?php echo constant('URL') ?>">Volver</a> </p>
        </div>
    </form>
</body>
</html>