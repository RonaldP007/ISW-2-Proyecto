        <?php
        
        if(!isset($_SESSION['nombre'])){//comprueba si existe el nombre de usuario

            redirect('Usuarios/login');
        
        }
                
        ?>        

        <!--MENU-->
        <nav id= "menu">
            <?php if($_SESSION['rol'] == "a"){ ?>
                <ul>
					<li><a href= "<?= base_url('Usuarios/getUsuarios')?>">Usuarios</a></li>
					<li><a href= "<?= base_url('Clientes/getClientes')?>">Clientes</a></li>
					<li><a href= "<?= base_url('Proveedores/getProveedores') ?>">Proveedores</a></li>
					<li><a href= "<?= base_url('Productos/getProductos') ?>">Productos</a></li>
					<li><a href= "<?php echo base_url('Fiadores/getFiadores');?>">Fiadores</a></li>
                    <li><a href= "<?php echo base_url('Cuentas_pagar/getCuentas_pagar');?>">Cuentas</a></li>
					<li><a href= "<?php echo base_url('Facturas/index');?>">Facturas</a></li>
                <ul>
                <?php }else{ ?>
                    <ul>
                    <li><a href= "<?= base_url('Clientes/getClientes')?>">Clientes</a></li>
                    <li><a href= "<?= base_url('Productos/getProductos') ?>">Productos</a></li>
					<li><a href= "<?php echo base_url('Fiadores/getFiadores');?>">Fiadores</a></li></li>
					<li><a href= "<?= base_url('Ventas/index')?>">Ventas</a></li>
                    <ul>
            <?php } ?>
        </nav>


        <!--Contenido-->
        <div id= "contenido" > 

            <!--Barra lateral-->
            <aside id= "lateral" > 
                <div id= "login" class="aside">
                    <h3 id="bienvenida" >Bienvenido <?php echo " " . $_SESSION['nombre'];?></h3> 

                    <?php if($_SESSION['rol'] == 'u') :?> 
                        <!--Llama a el modal-->
                        <a href="#ex1" rel="modal:open" type="button" class="btn btn-primary btnCloseCaja"> Cerrar Caja </a>
                    <?php endif; ?>
                        <!--Cierra la seccion-->
                    <a id="btnCerrarSesion" href = "<?= base_url('Usuarios/user_logout') ?>" class="btn btn-primary logout">Sign out  <i class="fas fa-sign-out-alt"></i></a> 
                    
                    <?php if($_SESSION['rol'] == 'u'){ ?> 
                        
                    <?php }else{ ?>
                        <?php
                          
                        ?>
                    <?php } ?>

                    <!-- Link to open the modal 
                    <p><a href="#ex1" rel="modal:open">Open Modal</a></p> -->
                    <!-- Este es el modal generado por jQuery     class="close-modal"-->

                    <div id="ex1" class="modal">
                        <div class="modal-content">
                            <div class="modal-header" style=" background-color: rgb(241, 196, 15);">
                                <h5 class="modal-title" id="verificarAdminLabel">Cerrar Caja</h5>
                                <a  id="btnCerrar" href="#" rel="modal:close"><i class="fas fa-times"></i></a>
                            </div>
                            <div class="modal-body">
                                <form action="#" method="post">
                                    <div class="form-group">
                                        <label for="constraseñaAdmin">Constraseña Administrador</label>
                                        <input class="form-control" type="password" name="passwordAdmin" id="passwordAdmin">
                                    </div>
                                    <button id="chequearAdmin" type="button" class="btn btn-primary" onclick="verficarAdmin()">Aceptar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <script>

                function CierraModal(){
                    //cierra el modal que es generado por jQuery
                    //esta es la clase del div la cual contiene todo el modal
                    //para saber donde aparece esta clase debe ir al navegador y entrar a esta pagina y inspeccionar y la vera
                    $('.jquery-modal').hide();
                }

                function verficarAdmin(){
                    let pass = jQuery('#passwordAdmin').val();
                    console.log(pass);

                    jQuery.ajax({
                        type: "POST",
                        url: '<?php echo base_url();?>' + 'Usuarios/validarAdmin',
                        data: {pass: pass},
                        success: function(data){
                            console.log(data);
                        }
                    });

                    $("#passwordAdmin").val('');
                    CierraModal();
                }
            </script>
        </div>
        
        