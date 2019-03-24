<?php



?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Edicion de Cliente</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="screen" title="no title">
    <link rel="stylesheet"  href="<?php echo base_url(); ?>/assets/css/registrar.css">
	<!--Este script es para usar Sweet Alert -->
	<script src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js " > </script>
	<script>
		let msj;
		//es para notificar a el usuario de no tiene acceso a ventas
		function mensaje() {
			swal({
				title: msj,
				text: "Has click en el boton.",
				icon: "warning",
				button: "OK",
			});
		}
	</script>

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
							<?php if(isset($_SESSION['mensaje']) != "" && isset($_SESSION['mensaje']) != null) :?>
								<script> 
									msj = "No se puede desactivar, tiene un credito pendiente.";
									mensaje() 
								</script>
								<?php $_SESSION['mensaje'] = null; ?>
							<?php endif ?>

							<?php foreach($cliente as $item){?>

								<form method="post" action="<?php echo base_url() . "Clientes/editar/" . $item['cedula']?>">
										<div class="form-group">
											<input class="form-control" placeholder="Cedula" name="cedula" type="hidden" value="<?php echo $item['cedula'];?>">
										</div>


										<div class="form-group">
											<input class="form-control" placeholder="Nombre" name="nombre" type="text" autofocus onkeypress="return soloLetras(event)" onblur="limpia()" id="miInput" required
												value="<?php echo $item['nombre'];?>">
										</div>

										<div class="form-group">
											<input class="form-control" placeholder="Apellidos" name="apellidos" type="text" autofocus onkeypress="return soloLetras(event)" onblur="limpia()" id="miInput" required
												value="<?php echo $item['apellidos'];?>">
										</div>
										
										<div class="form-group">
											<input class="form-control" placeholder="Telefono" name="telefono" type="text" onkeypress="return validar(event)" required
												value="<?php echo $item['telefono'];?>">
										</div>

										<div class="form-group">
											<input class="form-control" placeholder="Direccion" name="direccion" type="text"  required
											value="<?php echo $item['direccion'];?>">
										</div>

										<div class="form-group">
											<div class="form-group col-md-13">
												<select style="margin-left: 1px;" id="fiador" name="fiador" value="" class="form-control" required>
													<option value="">Seleccionar Cedula Fiador</option>  

													<?php if(count($fiadores)>0):?>
														<?php foreach($fiadores as $fiador):?>
															<option value="<?php echo $fiador['cedula'];?>" <?php if($fiador['cedula'] == $item["id_fiador"]){echo "selected";} ?> ><?php echo $fiador['cedula'];?></option>
														<?php endforeach;?>
													<?php endif;?>
												</select>
											</div>
										</div>

										<div class="form-group">
											<div class="form-group col-md-13">
												<select style="margin-left: 1px;" id="estado" name="estado" value="" class="form-control" required>

													<option value="a" <?php if($item['estado'] == "a"){echo "selected";} ?> ><?php echo "Activo"?></option>
													<option value="d">Desactivar</option>
												
												</select>
											</div>
										</div>

										<input class="btn btn-lg  btn-block" type="submit" value="Editar" name="Editar" >
										<a class="btn btn-lg btn-block" href= "<?= base_url('Clientes/getClientes') ?>" role="button">Volver</a>  
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
