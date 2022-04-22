<header class="header">
        <?php
        
        require_once 'controllers/login.php';
        ?>
        <a class="logo" href="<?php echo constant('URL'); ?>main"><i class="fas fa-shopping-cart"></i></a>
        <div class="text-logo">
                <div class="text-logo__title">Foragaza</div><span class="text-logo__subtitle">Unique</span>
        </div>
        <div class="toggle-menu" id="toggle-menu">
                        <div class="toggle-menu__icon" id="toggle-menu"><i class="fas fa-bars"></i></div>
        </div>
        <div class="topbar">
                <div class="topbar__profile">
                        <img class="img" src="<?php echo constant('URL');?>public/assets/img/imgperfil.jpg" alt="">
                        <div class="name">
                                <div class="name__first"><?php
                                echo $this->username; ?></div>
                                <div class="name__job">Administrador</div>
                        </div>
                </div>
                <div class="icon"> <i class="icon-perfil fas fa-caret-down"></i>
                        <ul class="nav">
                                <li class="nav__item"><a href="">Perfil</a> </li>
                                <li class="nav__item"><a href="<?php echo constant('URL') ?>login/cerrarUsuario">Cerrar Sesión</a> </li>
                        </ul>
                </div>
        </div>
</header>