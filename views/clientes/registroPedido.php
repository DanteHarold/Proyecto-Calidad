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
        <form action="<?php echo constant('URL') ?>pedidos/registrarPedido" id="form-modal" class="form" method="POST">
            <h2 class="form__title"><?php echo $this->mensaje; ?></h2>
            <div class="form__content">
                <div class="form__field form__field-50">
                    <label class="form__label">Cliente: </label>
                    <input type="list"  value="<?php echo $cliente->getNombre().'-'.$cliente->getId(); ?>" name="cliente" class="form__input">
                </div>
                <div class="form__field form__field-50">
                    <label for="name" class="form__label">Vendedor: </label>
                    <!-- <input type="text" id="form-name"  name="name" class="form__input"> -->
                    <input type="list" list="empleados" name ="empleado" autocomplete = "off">
                    <datalist id="empleados">
                        <?php 
                            //include_once 'models/producto.php';
                            foreach($this->datosEmpleados as $empleado){                                  
                        ?>
                        <option value="<?php echo $empleado->getNombre().'-'.$empleado->getId(); ?>"><?php echo $empleado->getNombre().'-'.$empleado->getId(); ?></option>
                        <?php } ?>
                    </datalist>
                </div>
                <div class="form__field form__field-50">
                    <label for="locales" class="form__label">Local: </label>
                    <!-- <input type="text" id="form-surname"  name="surname" required class="form__input"> -->
                    <input  type="list" list="locales" name ="local" autocomplete = "off">
                    <datalist id="locales">
                        <?php 
                            //include_once 'models/producto.php';
                            foreach($this->datosLocales as $local){                                  
                        ?>
                        <option value="<?php echo $local->getNombre().'-'.$local->getId(); ?>"></option>
                        <?php } ?>
                    </datalist>
                </div>
                <div class="form__field form__field-50">
                    <label for="surname" class="form__label">Fecha: </label>
                    <input type="list" name ="fecha">
                </div>
                <div class="form__field form__field-100">
                    <label for="email" class="form__label">Producto-Código: </label>
                    <!-- <input type="text" id="form-email"  name="dni"  required class="form__input"> -->
                    <input id="datalist-id" type="list"  list="productos" name ="producto" autocomplete = "off">
                    <datalist id="productos">
                        <?php 
                            //include_once 'models/producto.php';
                            foreach($this->datosProductos as $producto){                              
                        ?>                             
                        <option  data-name="<?php echo $producto->getId(); ?>" value="<?php echo $producto->getDescripcion().'-'.$producto->getId(); ?>"><?php echo $producto->getDescripcion().'-'.$producto->getId();; ?></option>
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
                        <input type="submit" value="Registrar Pedido"  class="form__submit">
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
 
            const path = ('https://sistemacalidad-php.herokuapp.com/clientes/verificarPedido/'+id)

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
                        
                        //CONVERTIR A JSON
                        // console.log(JSON.stringify(data));
                        /*
                        const fragment = document.createDocumentFragment();

                        let userPedido = document.createElement('DIV')
                        userPedido.classList.add('content-pedido__pedido')
                        userPedido.id = 'content__pedido'

                        let userNombreP = document.createElement('P')
                        userNombreP.classList.add('content__user--text','nombreP')
                        userNombreP.textContent = data.descripcion
                        userPedido.appendChild(userNombreP)


                        let userPrecioP = document.createElement('P')
                        userPrecioP.classList.add('content__user--text','precioP')
                        userPrecioP.textContent = data.precio
                        userPedido.appendChild(userPrecioP)


                        let userCantidadP = document.createElement('P')
                        userCantidadP.classList.add('content__user--text','cantidadP')
                        
                       

                        let userInputCantidad = document.createElement('INPUT')
                        userInputCantidad.setAttribute('type','number')
                        userInputCantidad.setAttribute('class','form__input')
                        userCantidadP.appendChild(userInputCantidad)
                        userPedido.appendChild(userCantidadP)


                        let userTotalP = document.createElement('P')
                        userTotalP.classList.add('content__user--text','totalP')

                        
                        let userInputTotal = document.createElement('INPUT')
                        userInputTotal.setAttribute('type','text')
                        userInputTotal.setAttribute('class','form__input')
                        userTotalP.appendChild(userInputTotal)
                        userPedido.appendChild(userTotalP)


                        
                        let userPedidoOptions = document.createElement('DIV')
                        userPedidoOptions.classList.add('content-pedido__pedido--options')
                        userPedidoOptions.id = 'options'
                        
                        
                        let userPedidoLink = document.createElement('a')
                        userPedidoLink.classList.add('content__user--link','delete')
                        userPedidoLink.id = 'delete'

                        let buttonIcon = document.createElement('I')
                        buttonIcon.classList.add('fas','fa-trash')
                        buttonIcon.id = 'deleteP'
                        

                        userPedidoLink.appendChild(buttonIcon)
                        userPedidoOptions.appendChild(userPedidoLink)
                        userPedido.appendChild(userPedidoOptions)
                        
                       
                        fragment.appendChild(userPedido)
                        
                        pedidos.appendChild(fragment)
                        */
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
