<div id="modal" class="lightBox">
    <form action="<?php echo constant('URL') ?>productos/registrarProducto" id="form-modal" class="form" method="POST">
        <h2 class="form__title">Agregar Productos</h2>
        <div class="form__content">
            <div class="form__field">
                <label for="name" class="form__label">Nombre</label>
                <input type="text" id="form-name" name="name" required class="form__input">
            </div>
            <div class="form__field">
                <label for="surname" class="form__label">Apellidos</label>
                <input type="text" id="form-surname" name="surname" required class="form__input">
            </div>
            <div class="form__field">
                <label for="email" class="form__label">Correo</label>
                <input type="email" id="form-email" name="email" required class="form__input">
            </div>
            <div class="form__field">
                <input type="submit" value="Enviar" class="form__submit">
            </div>
        </div>  
    </form>
</div>