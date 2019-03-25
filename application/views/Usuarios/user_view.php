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
                    <li><a href= "<?php echo base_url('Creditos/fact_credito');?>">Facturas Creditos</a></li>  
					
                <ul>
                <?php }else{ ?>
                    <ul>
                    <li><a href= "<?= base_url('Clientes/getClientes')?>">Clientes</a></li>
                    <li><a href= "<?= base_url('Productos/getProductos') ?>">Productos</a></li>
                    <li><a href= "<?php echo base_url('Fiadores/getFiadores');?>">Fiadores</a></li></li>
                    <li><a href= "<?php echo base_url('Creditos/fact_credito');?>">Facturas Creditos</a></li>
                    <?php if($_SESSION['caja'] == "1"): ?>
                        <li><a href= "<?= base_url('Ventas/index')?>">Ventas</a></li>
                    <?php else : ?>
                        <li><a href= "#" onclick="mensaje()">Ventas</a></li>
                    <?php endif ?>
                    <ul>
            <?php } ?>
        </nav>

        <script>
            //es para notificar a el usuario de no tiene acceso a ventas
            function mensaje() {
                swal({
                    title: "No tiene acceso a ventas.",
                    text: "Has click en el boton.",
                    icon: "warning",
                    button: "OK",
                });
            }
        </script>

        <!--Contenido-->
        <div id= "contenido" > 

            <!--Barra lateral-->
            <aside id= "lateral" > 
                <div id= "login" class="aside">
                    <h3 id="bienvenida" >Bienvenido <?php echo " " . $_SESSION['nombre'];?></h3> 

                    <?php if($_SESSION['rol'] == 'u' && $_SESSION['caja'] == "1") :?> 
                        <!--Llama a el modal-->
                        <a href="#ex1" rel="modal:open" type="button" class="btn btn-primary btnCloseCaja"> Cerrar Caja </a>
                    <?php endif; ?>
                        <!--Cierra la seccion-->
                    <a id="btnCerrarSesion" href = "<?= base_url('Usuarios/user_logout') ?>" class="btn btn-primary logout">Sign out  <i class="fas fa-sign-out-alt"></i></a> 
                    
                    <?php if($_SESSION['rol'] == 'u'){ ?> 
                        
                    <?php }else{ ?>
                        
						<div class="">

							<?php if(!isset($info)){

							}else{


								if($info == 0){
									
								echo '<p>'. "No tiene pagos proximos con los proveedores" .'</p>';
								//var_dump($info);
								}

								if($info == 1){
									
									echo '<p>'. "Se acerca el pago de ". $info. " cuenta pendiente con un proveedor" .'</p>';
								
								}
								
								if($info > 1){
									
									echo '<p>'. "Se acerca el pago de ". $info. " cuentas pendientes con los proveedores" .'</p>';
									
								}
							}?>
						</div>
                       
                    <?php } ?>

                    <div id="ex1" class="modal">
                        <div class="modal-content">
                            <div class="modal-header" style=" background-color: rgb(241, 196, 15);">
                                <h5 class="modal-title" id="verificarAdminLabel">Cerrar Caja</h5>
                                <a  id="btnCerrar" href="#" rel="modal:close"><i class="fas fa-times"></i></a>
                            </div>
                            <div class="modal-body">
                                <form action="#" method="post">
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Administrador" type="password" name="Admin" id="Admin">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Constraseña" type="password" name="passwordAdmin" id="passwordAdmin">
                                    </div>
                                    <input type="hidden" id="usuario" value="<?php echo $_SESSION['cedula']; ?>">
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
                    let admin = jQuery('#Admin').val();
                    let pass = jQuery('#passwordAdmin').val();
                    let usuario = jQuery('#usuario').val();

                    if(admin != "" && admin != null && pass != "" && pass != null){
                        jQuery.ajax({
                            type: "POST",
                            url: '<?php echo base_url();?>' + 'Usuarios/cambioCaja',
                            data: {admin: admin, pass: pass, usuario: usuario},
                            success: function(data){
                                console.log(data);
                                let valor = data;

                                switch (valor){
                                    case "fail_user":
                                        mensajes("Error Usuario.", "error");
                                        break;
                                    case "admin":
                                        mensajes("Solo Administrador.", "info");
                                        break;
                                    case "change_failure":
                                        mensajes("Fallo Cierre.", "warning");
                                        break;
                                    default: 
                                        valor = "";
                                        location.reload();
                                }
                            }
                        });

                        $("#Admin").val('');
                        $("#passwordAdmin").val('');
                        CierraModal();
                    }
                    else{
                        CierraModal();
                        mensajes("Llenar los campos.", "warning");
                    }
                }

                function mensajes(title2, icon2) {
                    swal({
                        title: title2,
                        text: "Has click en el boton.",
                        icon: icon2,
                        button: "OK",
                    });
                }
                
            </script>
        </div>
        
        