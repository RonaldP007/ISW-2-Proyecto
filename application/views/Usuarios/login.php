<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="screen" title="no title">
    <link rel="stylesheet"  href="<?php echo base_url(); ?>/assets/css/log.css">
</head>

  <body id="LoginForm">

    <div class="container centered-form">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-success ">
                <div class="panel-heading login-form">
                    <h2 class="panel-title">Login</h2>
                </div>
                <?php
                    $success_msg= $this->session->flashdata('success_msg');
                    $error_msg= $this->session->flashdata('error_msg'); 

                  if($success_msg){
                    ?>
                    <div class="alert alert-success">
                      <?php echo $success_msg; ?>
                    </div>
                  <?php
                  }
                  if($error_msg){
                    ?>
                    <div class="alert alert-danger">
                      <?php echo $error_msg; ?>
                    </div>
                    <?php
                  }
                ?>

                <div class="panel-body">
                    <form role="form" method="post" action="<?php echo base_url('Usuarios/login_user'); ?>">
                        <fieldset>
                            <div class="form-group"  >
                                <input class="form-control" placeholder="Cedula" name="cedula" type="text" autofocus required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Contraseña" name="pass" type="password" value="" required>
                            </div>

                            <input class="btn btn-lg btn-block" type="submit" value="Entrar" name="login" >
                            <a class="btn btn-lg btn-block" href= "<?= base_url('principal/index') ?>" role="button">Volver</a> 

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


  </body>
</html>
