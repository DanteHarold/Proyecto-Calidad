<?php
    $pages = array('fas fa-home' => 'main','fas fa-hands' => 'productos','fas fa-user-check'=>'empleados','fas fa-user-tag'=>'clientes','fas fa-shopping-bag'=>'pedidos','fas fa-users'=>'usuarios','fas fa-shopping-cart'=>'compras','fas fa-user-friends'=>'proveedores','fas fa-bacteria'=>'materiales');
?>
<div class="sidebar">
    <nav class="main-nav">
        <ul class="main-menu">
            <?php         
                foreach ($pages as $icon => $page) {
                    if($page=="main"){
                        echo '<li class="main-menu__item"><i class = "'.$icon.' main-menu__icon"></i><a class="main-menu__link" href="'.constant('URL').$page.'">home</a><span class="tooltip">home</span></li>';
                    }else{
                        echo '<li class="main-menu__item"><i class = "'.$icon.' main-menu__icon"></i><a class="main-menu__link" href="'.constant('URL').$page.'">'.$page.'</a><span class="tooltip">'.$page.'</span></li>';
                    }
                }
                ?>
            <!-- <li class="main-menu__item"><i class="fas fa-user-check main-menu__icon"></i><a class="main-menu__link" href="/Proyecto_DIARSO/public/empleados.html">empleados</a><span class="tooltip">empleados</span> -->
            <!-- <li><a href="<?php //echo constant('URL'); ?>main">Inicio</a></li> -->
        </ul>
    </nav>
</div>
    