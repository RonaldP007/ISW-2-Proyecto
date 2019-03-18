<?php

?>

<!DOCTYPE html>
<html lang="en">
  	<head>
    	<title>Ventas</title>
		<link href="<?php echo base_url(); ?>/assets/css/bootstrap.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/styles.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
		<script> let comprueba = false; </script>
	</head>

  <body>
		<div class="container">

			<div>
				<a href="<?= base_url('Usuarios/user_view') ?>">
					<img id="logoSuper" src="<?php echo base_url(); ?>/assets/img/logo_Super.jfif" alt="Logo principal" />
				</a>
			</div>

			<br /> <br /> <br />
			<br /> <br /> <br /> 

			<form method="post" action="<?php echo base_url() . "Ventas/nuevo_registro_p/"?>">
									
				<div class="form-group">
					<input class="form-control" placeholder="Codigo" name="id_producto" type="text" required>
				</div>

				<div class="form-group">
					<input class="form-control" placeholder="Cantidad" name="cantidad" type="text" required>
				</div>

				<button class="btn btn-primary" id="btnEnviar" type="submit">Agregar</button>
				<br /><br />

				<div id="mensaje">
					<?php
						if($this->session->flashdata('msg_error')){
					?>
					<div id="msj" class="alert alert-danger">
						<?php echo $this->session->flashdata('msg_error'); ?>
					</div>
					<?php		
						}
					?>
				</div>

				<a class="btn btn-danger btnReiniciar" id="btnReiniciar" href="<?php echo base_url() . "Ventas/eliminar_all/" ?>">Cancelar Compra</a>
				<br /><br />
				
				<a href="#ex1" rel="modal:open" id="btnCredito" class="btn btn-primary" onclick="btnVerificar()"> Pagar Credito </a>
				<!--<a class="btn btn-primary" id="btnCredito" href="<?php //echo base_url() . "Ventas/suma/" . $id ?>">Pagar Credito</a>-->
			</form>

			<br/>
				
			<div class="panel panel-info" style="margin-top: 20px;">

				<div class="panel-heading" style="display: flex; text-align: center;">
					<h3 class="panel-title" style="margin-top: 5px;">Ventas</h3>
				</div>

				<div class="panel-body detalle-producto" id="productos">

					<?php if($productos != false){?>
						<script> comprueba = true; </script>
						<table class="table">

							<?php 
								
								$id_producto_array = array();
								$nombre_array = array();
								$cantidad_array = array();
								$precio_array = array();
								$subtotal_array = array();
									
							?> 

							<thead>
								<tr>
								<th>ID</th>
								<th>Producto</th>
								<th>Precio</th>
								<th>Cantidad</th>
								<th>SubTotal</th>
								</tr>
							</thead>

							<script> 
								let id_producto = []; 
								let nombre_pro = [];
								let precio_pro = [];
								let cantidad_pro = [];
								let subtotal_pro = [];
								let total_pro = [];
								let contador = 0;
							</script>

							<tbody>
								<?php
									$totales = 0;
									
									foreach($productos as $item){?>
										<tr>
											<td>
												<?php  
													$id = $item['id'];
													echo $item['id_producto'];
													$id_producto_array[] =  $item['id_producto'];
												?>
												<script> 
													id_producto[contador] = <?php echo $item["id_producto"];?>; 
												</script>
											</td>

											<td>
												<?php  
													echo $item['nombre'];
													$nombre_array[] = $item["nombre"];
												?>
												<script> 
													nombre_pro[contador] = "<?php echo $item["nombre"];?>"; 
												</script>
											</td>

											<td>
												<?php 
													echo "₡". $item['precio'];
													$precio_array[] =  $item["precio"];
												?>
												<script> 
													precio_pro[contador] = <?php echo $item["precio"];?>; 
												</script>
											</td>

											<td>
												<?php  
													echo $item['cantidad'];
													$cantidad_array[] =  $item["cantidad"];
												?>
												<script> 
													cantidad_pro[contador] = <?php echo $item["cantidad"];?>; 
												</script>

												<a class="btn btn-sm" href="<?php echo base_url() . "Ventas/suma/" . $id ?>">+</a>
												<a class="btn btn-sm" href="<?php echo base_url() . "Ventas/resta/" . $id ?>" 
													style=
														<?php
															if($item["cantidad"] >1){
															echo "";
															}else{
															echo "display:none";
															}
														?>>-
												</a>
											</td>

											<td>
												<?php 
													$total= $item['precio']* $item['cantidad'];
													echo "₡". $total;
													$subtotal_array[] =  $total;
													$totales = $totales +$total;
												?>
												<script> 
													subtotal_pro[contador] = <?php echo $total;?>; 
													total_pro = <?php echo $totales;?>;
												</script>
												
											</td>

											<td><a class="btn btn-sm btn-danger" href="<?php echo base_url() . "Ventas/eliminar/" . $id ?>"><i class="far fa-trash-alt"></i></a></td>
											<script>
												contador = contador + 1; 
											</script>
										</tr>
								<?php }?>

								<?php
									$matriz = [$id_producto_array, $nombre_array, $cantidad_array, $precio_array, $subtotal_array,$totales];
									$array_url = serialize($matriz);
									$array_url = urlencode($array_url);  
								?> 

								<!--<script> 
									//let producto = ;
									let datos1 = new array(<?php// print_r($id_producto_array);?>); 
								</script> -->

								<a class="btn btn-primary" id="btnPagar"  href="<?php echo base_url() . "Ventas/comprar/" . $array_url?>">Pagar Contado</a> 

							</tbody>
						</table>

						<p id="total2">Total Final </p>
						<?php echo "<h3 id='total'>". "₡" . $totales; "<h3>"?>
													
						<?php }else{?>

						<div class="panel-body" id="noDatos"> No hay productos agregados</div>

					<?php }?>
				</div>

				<!-- Este es el modal generado por jQuery-->
				<div id="ex1" class="modal" style="width: 40%;">
					<div class="modal-content" style="height: 55ex;">
						<div class="modal-header" style=" background-color: rgb(241, 196, 15);">
							<h5 class="modal-title" id="verificarAdminLabel">Pagar a Credito</h5>
							<a  id="btnCerrar" href="#" rel="modal:close"><i class="fas fa-times"></i></a>
						</div>
						<div class="modal-body" style="margin-top: 5%;">
							<form action="#" method="post">
								<div id="mensaje2">
									<div id="msj2" style="display: none;" class="alert alert-danger">
										
									</div>
								</div>
								<div class="form-group">
									<label for="idUser">Cedula Usuario</label>
									<input class="form-control" type="number" name="idUser" id="idUser" required>
								</div>
								<div class="form-group" id="div_monto" style="display: none;">
									<label for="montoCredito">Digite el monto a creditar</label>
									<input class="form-control" type="number" name="montoCredito" id="montoCredito" required>
								</div>
								<button style="margin-top: 5%; width: 15%; display: none;" id="chequearAdmin" type="button" class="btn btn-primary" onclick="verficarUsuario()">Verificar</button>
								<button style="margin-top: 5%; width: 20%; display: none;" id="guardarCompra" type="button" class="btn btn-primary" onclick="registrarCompra()">Registrar Credito</button>
							</form>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<!--booststrap-->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<!--Este script es para que oculte el mensaje de error numero 1 de cuando el producto no existe-->
		<script type="text/javascript">
			$(document).ready(function() {
				setTimeout(function() {
					$("#msj").fadeOut(1500);
				},3000);
			});
		</script>
		<!--Ajax-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
		<!-- jQuery Modal -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
		<!--Este script es para el modal-->
		<script>
			//variables
			let fiador;
			let user;
			let monto;
			let iduser;
			let limite;
			let tipo_mjs;
			let borrar;
			let estado_credito;

			function btnVerificar() {
				$("#chequearAdmin").show();
				//oculta el div donde se digita el monto a fiar
				$("#div_monto").hide();
				//oculta el boton de registro credito
				$("#guardarCompra").hide();
				//coloca el valor en blanco
				$("#idUser").val('');
			}

			function CierraModal() {
				//cierra el modal que es generado por jQuery
				//esta es la clase del div la cual contiene todo el modal
				//para saber donde aparece esta clase debe ir al navegador y entrar a esta pagina y inspeccionar y la vera
				$('.jquery-modal').hide();
			}

			//esta funcion sirve para validar si existe el cliente.
			function verficarUsuario() {
				iduser = jQuery('#idUser').val();

				if(iduser != ""){
					jQuery.ajax({
						type: "post",
						url: '<?php echo base_url(); ?>' + 'Creditos/comprobarCreditos',
						data:{id:iduser},
						success: function(data){
							estado_credito = "";
							estado_credito = data[0];
							console.log(estado_credito);
						}
					})
					//falta corregir
					if(estado_credito != "r"){
						mensaje("El cliente tiene un credito aprobado, debe pagar para obtene uno nuevo.")
						estado_credito = "";
					}else{
						jQuery.ajax({
							type: "post",
							url: '<?php echo base_url();?>' + 'Clientes/verificarCliente',
							data:{id:iduser},
							success: function(data){
								fiador = data[0];//obtengo el valor del fiador
								if(fiador != "" && fiador != null && fiador != "f"){
									//console.log(fiador);
									$(".form-group").show();
									$("#guardarCompra").show();
									$("#chequearAdmin").hide();
								}
								if(fiador == "f"){
									mensaje("No existe el usuario.")
								}
							}
						})
					}
				}
			}

			function registrarCompra() {
				user = jQuery('#idUser').val();
				monto = jQuery('#montoCredito').val();
				//console.log(user);
				if(comprueba){
					if(user != "" && monto != ""){
						if(fiador == "0"){
							limite = monto <= 20000; 
							tipo_mjs = "sin";
						}else{
							limite = monto >= 5;
							tipo_mjs = "con";
						}

						if(limite){
							if(monto > 0 && monto <= total_pro){
								jQuery.ajax({
									type: "post",
									url: '<?php echo base_url() . 'Creditos/guardarCredito'?>',
									data: {
										user: user,
										monto1: monto, 
										id_producto1: id_producto,
										nombre_pro1: nombre_pro,
										precio_pro1: precio_pro,
										cantidad_pro1: cantidad_pro,
										subtotal_pro1: subtotal_pro,
										total_pro1: total_pro
									},
									success: function(data){
										$("#idUser").val('');
										$("#montoCredito").val('');
										CierraModal();
										location.reload();
									}
								})
							}else{
								mensaje("El monto no puede superar el total de la compra ni ser ₡0.");
							}
						}else{
							if(tipo_mjs == "con"){
								mensaje("El monto debe ser mayor o igual a los ₡5");
							}
							else{
								mensaje("El monto debe ser menor o igual a los ₡20.000");
							}
							
						}

					}else{
						mensaje("Debe completar los dos campos.");
					}
				}else{
					mensaje("Debe agregar productos a la tabla.");
				}
			}

			//esta funcion es para notificar los errores
			function mensaje(msj) {
				$("#msj2").show();
				$("#msj2").html(msj);

				setTimeout(function() {
					$("#msj2").fadeOut(1500);
				},3000);
			}
		</script>
  </body>
</html>
