<? require("modulos/restrito.php"); ?>
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
		
	
		
		
		?>
<? #$url_atual = $_SERVER['REQUEST_URI']; echo $url_atual;
		?>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <li <? if(Url::getURL(0)=='principal') { echo "class=\"active\""; }?>><a href="<?=URL::getBase(); ?>principal/listar/listar"><i class="fa fa-home fa-fw"></i> <span>Página inicial</span></a></li>	
		  
		  	<li <? if(Url::getURL(0)=='banner') { echo "class=\"active\""; }?>><a href="<?=URL::getBase(); ?>banner/listar/listar"><i class="fa fa-picture-o"></i> <span> Banners</span></a></li>
	
		   <li class="treeview <? if(Url::getURL(0)=='marcas' || Url::getURL(0)=='modelos' || Url::getURL(0)=='opcionais' || Url::getURL(0)=='maisinformacoes') { echo "active"; }?>">
			  
			  <a href="#">
				<i class="fa fa-list"></i> <span>Cadastros</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li <? if(Url::getURL(0)=='marcas') { echo "class=\"active\""; }?>><a href="<?=URL::getBase(); ?>marcas/listar/listar"><i class="fa fa-circle-o"></i> Marcas</a></li>
				<li <? if(Url::getURL(0)=='modelos') { echo "class=\"active\""; }?>><a href="<?=URL::getBase(); ?>modelos/listar/listar"><i class="fa fa-circle-o"></i> Modelos</a></li>
				<li <? if(Url::getURL(0)=='opcionais') { echo "class=\"active\""; }?>><a href="<?=URL::getBase(); ?>opcionais/listar/listar"><i class="fa fa-circle-o"></i> Opcionais</a></li>
				<li <? if(Url::getURL(0)=='maisinformacoes') { echo "class=\"active\""; }?>><a href="<?=URL::getBase(); ?>maisinformacoes/listar/listar"><i class="fa fa-circle-o"></i> + Informações</a></li>

			  </ul>
       	 	</li>
		  
		  
		  <li class="treeview <? if(Url::getURL(0)=='veiculos') { echo "active"; }?>">
			  
			  <a href="#">
				<i class="fa fa-car"></i> <span>Veículos</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li <? if(Url::getURL(0)=='veiculos') { echo "class=\"active\""; }?>><a href="<?=URL::getBase(); ?>veiculos/listar/listar"><i class="fa fa-circle-o"></i> Gerenciar Veículos</a></li>
				
				

			  </ul>
       	 	</li>
	
		  
		<!--<li class="<?=$classe33;?>"><a href="index.php?pg=emails&listar=listar&ativo=14&link=23"><i class="fa fa-address-book"></i><span> Emails</span></a></li>-->
		  
	
		  

		  
		
		<li <? if(Url::getURL(0)=='listarusuarios') { echo "class=\"active\""; }?>><a href="<?=URL::getBase(); ?>listarusuarios/listar/listar"><i class="fa fa-user-circle-o"></i> <span> Administradores</span></a></li>
		 
	
        <li><a href="<?=URL::getBase(); ?>modulos/logoff.php"><i class="fa fa-sign-out"></i> <span>Sair</span></a></li>
     
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