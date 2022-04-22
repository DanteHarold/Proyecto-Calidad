<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/styles.css">
</head>
<body>
    <?php require_once 'views/header.php';?>
    <?php require_once 'views/sidebar.php';?>
    <?php require_once 'main.php'; ?>
    <div id="modal" class="lightBox lightBox--show">
        <form action="<?php echo constant('URL') ?>compras/registrarCompra" id="form-modal" class="form" method="POST">
            <h2 class="form__title"><?php echo $this->mensaje; ?></h2>
            <div class="form__content">
                <div class="form__field form__field-50">
                    <label class="form__label">Empleado: </label>
                    <input type="list"  value="<?php echo $empleado->getNombre().'-'.$empleado->getId(); ?>" name="empleado" class="form-input">
                </div>
                <div class="form__field form__field-50">
                    <label for="name" class="form__label">Proveedor: </label>
                    <!-- <input type="text" id="form-name"  name="name" class="form__input"> -->
                    <input type="list" list="empleados" name ="proveedor" autocomplete = "off" class="form__input">
                    <datalist id="empleados">
                        <?php 
                            //include_once 'models/producto.php';
                            foreach($this->datosProveedores as $proveedor){                                  
                        ?>
                        <option value="<?php echo $proveedor->getNombre().'-'.$proveedor->getId(); ?>"><?php echo $proveedor->getNombre().'-'.$proveedor->getId(); ?></option>
                        <?php } ?>
                    </datalist>
                </div>
                <div class="form__field form__field-50">
                    <label for="surname" class="form__label">Fecha: </label>
                    <input type="list" name ="fecha" class="form__input">
                </div>
                <div class="form__field form__field-50">
                    <label for="locales" class="form__label">Material: </label>
                    <!-- <input type="text" id="form-surname"  name="surname" required class="form__input"> -->
                    <input id="datalist-id" type="list" list="locales" name ="material" autocomplete = "off" class="form__input">
                    <datalist id="locales">
                        <?php 
                            //include_once 'models/producto.php';
                            foreach($this->datosMateriales as $material){                                  
                        ?>
                        <option value="<?php echo $material->getDescripcion().'-'.$material->getId(); ?>"></option>
                        <?php } ?>
                    </datalist>
                </div>    
                <div id = "agregar" class="btn-agregar">
                        <p>Agregar</p>
                </div>              
                <div class="content-pedido">
                        <div class="content-pedido__header--pedido">
                            <p class="content-pedido__header--text">Descripcion</p>
                            <p class="content-pedido__header--text">Precio</p>
                            <p class="content-pedido__header--text">Cantidad</p>
                            <p class="content-pedido__header--text">Total</p>
                        </div>
                        <div id="content-pedido__pedidos"class="content-pedido__pedidos">  
                                <div id="content__pedido"   class="content-pedido__pedido" >
                                    <p id="nombreP" class="content__user--text nombreP" style="display:none" data-name="" ></p>
                                    <p id="precioP" class="content__user--text precioP" style="display:none"></p>
                                    <p id="cantidadP" class="content__user--text cantidadP" style="display:none">                                 
                                            <input type="number" id="form-cantidad" name="cantidad" required class="form__input">                                   
                                    </p>
                                    <p id="totalP" class="content__user--text totalP" style="display:none">    
                                            <input type="number" id="form-total" name="total" required class="form__input"> 
                                    </p>
                                    <div  class="content-pedido__pedido--options" >
                                            <a d="options"  href="#" class="content__user--link delete" id="deleteP" >     
                                                <i i class="fas fa-trash"></i>
                                            </a>
                                    </div>
                                </div>
                        </div>    
                </div>   
                                           
                <div class="form__field form__field-pedido">
                        <input type="submit" value="Registrar Compra"  class="form__submit">
                </div>
                
        </form>
    </div>
    <?php require_once 'views/footer.php';?>
    <!-- <h1>Esta es la Vista de Main</h1> -->
    <script src="<?php echo constant('URL'); ?>public/js/scripts.js"></script>
</body>
</html>
<script>
        let valor = document.getElementById('datalist-id');
        let btn = document.getElementById('agregar');
        let pedidos = document.getElementById('content-pedido__pedidos')

        let nombreP = document.getElementById('nombreP')
        let precioP = document.getElementById('precioP')
        let cantidadP = document.getElementById('cantidadP')
        let totalP = document.getElementById('totalP')
        let options = document.getElementById('options')

        let formCantidad = document.getElementById('form-cantidad')
        let formTotal = document.getElementById('form-total')

        let locales = document.getElementById('locales')
        
        for (let index = 0; index < locales.length; index++) {
            locales.children[index].remove()
            console.log("o");
        }

        btn.addEventListener('click',()=>{

            let id = valor.value.substring(valor.value.lastIndexOf('-')+1)
 
            const path = ('https://sistemacalidad-php.herokuapp.com/empleados/verificarCompra/'+id)

            fetch(path)
                .then(response => (response.ok) ? Promise.resolve(response) : Promise.reject(new Error("Fail To Load")))
                .then(response => response.json())
                .then(data =>{                   
                        console.log(data.id);
                        console.log(data.descripcion);
                        console.log(data.precio);

                        nombreP.style.display=''
                        nombreP.textContent = data.descripcion
                        precioP.style.display=''
                        precioP.textContent = data.precio
                        cantidadP.style.display=''
                        formCantidad.value = 1
                        
                        totalP.style.display=''
                        totalP.textContent = data.precio
                        options.style.display=''
                })
                .catch((error) => console.log(`Error : ${error.message}`))             

        })
        const borrar = document.getElementById('deleteP')
        if(borrar){
            console.log("RED");
            borrar.addEventListener('click',()=>{
                nombreP.style.display=''
                        nombreP.style.display='none'
                        precioP.style.display='none'
                        cantidadP.style.display='none'
                        totalP.style.display='none'
                        options.style.display='none'
            })
        }

        if(formCantidad){
            formCantidad.addEventListener('input',()=>{
                console.log("holaForm");
                console.log(formCantidad.value);
                totalP.textContent = formCantidad.value*precioP.textContent
                totalP.value = formCantidad.value*precioP.textContent;
                console.log(totalP.value);
                console.log(formCantidad.value*precioP.textContent);
            })
        }
</script>
