<?php
    

    foreach($factura as $items){

        $items_factura = $items; 
    }  
	
	$nombre = explode(";",$items_factura['nombre_produc']);
	$cantidad = explode(";",$items_factura['cantidades_produc']);
    $precio =  explode(";",$items_factura['precios_produc']);
   
    
		

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
                <a href="<?= base_url('Creditos/fact_credito') ?>">
                <img id="logoSuper" src="<?php echo base_url(); ?>/assets/img/logo_Super.jfif" alt="Logo principal" />
                </a>
            </div>

			<br /> <br /> <br />
			<br /> <br /> <br />

            <div class="panel panel-info" style="margin-top: 5%;">
                
                <div class="panel-heading">
                    <h3 class="panel-title">Factura de Credito Realizada el <?php echo $items_factura['fecha_credito']; ?></h3>
                </div>

                <div class="panel-body detalle-producto">
                    <?php if(true){?>
                        <table class="table" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">Producto</th>
                                    <th style="text-align: center;">Cantidad</th>
                                    <th style="text-align: center;">Precio Unidad</th>
                                    <th style="text-align: center;">Subtotal</th>
                                    <th style="text-align: center;">Total Factura</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                    
                                    for($i = 0; $i< count($cantidad); $i++){
                                ?>
                                <tr>

                                    <td><?php echo $nombre[$i];?></td>

                                    <td><?php echo $cantidad[$i]?></td>

                                    <td><?php echo "₡" . $precio[$i]?></td>

                                    <td><?php $subtotal = ($cantidad[$i] * $precio[$i]);
                                        
                                        echo "₡" . $subtotal; 
                                    ?></td>
                                </tr>  

                                <?php }?>

                                <tr>
                                    <br/>
                                    <!--<td><a class="btn-sm btn-success volver" href="<?php //base_url('Creditos/fact_credito') ?>">Volver</a></td>-->
                                    <td><?php echo "";?></td>
                                    <td><?php echo "";?></td>
                                    <td><?php echo "";?></td>
                                    <td><?php echo "";?></td>
                                    <td><?php echo "₡" . $items_factura['total_factura'];?></td>
                                </tr>

                            </tbody>
                        </table>
                    <?php }?>
                </div>
            </div>
        </div>
    </body>
</html>
