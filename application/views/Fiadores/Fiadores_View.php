<?php


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Fiadores</title>
	  <link href="<?php echo base_url(); ?>/assets/css/bootstrap.css" rel="stylesheet">
	  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/styles.css">
    <script src = "https://code.jquery.com/jquery-3.0.0.js"> </script>
  </head>

  <body>
    <div class="container">
      <!--Este scrip es para mostrar el div que contiene el mensaje-->
      <script>
        function timeMSJ(id) {
          let idDiv2 = id;
          $("#mostrar").css("display", "block");
          setTimeout(function() {
              $(idDiv2).fadeOut(1000);
          },2000);
        }
      </script>

      <div>
        <a href="<?= base_url('Usuarios/user_view') ?>">
          <img id="logoSuper" src="<?php echo base_url(); ?>/assets/img/logo_Super.jfif" alt="Logo principal" />
        </a>
      </div>

      <br /> <br /> <br />
      <br /> <br /> <br />

      <?php
        //recive el mensaje
        $error_msg = $this->session->flashdata('error_msg'); 
      ?>

      <div id="mostrar" style="display: none; padding: 1.75%; background-color: transparent; margin-top: 1%; margin-bottom: -0.99%;">
      
        <div style="margin-bottom: -1.80%; margin-top: -1.80%;" id="msj_danger" class="alert alert-danger">
          <?php if($error_msg) :?>
            <p style="text-align: center;"> <?php echo $error_msg; ?> </p>
            <script> timeMSJ("#msj_danger") </script>
          <?php 
            $error_msg = null; 
            $this->session->set_flashdata('error_msg', $error_msg);
            endif; 
          ?>
        </div>
      
      </div>

      <div class="panel panel-info" style="margin-top: 20px;">
        
        <div class="panel-heading" style="display: flex; text-align: center;">
            <h3 class="panel-title" style="margin-top: 5px;">Fiadores</h3>
            <a id="btnAdd" class="new btn btn-sm btn-primary" href="<?= base_url('Fiadores/registro') ?>">Agregar</a>
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

					<?php foreach($fiadores as $item){
						if($item['cedula'] == 0){
							continue;
						}else{ ?>
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
							<td><a class="btn btn-sm btn-danger" href="<?php echo base_url() . "Fiadores/desactivar/" . $cedula?>">Eliminar</a></td>

						</tr>
                          
					<?php }}?> 
                    
                </tr>
              </tbody>
              
            </table>

            <?php }else{?>

            <div class="panel-body"> No hay fiadores agregados</div>

          <?php }?>
        </div>
		  </div>
    </div>
  </body>
</html>
