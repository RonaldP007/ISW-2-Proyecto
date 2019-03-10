<?php



?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Registro nueva Cuenta a Pagar</title>
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
                            <h2 class="panel-title">Registro</h2>
                        </div>

                        <div class="panel-body">

                        <?php if(!empty($this->session->flashdata())): ?>
                            <div class="alert alert-<?php echo $this->session->flashdata('clase')?>">
                                <?php $error = true; 
                                echo $this->session->flashdata('mensaje') ?>

                            </div>
                        <?php endif; ?>

                            <form method="post" action="<?php echo base_url('Cuentas_pagar/nueva_cuenta'); ?>">
									
									<div class="form-group">
                                        <input class="form-control" placeholder="Numero de factura" name="numero_factura" type="text" onkeypress="return validar(event)" required
                                            value="<?php
                                            if(isset($error)){
                                                echo $this->session->flashdata('numero_factura');
                                            }    
                                        ?>">
                                    </div>

									<div class="form-group">
                                        <div class="form-group col-md-13">
                                            <select style="margin-left: 1px;" id="proveedor" name="proveedor" value="" class="form-control" required>
                                                <option value="">Seleccionar proveedor</option>

                                                <?php if(count($provedor)>0):?>
                                                    <?php foreach($provedor as $pro):?>
                                                        <option value="<?php echo $pro['id'];?>" ><?php echo $pro['nombre_pv'];?></option>
                                                    <?php endforeach;?>
                                                <?php endif;?>
                                            </select>
                                        </div>
                                    </div>
									
									
									<div class="form-group">
                                        <input class="form-control" placeholder="Monto" name="monto" type="text" onkeypress="return validar(event)" required
                                            value="<?php
                                            if(isset($error)){
                                                echo $this->session->flashdata('monto');
                                            }    
                                        ?>">
                                    </div>


									<div class="form-group">
                                        <input class="form-control" placeholder="Fecha de pago" name="fecha_pago" type="date" onkeypress="return validar(event)" required
                                            value="<?php
                                            if(isset($error)){
                                                echo $this->session->flashdata('fecha_pago');
                                            }    
                                        ?>">
                                    </div>

                                   

                                    <input class="btn btn-lg  btn-block" type="submit" value="Registrarse" name="Registrarse" >
                                    <a class="btn btn-lg btn-block" href= "<?= base_url('Cuentas_pagar/getCuentas_pagar') ?>" role="button">Volver</a>  
                            </form>

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
