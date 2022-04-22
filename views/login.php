<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/styles.css">
</head>
<body>
    <div class="login-box">
        <h1>Login</h1>
        <form action="<?php echo constant('URL') ?>login/verificarUsuario" method="POST">
            <div class="textbox">             
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Username">
            </div>
            <div class="textbox">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password">
            </div>
            <input class="btn" type="submit" value="Ingresar">
            <p class="form-link">¿Nuevo Usuario? <a href="<?php echo constant('URL') ?>login/agregarUsuario">Ingresa Aqui</a> </p>
        </form>
    </div>
</body>
</html>