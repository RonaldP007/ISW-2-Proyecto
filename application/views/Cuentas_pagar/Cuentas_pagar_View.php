<?php


?>

<!DOCTYPE html>
<html lang="en"> 
  <head>
    <title>Cuentas a proveedores</title>
	  <link href="<?php echo base_url(); ?>/assets/css/bootstrap.css" rel="stylesheet">
	  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/styles.css">
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
      
      <div class="panel panel-info" style="margin-top: 20px;">

        <div class="panel-heading" style="display: flex; text-align: center;">
            <h3 class="panel-title" style="margin-top: 5px;">Pagos a Proveedores</h3>
            <a id="btnAdd" style="margin-left: 80%;" class="new btn btn-sm btn-primary" href="<?= base_url('Cuentas_pagar/registro') ?>">Agregar</a>
        </div>

        <div class="panel-body detalle-producto">

          <?php if($Cuentas_pagar != false){?>
            <table class="table">

              <thead>
                <tr>
				  				<th>Numero de factura</th>
                  <th>Proveedor</th>
                  <th>Monto</th>
                  <th>Fecha Pago</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

              <tbody>
                	<?php
                	
						foreach($Cuentas_pagar as $item){?>
								
							<tr>
								<?php  
									$id = $item['id'];
								?>

								<td><?php  
									echo $item['numero_factura'];
								?></td>

								<td><?php  
									echo $item['nombre_pv'];
								?></td>

								<td><?php 
									echo $item['monto'];
								?></td>

								<td><?php 
										echo $item['fecha_pago'];
								?></td>
								<td><a class="btn btn-sm btn-info" href="<?php echo base_url() . "Cuentas_pagar/cuenta/" . $id?>">Editar</a></td>
								<td><a class="btn btn-sm btn-danger" href="<?php echo base_url() . "Cuentas_pagar/eliminar/" . $id?>">Eliminar</a></td>

							</tr>
						
					<?php }?>
              </tbody>
              
            </table>
										
            <?php }else{?>

            <div class="panel-body"> No hay pagos a realizar agregados</div>

          <?php }?>
        </div>
		  </div>
    </div>
  </body>
</html>
