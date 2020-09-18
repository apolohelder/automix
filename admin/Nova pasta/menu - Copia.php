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
		
		
		if($_GET['ativo']=="1" ) {
			
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
		}
		
		
		?>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <li class="<?=$classe7;?>"><a href="?pg=principal&listar=mostrar&link=1&ativo=7"><i class="fa fa-home fa-fw"></i> <span>Página inicial</span></a></li>
		  
	
		  
		  <li class="treeview <?=$classe;?>">
          <a href="#">
            <i class="fa fa-users"></i> <span>Produtos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li class="<?=$classe10;?>"><a href="index.php?pg=categoria&listar=listar&link=4&ativo=9&ativo=1"><i class="fa fa-list"></i> <span> Categorias</span></a></li>		  
		  <li class="<?=$classe34;?>"><a href="index.php?pg=produtos&listar=listar&ativo=1&link=24"><i class="fa fa-usd"></i><span> Gerenciar Produtos</span></a></li>
          </ul>
        </li>
		  
		    <li class="treeview <?=$classe12;?>">
          <a href="#">
            <i class="fa fa-cog"></i> <span>Serviços</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?=$classe13;?>"><a href="index.php?pg=categoria2&listar=listar&ativo=2&link=6"><i class="fa fa-circle-o"></i> Categorias</a></li>
            <li class="<?=$classe14;?>"><a href="index.php?pg=servicos&listar=listar&ativo=2&link=7"><i class="fa fa-circle-o"></i> Gerenciar Serviços</a></li>
            
          </ul>
        </li>
		  
		<li class="<?=$classe33;?>"><a href="index.php?pg=emails&listar=listar&ativo=14&link=23"><i class="fa fa-address-book"></i><span> Emails</span></a></li>
		  
		 <li class="<?=$classe35;?>"><a href="index.php?pg=banner&listar=listar&ativo=16&link=25"><i class="fa fa-picture-o"></i><span> Banners</span></a></li>
		  
		 <li class="<?=$classe36;?>"><a href="index.php?pg=parceiros&listar=listar&ativo=17&link=36"><i class="fa fa-picture-o"></i><span> Parceiros</span></a></li>
		  
		  <li class="<?=$classe27;?>"><a href="index.php?pg=endereco&listar=editar&ativo=6&link=18"><i class="fa fa-question-circle-o"></i><span> Endereços</span></a></li>
		  
		   <li class="treeview <?=$classe15;?>">
          <a href="#">
            <i class="fa fa-download"></i> <span>A servitech</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?=$classe16;?>"><a href="index.php?pg=categoriasservitech&listar=listar&ativo=3&link=9"><i class="fa fa-circle-o"></i> Categorias</a></li>
			     <li class="<?=$classe17;?>"><a href="index.php?pg=textos&listar=editar&ativo=3&link=10"><i class="fa fa-circle-o"></i> Gerenciar textos</a></li>
			<li class="<?=$classe13;?>"><a href="index.php?pg=banner_servitech&listar=editar&id=1&ativo=3&link=6"><i class="fa fa-circle-o"></i> Gerenciar imagem</a></li>
			  <li class="<?=$classe18;?>"><a href="index.php?pg=servicostech&listar=listar&ativo=3&link=11"><i class="fa fa-circle-o"></i> Gerenciar serviços</a></li>
            
          </ul>
        </li>
		  
		
		<li class="<?=$classe8;?>"><a href="index.php?pg=listarusuarios&listar=listar&link=2&ativo=11"><i class="fa fa-user-circle-o"></i> <span> Administradores</span></a></li>
		 
	
        <li><a href="logoff.php"><i class="fa fa-link"></i> <span>Sair</span></a></li>
     
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>