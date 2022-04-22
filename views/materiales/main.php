<main class="main">
    <div class="message">
    <!-- <?php echo $this->mensaje; ?> -->
    <!-- <?php var_dump($this->datos); ?> -->
    </div>
    <div class="all-users">
        <div id="top-bar" class="top-bar">
            <h1 class="top-bar__title">Materiales Actualmente</h1>
            <div class="top-bar__buttons">
                <div class="search">
                    <input id="search-text" type="text" placeholder="Search User">
                </div>
                <div class="user-info">
                <a href="<?php echo constant('URL').'materiales/agregarMaterial'; ?>">                     
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="content__header--usuario">
                <input type="checkbox" >
                <p class="content__header--text">Descripcion</p>
                <p class="content__header--text">Fecha</p>
                <p class="content__header--text">Precio</p>
            </div>
            <div class="content__clientes">    
                    <?php 
                        //include_once 'models/producto.php';
                        foreach($this->datos as $material){                                  
                    ?>
                <div id="content__user" class="content__user" >
                    <p class="content__user--text nombre" data-name="<?php  echo $material->getDescripcion(); ?>" ><?php echo $material->getDescripcion(); ?> </p>
                    <p class="content__user--text apellido"><?php echo $material->getFecha(); ;  ?></p>
                    <p class="content__user--text email"><?php echo $material->getPrecio(); ; ?></p>
                    <div id="options" class="content__user--options">
                        <a href="<?php echo constant('URL').'materiales/actualizarMaterial/'.$material->getId();; ?>" class="content__user--link edit" id="edit" data-type="hola">
                            <i class="fas fa-pen"></i>
                        </a>
                        <a href="<?php echo constant('URL').'materiales/eliminarMaterial/'.$material->getId();; ?>"  class="content__user--link delete" id="delete">     
                            <i class="fas fa-trash"></i>
                        </a>
                        <a href="<?php echo constant('URL').'materiales/verMaterial/'.$material->getId();; ?>"  class="content__user--link view" id="view">     
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