<?php


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Facturas</title>
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
            <h3 class="panel-title" style="margin-top: 5px;">Facturas</h3>
        </div>

        <div class="panel-body detalle-producto">

          <?php if($facturas != false){?>
            <table class="table">

              <thead>
				<tr>
					<th>ID Vendedor</th>
					<th>Fecha</th>
					<th>Total</th>
					<th></th>
					<th></th>
				</tr>
              </thead>

            	<tbody>

					<?php foreach($facturas as $item){?>
					<tr>

						<td><?php  
							echo $item['id_user'];
						?></td>

						<td><?php 
							echo $item['fecha'];
						?></td>

						<td><?php 
							echo $item['totales'];
						?></td>

						<td><a class="btn btn-sm" href="<?php echo base_url() . "Facturas/get_info_factura/" . $item["id"] ?>">Ver</a></td>

					</tr>
                          
					<?php }?>
                    
                </tr>
              </tbody>
              
            </table>

            <?php }else{?>

            <div class="panel-body"> No hay facturas agregadas</div>

          <?php }?>
        </div>
		  </div>
    </div>
  </body>
</html>
