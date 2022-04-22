<main class="main">
    <div class="message">
    <!-- <?php echo $this->mensaje; ?> -->
    <!-- <?php var_dump($this->datos); ?> -->
    </div>
    <div class="all-users">
        <div id="top-bar" class="top-bar">
            <h1 class="top-bar__title">Usuarios Actualmente</h1>
            <div class="top-bar__buttons">
                <div class="search">
                    <input id="search-text" type="text" placeholder="Search User">
                </div>
                <div class="user-info">
                <a href="<?php echo constant('URL').'usuarios/agregarUsuario'; ?>">                     
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="content__header--usuario">
                <input type="checkbox" >
                <p class="content__header--text">Nombre</p>
                <p class="content__header--text">Apellido</p>
                <p class="content__header--text">Correo</p>
            </div>
            <div class="content__users">    
                    <?php 
                        //include_once 'models/producto.php';
                        foreach($this->datos as $usuario){                                  
                    ?>
                <div id="content__user" class="content__user" >
                    <p class="content__user--text nombre" data-name="<?php  echo $usuario->getNombre(); ?>" ><?php echo $usuario->getNombre(); ?> </p>
                    <p class="content__user--text apellido"><?php echo $usuario->getApellido(); ;  ?></p>
                    <p class="content__user--text email "><?php echo $usuario->getEmail(); ; ?></p>
                    <div id="options" class="content__user--options">
                        <a href="<?php echo constant('URL').'usuarios/actualizarUsuario/'.$usuario->getId();; ?>" class="content__user--link edit" id="edit" data-type="hola">
                            <i class="fas fa-pen"></i>
                        </a>
                        <a href="<?php echo constant('URL').'usuarios/eliminarUsuario/'.$usuario->getId();; ?>"  class="content__user--link delete" id="delete">     
                            <i class="fas fa-trash"></i>
                        </a>
                        <a href="<?php echo constant('URL').'usuarios/verUsuario/'.$usuario->getId();; ?>"  class="content__user--link view" id="view">     
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