<?php
          
            if(!isset($_SESSION['nombre'])){//comprueba si existe el nombre de usuario

                redirect('Usuarios/login');
            
            }
                

        ?>        
        
        <!--MENU-->
        <nav id= "menu">
            <?php if($_SESSION['rol'] == "a"){ ?>
                <ul>
					<!---<li><a class="btn btn-dark" href= "#">Inicio</a></li>-->
					<li><a href= "<?= base_url('Usuarios/getUsuarios')?>">Usuarios</a></li>
					<li><a href= "<?= base_url('Clientes/getClientes')?>">Clientes</a></li>
					<li><a href= "<?= base_url('Proveedores/getProveedores') ?>">Proveedores</a></li>
					<li><a href= "<?= base_url('Productos/getProductos') ?>">Productos</a></li>
					<li><a href= "<?php echo base_url('Fiadores/getFiadores');?>">Fiadores</a></li></li>
                <ul>
                <?php }else{ ?>
                    <ul>
                    <li><a href= "<?= base_url('Clientes/getClientes')?>">Clientes</a></li>
                    <li><a href= "<?= base_url('Productos/getProductos') ?>">Productos</a></li>
					<li><a href= "<?php echo base_url('Fiadores/getFiadores');?>">Fiadores</a></li></li>
                    <ul>
            <?php } ?>
        </nav>


        <!--Contenido-->
        <div id= "contenido" > 

            <!--Barra lateral-->
            <aside id= "lateral" > 
                <div id= "login" class="aside">
                    <h3>Bienvenido <?php echo " " . $_SESSION['nombre'];?></h3> 
                    <br/> <br/>
                    <a href = "<?= base_url('Usuarios/user_logout') ?>" class="logout">Sign out  <i class="fas fa-sign-out-alt"></i></a> 
                    <br/> <br/> <br/>
                   
                    <?php if($_SESSION['rol'] == 'u'){ ?>
                        
                    <?php }else{ ?>
                        <?php
                           
                        ?>

                      
                    <?php } ?>

                </div>
            </aside>

           

            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script>
              
            </script>

