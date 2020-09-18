<? require("restrito.php"); ?>
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

     
     <!-- <div class="user-panel">
        <div class="pull-left image">
          <img src="images/logomini.jpg" class="img-circle">
        </div>
        <div class="pull-left info">
          <p><? #$primeironome = explode(' ', $_SESSION["nome"]); echo $primeironome[0]; ?></p>
          
   
        </div>
      </div>-->

		<?
		
		
	/*	if($_GET['ativo']=="1" ) {
			
			$classe = "active";
			
		}else if($_GET['ativo']=="2") {
			
			$classe12 = "active";
			
		}else if($_GET['ativo']=="3") {
			
			$classe15 = "active";
			
		}else if($_GET['ativo']=="4") {
			
			$classe19 = "active";
			
		}else if($_GET['ativo']=="5") {
			
			$classe23 = "active";
			
		}else if($_GET['ativo']=="6") {
			
			$classe30 = "active";
			
		}else if($_GET['ativo']=="7") {
			
			$classe7 = "active";
			
		}else if($_GET['ativo']=="8") {
			
			$classe29 = "active";
			
		}else if($_GET['ativo']=="9") {
			
			$classe10 = "active";
			
		}else if($_GET['ativo']=="10") {
			
			$classe11 = "active";
			
		}else if($_GET['ativo']=="11") {
			
			$classe8 = "active";
			
		}else if($_GET['ativo']=="12") {
			
			$classe7 = "active";
			
		}else if($_GET['ativo']=="13") {
			
			$classe32 = "active";
			
		}else if($_GET['ativo']=="14") {
			
			$classe33 = "active";
			
		}else if($_GET['ativo']=="15") {
			
			$classe34 = "active";
			
		}else if($_GET['ativo']=="16") {
			
			$classe35 = "active";
			
		}
		
		if($_GET['pg']=="setor" ) {
			
			$classe2 = "active";
			
		}else if($_GET['pg']=="funcao") {
			
			$classe3 = "active";
			
		}else if($_GET['pg']=="grupo") {
			
			$classe4 = "active";
		}else if($_GET['pg']=="subgrupo") {
			
			$classe5 = "active";
		}
		else if($_GET['pg']=="empresa") {
			
			$classe6 = "active";
			
		}else if($_GET['link']=="1") {
			
			$classe7 = "active";
		}else if($_GET['link']=="2") {
			
			$classe8 = "active";
		}else if($_GET['link']=="3") {
			
			$classe9 = "active";
		}else if($_GET['link']=="4") {
			
			$classe10 = "active";
		}else if($_GET['link']=="5") {
			
			$classe11 = "active";
		}else if($_GET['link']=="6") {
			
			$classe13 = "active";
			
		}else if($_GET['link']=="7") {
			
			$classe14 = "active";
		}else if($_GET['link']=="8") {
			
			$classe15 = "active";
		}else if($_GET['link']=="9") {
			
			$classe16 = "active";
		}else if($_GET['link']=="10") {
			
			$classe17 = "active";
		}else if($_GET['link']=="11") {
			
			$classe18 = "active";
		}else if($_GET['link']=="12") {
			
			$classe20 = "active";
		}else if($_GET['link']=="13") {
			
			$classe21 = "active";
		}else if($_GET['link']=="14") {
			
			$classe22 = "active";
		}else if($_GET['link']=="15") {
			
			$classe24 = "active";
		}else if($_GET['link']=="16") {
			
			$classe25 = "active";
		}else if($_GET['link']=="17") {
			
			$classe26 = "active";
		}else if($_GET['link']=="18") {
			
			$classe27 = "active";
		}else if($_GET['link']=="19") {
			
			$classe28 = "active";
		}else if($_GET['link']=="20") {
			
			$classe30 = "active";
		}else if($_GET['link']=="21") {
			
			$classe31 = "active";
		}else if($_GET['link']=="22") {
			
			$classe32 = "active";
		}else if($_GET['link']=="23") {
			
			$classe33 = "active";
		}else if($_GET['link']=="24") {
			
			$classe34 = "active";
		}else if($_GET['link']=="25") {
			
			$classe35 = "active";
		}else if($_GET['link']=="36") {
			
			$classe36 = "active";
		}*/
		
		
		?>
<? #$url_atual = $_SERVER['REQUEST_URI']; echo $url_atual;
		?>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <li class="<?=$classe7;?>"><a href="?pg=principal&listar=mostrar&link=1&ativo=7"><i class="fa fa-home fa-fw"></i> <span>Página inicial</span></a></li>
		  
	
		   <li class="treeview <? if($_GET['pg']=='textos' || $_GET['pg']=='categoriasservitech' || $_GET['pg']=='banner_servitech' || $_GET['pg']=='servicostech') { echo "active"; }?>">
			  
          <a href="#">
            <i class="fa fa-download"></i> <span>Cadastros</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <? if($_GET['pg']=='marcas') { echo "class=\"active\""; }?>><a href="index.php?pg=marcas&listar=listar"><i class="fa fa-circle-o"></i> Marcas</a></li>
			<li <? if($_GET['pg']=='textos') { echo "class=\"active\""; }?>><a href="index.php?pg=textos&listar=editar&ativo=3&link=10"><i class="fa fa-circle-o"></i> Gerenciar textos</a></li>
			<li <? if($_GET['pg']=='banner_servitech') { echo "class=\"active\""; }?>><a href="index.php?pg=banner_servitech&listar=editar&id=1&ativo=3&link=6"><i class="fa fa-circle-o"></i> Gerenciar imagem</a></li>
			  <li <? if($_GET['pg']=='servicostech') { echo "class=\"active\""; }?>><a href="index.php?pg=servicostech&listar=listar&ativo=3&link=11"><i class="fa fa-circle-o"></i> Gerenciar serviços</a></li>
            
          </ul>
        </li>
	
		  
		<!--<li class="<?=$classe33;?>"><a href="index.php?pg=emails&listar=listar&ativo=14&link=23"><i class="fa fa-address-book"></i><span> Emails</span></a></li>-->
		  
	
		  

		  
		
		<li class="<?=$classe8;?>"><a href="index.php?pg=listarusuarios&listar=listar&link=2&ativo=11"><i class="fa fa-user-circle-o"></i> <span> Administradores</span></a></li>
		 
	
        <li><a href="logoff.php"><i class="fa fa-link"></i> <span>Sair</span></a></li>
     
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
<script>
// Highlight the active menu
$(document).ready(function () {
/** add active class and stay opened when selected */
  var url = window.location;

  // for sidebar menu entirely but not cover treeview
  $('ul.sidebar-menu a').filter(function() {
     return this.href == url;
  }).parent().addClass('active');
  //Top bar
  $('ul.navbar-nav a').filter(function() {
     return this.href == url;
  }).parent().addClass('active');

  // for treeview
  $('ul.treeview-menu a').filter(function() {
     return this.href == url;
  }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
	
		
});
</script>