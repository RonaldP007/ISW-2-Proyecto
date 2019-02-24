<?php


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Clientes</title>
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
            <h3 class="panel-title" style="margin-top: 5px;">Proveedores</h3>
            <a style="margin-left: 965px;" class="new btn btn-sm btn-primary" href="<?= base_url('Proveedores/registro') ?>">Agregar</a>
        </div>

        <div class="panel-body detalle-producto">

          <?php if($proveedores != false){?>
            <table class="table">

              <thead>
                <tr>
				  				<th>ID</th>
                  <th>Nombre</th>
                  <th>Direccion</th>
                  <th>Telefono</th>
                  <th>Correo</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

            	<tbody>

                  <?php foreach($proveedores as $item){?>
              		<tr>
											<?php 
											$id = $item['id'];           
											?>

											<td><?php  
												echo $item['id'];
											?></td>

											<td><?php 
											echo $item['nombre_pv'];
											?></td>

											<td><?php 
												echo $item['direccion'];
											?></td>

											<td><?php 	
												echo $item['telefono']; 
											?></td>

											<td><?php 
												echo $item['correo'];
											?></td>

											<td><a class="btn btn-sm btn-info" href="<?php echo base_url() . "Proveedores/Proveedor/" . $id?>">Editar</a></td>
											<td><a class="btn btn-sm btn-danger" href="<?php echo base_url() . "Proveedores/eliminar/" . $id?>">Eliminar</a></td>
  
                  </tr>
                          
                  <?php }?>
                    
                </tr>
              </tbody>
              
            </table>

            <?php }else{?>

            <div class="panel-body"> No hay proveedores agregados</div>

          <?php }?>
        </div>
		  </div>
    </div>
  </body>
</html>
