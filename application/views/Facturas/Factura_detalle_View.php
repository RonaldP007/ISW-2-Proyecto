<?php
    

    foreach($factura as $items){

        $items_factura = $items; 
    }  
	
	$nombre = explode(";",$items_factura['productos_nombres']);
	$precio = explode(";",$items_factura['cantidades']);
    $cantidad =  explode(";",$items_factura['precios']);

   
    
		

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
                <a href="<?= base_url('Facturas/index') ?>">
                <img id="logoSuper" src="<?php echo base_url(); ?>/assets/img/logo_Super.jfif" alt="Logo principal" />
                </a>
            </div>

			<br /> <br /> <br />
			<br /> <br /> <br />

            <div class="panel panel-info" style="margin-top: 5%;">
                
                <div class="panel-heading">
                    <h3 class="panel-title">Factura de Venta Realizada el <?php echo $items_factura['fecha']; ?></h3>
                </div>

                <div class="panel-body detalle-producto">
                    <?php if(true){?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Subtotal</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                    
                                    for($i = 0; $i< count($cantidad); $i++){
                                ?>
                                <tr>

                                    <td><?php echo $nombre[$i];?></td>

                                    <td><?php echo $precio[$i]?></td>

                                    <td><?php echo "₡" . $cantidad[$i]?></td>

                                    <td><?php $subtotal = ($cantidad[$i] * $precio[$i]);
                                        
                                        echo "₡" . $subtotal; 
                                    ?></td>
                                </tr>  

                                <?php }?>

                                <tr>
                                    <br/>
                                    <!--<td><a class="btn-sm btn-success volver" href="<?php //base_url('Facturas/index') ?>">Volver</a></td>-->
									<td><?php echo "";?></td>
                                    <td><?php echo "";?></td>
                                    <td><?php echo "";?></td>
                                    <td><?php echo "";?></td>
                                    <td><?php echo "₡" . $items_factura['totales'];?></td>
                                </tr>

                            </tbody>
                        </table>
                    <?php }?>
                </div>
            </div>
        </div>
    </body>
</html>
