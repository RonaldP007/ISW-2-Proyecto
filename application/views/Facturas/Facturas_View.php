<?php


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Facturas</title>
	  <!--<link href="<?php //echo base_url(); ?>/assets/css/bootstrap.css" rel="stylesheet">-->
	  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
        
        <div class="panel-heading" style="display: flex; text-align: center; background-color: #d9edf7;">
            <h3 class="panel-title" style="margin-top: 5px; font-size: 150%; color: #31708f;">Facturas</h3>
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
							echo "₡" . $item['totales'];
						?></td>

						<td><a class="btn btn-secondary" href="<?php echo base_url() . "Facturas/get_info_factura/" . $item["id"] ?>">Ver</a></td>

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
