 <!--MENU-->
        <nav id="menu">
            <p>
                <h2 id="title1">Bienvenido al mejor Super Unisol.</h2>
            </p>
        </nav>

        <!--Contenido-->
        <div id="contenido">

            <!--Barra lateral-->
            <aside id="lateral">
                <!--<a href= "<?= base_url('Usuarios/login') ?>" role="button">Login</a> -->
                <div class="row formLogin">
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
                                <?php 
                                    echo $success_msg; 
                                ?>
                                </div>
                            <?php
                            }
                            if($error_msg){
                                ?>
                                <div class="alert alert-danger">
                                <?php 
                                    echo $error_msg; 
                                ?>
                                </div>
                                <?php
                            }
                            ?>

                            <div class="panel-body Login">
                                <form role="form" method="post" action="<?php echo base_url('Usuarios/login_user'); ?>">
                                    <fieldset>
                                        <div class="form-group"  >
                                            <input class="form-control" placeholder="Cedula" name="cedula" type="text" autofocus required>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Contraseña" name="pass" type="password" required>
                                        </div>

                                        <input class="btn btn-outline-primary" type="submit" value="Entrar" name="login" >

                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </aside>
 
            <!--Contenido central-->
            <div id="central">
                <img src="<?php echo base_url(); ?>/assets/img/principal.jpg" width="76%"/>
            </div>
