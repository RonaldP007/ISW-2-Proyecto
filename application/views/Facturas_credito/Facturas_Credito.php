<?php


?> 

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Facturas</title>
	  <!--<link href="<?php echo base_url(); ?>/assets/css/bootstrap.css" rel="stylesheet">-->
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
            <h3 class="panel-title" style="margin-top: 5px; font-size: 150%; color: #31708f;">Facturas Creditos</h3>
        </div>

        <div class="panel-body detalle-producto">

          <?php if($facturas != false){?>
            <table class="table" style="text-align: center;">

              <thead>
                <tr>
                  <th style="text-align: center;">ID Vendedor</th>
                  <th style="text-align: center;">ID Cliente</th>
                  <th style="text-align: center;">Nombre Cliente</th>
                  <th style="text-align: center;">Fecha</th>
                  <th style="text-align: center;">Abono</th>
                  <th style="text-align: center;">Falta Cancelar</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

            	<tbody>

                <?php foreach($facturas as $item){?>
                <tr>

                  <td><?php  
                    echo $item['id_usuario_credi'];
                  ?></td>

                  <td><?php  
                    echo $item['cedula'];
                  ?></td>

                  <td><?php  
                    echo $item['nombre'];
                  ?></td>

                  <td><?php 
                    echo $item['fecha_credito'];
                  ?></td>

                  <td><?php 
                    echo "₡" . $item['total_adeudado'];
                  ?></td>

                  <td><?php 
                    echo "₡" . $item['total_creditar'];
                  ?></td>

                  <td><a class="btn btn-secondary" href="<?php echo base_url() . "Creditos/get_info_factura_cred/" . $item["id_factura"] ?>">Ver</a></td>
                  <td><a class="btn btn-primary" href="<?php echo base_url() . "Creditos/pagarCredito/" . $item["id_factura"] ?>">Pagar Credito</a></td>

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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
