<?php



?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Edicion de Productos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="screen" title="no title">
    <link rel="stylesheet"  href="<?php echo base_url(); ?>/assets/css/registrar.css">

</head>

<body id="registro-form">

    <span style="background-color:red;">
        <div class="container centered-form">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-success">
                        <div class="panel-heading">
                            <h2 class="panel-title">Edicion</h2>
                        </div>

                        <div class="panel-body">

							<?php foreach($producto as $item){?>

								<form method="post" action="<?php echo base_url() . "Productos/editar/" . $item['id']?>">
								
										<div class="form-group">
											<input class="form-control" placeholder="Nombre" name="nombre" type="text" autofocus onkeypress="return soloLetras(event)" onblur="limpia()" id="miInput" required
												value="<?php echo $item['nombre'];?>">
										</div>

										<div class="form-group">
											<input class="form-control" placeholder="Cantidad" name="cantidad" type="text" autofocus onkeypress="return validar(event)" required
												value="<?php echo $item['cantidad'];?>">
										</div>
										
										<div class="form-group">
											<input class="form-control" placeholder="Precio" name="precio" type="text" onkeypress="return validar(event)" required
												value="<?php echo $item['precio'];?>">
										</div>

										<div class="form-group">
											<input class="form-control" placeholder="Proveedor" name="id_proveedor" type="hidden"  required
											value="<?php echo $item['id_proveedor'];?>">
										</div>

										<input class="btn btn-lg  btn-block" type="submit" value="Editar" name="Editar" >
										<a class="btn btn-lg btn-block" href= "<?= base_url('Productos/getProductos') ?>" role="button">Volver</a>  
								</form>
							<?php }?>

							<script>

								function soloLetras(e) {//esta funcion valida si la tecla presionada esta permitida
									key = e.keyCode || e.which;
									tecla = String.fromCharCode(key).toLowerCase();
									letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
									especiales = [8, 37, 39, 46];

									tecla_especial = false
									for(var i in especiales) {
										if(key == especiales[i]) {
											tecla_especial = true;
											break;
										}
									}

									if(letras.indexOf(tecla) == -1 && !tecla_especial)
										return false;
								}

								function limpia() {
									var val = document.getElementById("miInput").value;
									var tam = val.length;
									for(i = 0; i < tam; i++) {
										if(!isNaN(val[i]))
											document.getElementById("miInput").value = '';
									}
								}

								function validar(e) { // valida solo que solo se pueda ingresar numeros
									tecla = (document.all) ? e.keyCode : e.which;
									if (tecla==8) return true;
									patron =/\d/;
									te = String.fromCharCode(tecla);
									return patron.test(te);
								} 

							</script>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </span>

    

</body>
</html>
