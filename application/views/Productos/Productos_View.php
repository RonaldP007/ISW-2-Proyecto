<?php


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Productos</title>
	  <!--<link href="<?php //echo base_url(); ?>/assets/css/bootstrap.css" rel="stylesheet">-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
        
        <div class="panel-heading" style="display: flex; text-align: center; background-color: #d9edf7;">
            <h3 class="panel-title" style="margin-top: 5px; font-size: 150%; color: #31708f;">Productos</h3>
            <a style="margin-top: 0.20%; margin-left: 82.68%; height: 1%;" class="btn btn-primary" href="<?= base_url('Productos/registro') ?>">Agregar</a>
        </div>

        <div class="panel-body detalle-producto">

          <?php if($productos != false){?>
            <table class="table">

              <thead>
                <tr>
				  				<th>ID</th>
                  <th>Nombre</th>
                  <th>Cantidad</th>
                  <th>Precio</th>
                  <th>Proveedor</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

            	<tbody>

                  <?php foreach($productos as $item){?>
              		<tr>
                  <?php 
                  $id = $item['id'];           
                  ?>

                  <td><?php  
                    echo $item['id'];
                  ?></td>

                  <td><?php 
                  echo $item['nombre'];
                  ?></td>

                  <td><?php 
                    echo $item['cantidad'];
                  ?></td>

                  <td><?php 	
                    echo $item['precio']; 
                  ?></td>

                  <td><?php 
                    echo $item['nombre_pv'];
                  ?></td>

                  <td><a class="btn btn-info" href="<?php echo base_url() . "Productos/Producto/" . $id?>">Editar</a></td>
                  <td><a class="btn btn-sm btn-danger" href="<?php echo base_url() . "Productos/eliminar/" . $id?>">Eliminar</a></td>

                  </tr>
                            
                    <?php }?>
                      
                  </tr>
                </tbody>
              
            </table>

            <?php }else{?>

            <div class="panel-body"> No hay productos agregados</div>

          <?php }?>
        </div>
		  </div>
    </div>
  </body>
</html>
