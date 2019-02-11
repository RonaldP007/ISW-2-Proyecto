<?php
            
            if(!isset($_SESSION['nombre'])){//comprueba si existe el nombre de usuario

                redirect('user/login');
            
            }
                

        ?>        
        
        <!--MENU-->
        <nav id= "menu">
            <?php if($_SESSION['rol'] == "a"){ ?>
                <ul>
                    <li><button class="btn btn-dark" type="button" id="init" name="boton0">Inicio</button></li>
                    <li><button class="btn btn-dark" type="button" id="pro" name="boton1">Crud Productos</button></li>
                    <li><button class="btn btn-dark" type="button" id="cat" name="boton2">Crud Categorias</button></li>
                <ul>
                <?php }else{ ?>
                    <ul>
                        <li><a class="btn btn-dark" href= "#">Inicio</a></li>
                        <li><a href= "<?= base_url('carrito/getCarrito')?>">Carrito</a></li>
                        <li><a href= "<?= base_url('factura/getFacturas') ?>">Facturas</a></li>
                        <li><a href= "<?php echo base_url('productos/venta_Productos');?>">Ver productos</a></li></li>
                    <ul>
            <?php } ?>
        </nav>


        <!--Contenido-->
        <div id= "contenido" > 

            <!--Barra lateral-->
            <aside id= "lateral" > 
                <div id= "login" class="aside">
                    <h3>Bienvenido <?php echo " " . $_SESSION['nombre'];?></h3> 
                    <br/> <br/>
                    <a href = "<?= base_url('user/user_logout') ?>" class="logout"> <img  style='margin-right: 15px;' width='18px' high='18px' src='<?php echo base_url(); ?>/glyph-iconset-master/svg/si-glyph-door.svg'/> Cerrar sesion</a> 
                    <br/> <br/> <br/>
                    <?php 
                        $ci = &get_instance(); //Se crea la instancia hacia a el método que devuelve el súper objeto de CodeIgniter
                        $ci->load->library("cargarcatego");
                    ?> 
                    <?php if($_SESSION['rol'] == 'u'){ ?>
                        <?php $grafico_user = $ci->cargarcatego->estadisUser($_SESSION['cedula']) ?>

                        <div class='tot_estadisticas_u'>
                        <p class='estadisticas'>Estadisticas</p>

                        <p class='totales'>Total de compras: </p>
                        <div class='estadisticas'> <img style='margin-right: 15px;' width='18px' high='18px' src='<?php echo base_url(); ?>/glyph-iconset-master/svg/si-glyph-money-bag.svg'/> ₡<?= $grafico_user[0];?> </div>

                        <p class='totales'>Total de productos comprados: </p>
                        <div class='estadisticas'> <img style='margin-right: 15px;' width='18px' high='18px' src='<?php echo base_url(); ?>/glyph-iconset-master/svg/si-glyph-trolley-2.svg'/><?= $grafico_user[1] ?></div>
                    <?php }else{ ?>
                        <?php
                            $result = $ci->cargarcatego->estadisAdmin();
                        ?>

                        <div class='tot_estadisticas_a'>
                        <p class='estadisticas'>Estadisticas</p>

                        <p class='totales'>Cantidad de Clientes Registrados: </p>
                        <div class='estadisticas'> <img style='margin-right: 15px;' width='18px' high='18px' src='<?php echo base_url(); ?>/glyph-iconset-master/svg/si-glyph-person.svg'/> <?= $result[0] ?> </div>

                        <p class='totales'>Cantidad de productos vendidos: </p>
                        <div class='estadisticas'> <img style='margin-right: 15px;' width='18px' high='18px' src='<?php echo base_url(); ?>/glyph-iconset-master/svg/si-glyph-trolley-arrow-up.svg'/> <?= $result[1] ?> </div> 

                        <p class='totales'>Monto total de ventas: </p>
                        <div class='estadisticas'> ₡ <?= $result[2] ?> </div>
                        </div>
                    <?php } ?>

                </div>
            </aside>

            <!--Contiene la imagen principal-->
            <div id= "img" style="display: flex; justify-content: center; margin-top: 1px; margin-bottom: 1px;">
                <div class="container" style="margin-top: 80px;">
                    <iframe style="background-image:url(<?php echo base_url(); ?>/assets/img/tienda-online.jpg); background-repeat: no-repeat; border: none;" width="700" height="335" scrolling="yes" src="">></iframe>
                </div>
            </div>
            <!--Contenido de la Categorias-->
            <div id= "Categoria" style="display: none;">
                <div class="container" style="display: flex; justify-content: center; margin-top: 1px; margin-bottom: 1px;">
                    <iframe id="catego" frameborder="0" src="<?php echo base_url('categorias/crud_categorias'); ?>" width=999 height=510></iframe>
                </div>
            </div>
            <!--Contenido de los productos-->
            <div id= "Producto" style="display: none;">
                <div class="container" style="display: flex; justify-content: center; margin-top: 1px; margin-bottom: 1px;">
                    <iframe id="produc" frameborder="0" src="<?php echo base_url('productos/crud_productos'); ?>" width=999 height=800></iframe>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script>
                //este es la accion del boton de productos
                $("#pro").on("click", function(){
                    //refresca a el iframe de Categorias             
                    let frame2 = document.getElementById('catego');
                    frame2.src = frame2.src;

                    //muestra el iframe de productos
                    $('#Producto').show(); 
                    //oculta el iframe de categorias
                    $('#Categoria').hide();
                    //oculta el iframe de la imagen principal
                    $('#img').hide(); 
                });
                //este es la accion del boton de categorias 
                $("#cat").on("click", function(){
                    //refresca a el iframe de productos             
                    let frame1 = document.getElementById('produc');
                    frame1.src = frame1.src;
                    
                    //muestra el iframe de Categorias
                    $('#Categoria').show(); 
                    //oculta el iframe de Productos
                    $('#Producto').hide(); 
                    //oculta el iframe de la imagen principal
                    $('#img').hide();
                });
                //este es la accion del boton para llegar de nuevo a el inicio
                $("#init").on("click", function(){
                    //refresca a el iframe de Categorias
                    let frame2 = document.getElementById('catego');
                    frame2.src = frame2.src;

                    //refresca a el iframe de productos             
                    let frame1 = document.getElementById('produc');
                    frame1.src = frame1.src;

                    //Muestra el iframe de la imagen 
                    $('#img').show();
                    //oculta el iframe de Categorias
                    $('#Categoria').hide();
                    //oculta el iframe de Productos
                    $('#Producto').hide();
                });
            </script>

