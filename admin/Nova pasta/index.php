<? include('include-topo.php'); ?>
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index.php?pg=principal&listar=mostrar&link=1&ativo=13" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>AP</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="images/logo_branca-200x53.png"></span>
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
                  <a href="index.php?pg=listarusuarios&listar=editar&id=<?=$_SESSION["id"];?>&link=2&ativo=11" class="btn btn-default btn-flat">Editar perfil</a>
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
	  
	  <?
          
  /**  miolo **/

   
    $pagina=addslashes(str_replace(".php","",isset($_GET["pg"])?$_GET["pg"]:"principal.php"));
    
  
    if(preg_match("/http|www|ftp|.dat|.txt|.gif|wget|.asp/i", $pagina))
    {
        
      
        echo "<script type=\"text/Javascript\">";
        echo "location='index.php'";
        echo "</script>";
        return;
   
    }else{
      
        $pg = "".$pagina.".php";
        if(!empty($pg) && file_exists($pg)) {
			
			
          
                        
            include ("".$pagina.".php");
         
        }
      
        else
        { 
            include ("principal.php");
        }
    }
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
  <strong>SERVITECH - <?=date("Y");?></strong></footer>

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<? include ('include-rodape.php'); ?>
