<?php

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Ventas</title>
	  <link href="<?php echo base_url(); ?>/assets/css/bootstrap.css" rel="stylesheet">
	  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/styles.css">
	  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
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
				<a class="btn btn-danger btnReiniciar" id="btnReiniciar" href="<?php echo base_url() . "Ventas/eliminar_all/" ?>">Cancelar Compra</a>
				<br /><br />
				<a class="btn btn-primary" id="btnPagar" href="<?php //echo base_url() . "Ventas/suma/" . $id ?>">Pagar Contado</a>
				<a class="btn btn-primary" id="btnCredito" href="<?php //echo base_url() . "Ventas/suma/" . $id ?>">Pagar Credito</a>
			</form>

			<br/>
				
			<div class="panel panel-info" style="margin-top: 20px;">

				<div class="panel-heading" style="display: flex; text-align: center;">
					<h3 class="panel-title" style="margin-top: 5px;">Ventas</h3>
				</div>

				<div class="panel-body detalle-producto" id="productos">

					<?php if($productos != false){?>
						<table class="table">

							<thead>
								<tr>
								<th>ID</th>
								<th>Producto</th>
								<th>Precio</th>
								<th>Cantidad</th>
								<th>Total</th>
								</tr>
							</thead>

							<tbody>
								<?php
									$totales = 0;
									
									foreach($productos as $item){?>
										<tr>
											<td>
												<?php  
													$id = $item['id'];
													echo $item['id_producto'];
												?>
											</td>

											<td>
												<?php  
													echo $item['nombre'];
												?>
											</td>

											<td>
												<?php 
													echo "₡". $item['precio'];
												?>
											</td>

											<td>
												<?php  
												echo $item['cantidad'];?>
												<a class="btn btn-sm" href="<?php echo base_url() . "Ventas/suma/" . $id ?>">+</a>
												<a class="btn btn-sm" href="<?php echo base_url() . "Ventas/resta/" . $id ?>" 
													style=
														<?php
															if($item["cantidad"] >1){
															echo "";
															}else{
															echo "display:none";
															}
														?>>
												</a>
											</td>

											<td>
												<?php 
													$total= $item['precio']* $item['cantidad'];
													echo "₡". $total;
													$totales = $totales +$total;
												?>
											</td>

											<td><a class="btn btn-sm btn-danger" href="<?php echo base_url() . "Ventas/eliminar/" . $id ?>"><i class="far fa-trash-alt"></i></a></td>
										</tr>
								<?php }?>
							</tbody>
						</table>

						<p id="total2">Total Final </p>
						<?php echo "<h3 id='total'>". "₡" . $totales; "<h3>"?>
													
						<?php }else{?>

						<div class="panel-body" id="noDatos"> No hay productos agregados</div>

					<?php }?>
				</div>
			</div>
		</div>
		<!-- Scripts de acción al botón -->
		<script>
		
			
		</script>
  </body>
</html>
