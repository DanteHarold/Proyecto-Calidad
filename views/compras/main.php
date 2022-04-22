<main class="main">
    <div class="message">
    <!-- <?php echo $this->mensaje; ?> -->
    <!-- <?php var_dump($this->datos); ?> -->
    </div>
    <div class="all-users">
        <div id="top-bar" class="top-bar">
            <h1 class="top-bar__title">Compras Registradas</h1>
            <div class="top-bar__buttons">
                <div class="search">
                    <input id="search-text" type="text" placeholder="Search User">
                </div>
            </div>
        </div>
        <div class="content">
            <div class="content__header--usuario">
                <input type="checkbox" >
                <p class="content__header--text">Fecha</p>
                <p class="content__header--text">Id-Cliente</p>
                <p class="content__header--text">Id-Empleado</p>
            </div>
            <div class="content__users">    
                    <?php 
                        //include_once 'models/producto.php';
                        foreach($this->datos as $compra){                                  
                    ?>
                <div id="content__user" class="content__user" >
                    <p class="content__user--text nombre" data-name="<?php  echo $compra->getFecha(); ?>" ><?php echo $compra->getFecha(); ?> </p>
                    <p class="content__user--text apellido"><?php echo $compra->getIdEmpleado(); ;  ?></p>
                    <p class="content__user--text email "><?php echo $compra->getIdProveedor(); ; ?></p>
                    <div id="options" class="content__user--options">
                        <a href="<?php echo constant('URL').'compras/verCompra/'.$compra->getId();; ?>"  class="content__user--link view" id="view">     
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</main>