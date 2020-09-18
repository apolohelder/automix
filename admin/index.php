<? include('include-topo.php'); ?>
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <!-- Logo -->
    <a href="<?=URL::getBase(); ?>principal/listar/listar" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>AP</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="<?php echo URL::getBase() ?>images/logo_branca-200x53.png"></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- /.messages-menu -->

          <!-- Notifications Menu -->
       
          <!-- Tasks Menu -->
          
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <!--<img src="images/logomini.jpg" class="user-image" alt="RD">-->
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?=$_SESSION["nome"];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
               <!-- <img src="images/logo.png" class="img-circle2" alt="Servitech">-->

                <p>
                  <?=$_SESSION["nome"];?>
                  <!--<small>texto</small>-->
                </p>
              </li>
              <!-- Menu Body -->
          
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?=URL::getBase(); ?>listarusuarios/listar/editar/id/<?=$_SESSION["id"];?>" class="btn btn-default btn-flat">Editar perfil</a>
                </div>
                <div class="pull-right">
                  <a href="logoff.php" class="btn btn-default btn-flat">Sair do sistema</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->

		<? include 'menu.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
	  
	 <?php
        $modulo = Url::getURL( 0 );

        if( $modulo == null )
            $modulo = "modulo1";

        if( file_exists( "modulos/" . $modulo . ".php" ) )
            require "modulos/" . $modulo . ".php";
        else
            require "modulos/404.php";
        ?>
   
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
<!--      Desenvolvido por Hugo Senna
-->    </div>
    <!-- Default to the left -->
  <strong>Automix - <?=date("Y");?></strong></footer>

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<? include ('include-rodape.php'); ?>
