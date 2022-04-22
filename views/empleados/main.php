<main class="main">
    <div class="message">
    <!-- <?php echo $this->mensaje; ?> -->
    <!-- <?php var_dump($this->datos); ?> -->
    </div>
    <div class="all-users">
        <div id="top-bar" class="top-bar">
            <h1 class="top-bar__title">Empleados Actualmente</h1>
            <div class="top-bar__buttons">
                <div class="search">
                    <input id="search-text" type="text" placeholder="Search User">
                </div>
                <div class="user-info">
                <a href="<?php echo constant('URL').'empleados/agregarEmpleado'; ?>">                     
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="content__header--producto">
                <input type="checkbox" >
                <p class="content__header--text">Nombre</p>
                <p class="content__header--text">Apellidos</p>
                <p class="content__header--text">Dni</p>
                <p class="content__header--text">Fecha</p>
            </div>
            <div class="content__clientes">    
                    <?php 
                        //include_once 'models/producto.php';
                        foreach($this->datos as $empleado){                                  
                    ?>
                <div id="content__user" class="content__producto" >
                    <p class="content__user--text descripcion" data-name="<?php  echo $empleado->getNombre(); ?>" ><?php echo $empleado->getNombre(); ?> </p>
                    <p class="content__user--text categoria"><?php echo $empleado->getApellido(); ;  ?></p>
                    <p class="content__user--text fecha"><?php echo $empleado->getDni(); ; ?></p>
                    <p class="content__user--text precio"><?php echo $empleado->getFecha(); ;  ?></p>
                    <a href="<?php echo constant('URL').'empleados/agregarCompra/'.$empleado->getId(); ?>"><div class="pedido">Crear Compra</div></a>
                    <div id="options" class="content__producto--options">
                        <a href="<?php echo constant('URL').'empleados/actualizarEmpleado/'.$empleado->getId();; ?>" class="content__user--link edit" id="edit" data-type="hola">
                            <i class="fas fa-pen"></i>
                        </a>
                        <a href="<?php echo constant('URL').'empleados/eliminarEmpleado/'.$empleado->getId();; ?>"  class="content__user--link delete" id="delete">     
                            <i class="fas fa-trash"></i>
                        </a>
                        <a href="<?php echo constant('URL').'empleados/verEmpleado/'.$empleado->getId();; ?>"  class="content__user--link view" id="view">     
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