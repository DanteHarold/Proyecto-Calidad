<main class="main">
    <div class="message">
    <!-- <?php echo $this->mensaje; ?> -->
    <!-- <?php var_dump($this->datos); ?> -->
    </div>
    <div class="all-users">
        <div id="top-bar" class="top-bar">
            <h1 class="top-bar__title">Productos Actualmente</h1>
            <div class="top-bar__buttons">
                <div class="search">
                    <input id="search-text" type="text" placeholder="Search User">
                </div>
                <div class="user-info">
                    <a href="<?php echo constant('URL').'productos/agregarProducto'; ?>">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="content__header--producto">
                <input type="checkbox" >
                <p class="content__header--text">Descripción</p>
                <p class="content__header--text">Categoria</p>
                <p class="content__header--text">Fecha_Producto</p>
                <p class="content__header--text">Precio</p>
                <p class="content__header--text">Stock</p>
            </div>
            <div class="content__productos">           
                    <?php 
                        //include_once 'models/producto.php';
                        foreach($this->datos as $producto){                                  
                    ?>
                <div id="content__producto" class="content__producto" >
                    <p class="content__user--text descripcion" data-name="<?php  echo $producto->getDescripcion(); ?>" ><?php echo $producto->getDescripcion(); ?> </p>
                    <p class="content__user--text categoria"><?php echo $producto->getCategoria(); ;  ?></p>
                    <p class="content__user--text fecha"><?php echo $producto->getFecha(); ; ?></p>
                    <p class="content__user--text precio"><?php echo $producto->getPrecio(); ;  ?></p>
                    <p class="content__user--text  stock"><?php echo $producto->getStock(); ; ?></p>
                    <div id="options" class="content__producto--options">
                        <a href="<?php echo constant('URL').'productos/actualizarProducto/'.$producto->getId();; ?>" class="content__user--link edit" id="edit" data-type="hola">
                            <i class="fas fa-pen"></i>
                        </a>
                        <a href="<?php echo constant('URL').'productos/eliminarProducto/'.$producto->getId();; ?>"  class="content__user--link delete" id="delete">     
                            <i class="fas fa-trash"></i>
                        </a>
                        <a href="<?php echo constant('URL').'productos/verProducto/'.$producto->getId();; ?>"  class="content__user--link view" id="view">     
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