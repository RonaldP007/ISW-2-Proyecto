<?php


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Fiadores</title>
	  <link href="<?php echo base_url(); ?>/assets/css/bootstrap.css" rel="stylesheet">
	  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/styles.css">
  </head>

  <body>
    <div class="container">

      <div id="logo">
        <img src="<?php echo base_url(); ?>/assets/img/logo.png" alt="Logo principal" />
        <a href= "<?= base_url('Usuarios/user_view') ?>"> Super Unisol</a>
      </div>

      <br /> <br /> <br />
      <br /> <br /> <br />

      <div class="panel panel-info">
        
        <div class="panel-heading">
            <h3 class="panel-title">Fiadores</h3>
        </div>

        <div class="panel-body detalle-producto">

          <?php if($fiadores != false){?>
            <table class="table">

              <thead>
                <tr>
				  				<th>Cedula</th>
                  <th>Nombre</th>
									<th>Apellidos</th>
									<th>Telefono</th>
                  <th>Direccion</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

            	<tbody>

					<?php foreach($fiadores as $item){?>
					<tr>
						<?php 
						$cedula = $item['cedula'];           
						?>

						<td><?php  
							echo $item['cedula'];
						?></td>

						<td><?php 
						echo $item['nombre'];
						?></td>

						<td><?php 
							echo $item['apellidos'];
						?></td>

						<td><?php 	
							echo $item['telefono']; 
						?></td>

						<td><?php 
							echo $item['direccion'];
						?></td>

						<td><a class="btn btn-sm btn-info" href="<?php echo base_url() . "Fiadores/Fiador/" . $cedula?>">Editar</a></td>
						<td><a class="btn btn-sm btn-danger" href="<?php echo base_url() . "Fiadores/eliminar/" . $cedula?>">Eliminar</a></td>

					</tr>
                          
					<?php }?>
                    
                </tr>
              </tbody>
              
            </table>

            <?php }else{?>

            <div class="panel-body"> No hay fiadores agregados</div>

          <?php }?>
        </div>
		  </div>
    </div>

		<a class="new btn btn-sm btn-primary" href="<?= base_url('Fiadores/registro') ?>">Agregar</a>

  </body>
</html>
