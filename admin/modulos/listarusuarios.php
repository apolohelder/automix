<? require("restrito.php"); 
/*foreach ($_SESSION as $key => $value) {
    print($key.' - '.$value.'<br>');
};*/

$tabela = 'usuario';
$pagina = 'listarusuarios';

if(isset($_POST['cadastrar']) && !empty($_POST['cadastrar']))	{
	


	
    $nome = $_POST['nome'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$tipo = 1;

	
	if(strlen($email) != 0){
			 $sel_login = mysqli_query($conn,"SELECT * FROM ".$tabela." WHERE email='$email'");
			 $conta_login = mysqli_num_rows($sel_login);
		if($conta_login != 0){
			alert('Já existe um cadastro com este E-mail.');
		}else{	
	
	
	$query = mysqli_query($conn,"INSERT INTO ".$tabela." (nome,email,senha,tipo) VALUES ('$nome','$email','$senha','1')")  or die (mysqli_error($conn));
	
	 echo '<script> bootbox.alert("Cadastro foi efetuado com sucesso!", function(){  location.href = "'.URL::getBase().''.$pagina.'/listar/listar";  })</script>';
	

		}
	}
}

if(isset($_POST['editar']) && !empty($_POST['editar']))	{
	
	$email = $_POST['email'];
	$id = intval(Url::getURL(4));
	if(strlen($email) != 0){
			 $sel_login = mysqli_query($conn,"SELECT * FROM ".$tabela." WHERE email='$email' && id !='$id'");
			 $conta_login = mysqli_num_rows($sel_login);
		if($conta_login != 0){
		
			echo '<script> bootbox.alert("Já existe um cadastro com este E-mail.")</script>';
		}else{
	
	
	$query = mysqli_query($conn,"UPDATE ".$tabela." SET
	 nome   = '{$_POST['nome']}',
	 email    = '{$_POST['email']}',
	 senha    = '{$_POST['senha']}'
	 WHERE id  = '{$id}'") or die("Error: " . mysqli_error($conn));
	
	 echo '<script> bootbox.alert("Cadastro foi atualizado com sucesso!", function(){  location.href = "'.URL::getBase().''.$pagina.'/listar/listar";  })</script>';
	
		} 
	}
}

?>



<script language="javascript" type="text/javascript"> 

		function validar() { 
			var senha = cadastro.senha.value; 
			var senha2 = cadastro.senha2.value;
			if (senha != senha2) { 
				alert('Senhas diferentes. Por favor verique!!'); 
				cadastro.senha2.focus();
			 	return false; 
			}; 
		} 		
		
	</script> 

<script type="text/javascript" language="javascript" class="init">
	
$(function () {
	//$.fn.dataTable.moment('DD/MM/YYYY');    //Formatação sem Hora
 
    $('#example').DataTable( {
		 dom: 'Bfrtip',
		"pageLength": 20,
        buttons: [
            {
                extend: 'print',
                messageTop: function () {                    
                   
                        return 'MENU >> Lista de usuários';
                   
                },
                messageBottom: null
            }
        ],
        	 "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.13/i18n/Portuguese-Brasil.json"
        }
    } );
} );
	</script>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalCentralizado">Confirmação</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Você tem certeza que deseja excluir? Esse procedimento é irreversível.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <a href="#" class="btn btn-danger danger" id="botaodeletar">Deletar</a>
      </div>
    </div>
  </div>
</div>
<section class="content-header">
      <h1>
        Lista de administradores cadastrados<small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
        <li class="active">Lista de administradores</li>
      </ol>
    </section>


<section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
		 <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
         <!--   <div class="box-header with-border">
              <h3 class="box-title">Texto</h3>
            </div>-->
            <!-- /.box-header -->
            <!-- form start -->
         
          </div>
			
		<? if(Url::getURL(2) == "mostrar") { ?>
			
			
			<form name="cadastro" id="cadastro" method="post" action="">
					<div class="col-md-6">
						<div class="form-group">
							<label for="nome">Nome completo</label>
							<input required type="text" class="form-control" id="nome" name="nome">
						</div>
						<div class="form-group">
							<label for="email">E-mail</label>
							<input required type="email" class="form-control" id="email" name="email">
						</div>						

						<div class="form-group">
							<label for="senha">Digite a senha</label>
							<input required type="password" class="form-control" id="senha" name="senha">
						</div>

						<div class="form-group">
							<label for="senha2">Digite novamente a senha para confirmar</label>
							<input required type="password" class="form-control" id="senha2" name="senha2">
						</div>
					</div>
					
					<div class="col-md-12">
						<button type="submit" class="btn btn-success" onclick="return validar()">Cadastrar</button>
						<input name="cadastrar" type="hidden" id="cadastrar" value="1">
						<button type="button" class="btn btn-info" onClick="history.go(-1)">Voltar</button>
					</div>
				</form>
			
			
			
	<? } if(Url::getURL(2) == "listar") {  if($_SESSION['id']==1) {  ?>
			<a href="<?=URL::getBase(); ?><?=$pagina;?>/listar/mostrar"><div class="btn btn-success" style="margin: 10px;">CADASTRAR ADMINISTRADOR</div></a>	<? } ?>
		<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>NOME</th>
            <th>EMAIL</th>
            <th>Op&ccedil;&otilde;es</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>NOME</th>
            <th>EMAIL</th>
            <th>Op&ccedil;&otilde;es</th>
        </tr>
    </tfoot>
    <tbody>
       <? $query = mysqli_query($conn,"SELECT * FROM ".$tabela."");
					while ($dados = mysqli_fetch_array($query)) {
		?>
        <tr id="item_<?=$dados['id'];?>">
            <td><a href="<?=URL::getBase(); ?><?=$pagina;?>/listar/editar/id/<?=$dados['id'];?>"><?=$dados['nome'];?></a></td>
            <td><?=$dados['email'];?></td>
            <td><!--<a class="btn btn-success" href="#">
          <i class="glyphicon glyphicon-zoom-in icon-white"></i>
          Ver
          </a>-->
              <? if($_SESSION['id']==1) { ?>
              <a class="btn btn-info" href="<?=URL::getBase(); ?><?=$pagina;?>/listar/editar/id/<?=$dados['id'];?>">
          <i class="glyphicon glyphicon-edit icon-white"></i>
          Editar
          </a>
              
              <a data-href="excluir.php?id=<?=$dados['id'];?>" data-toggle="modal" data-target="#confirm-delete" href="#" class="btn btn-danger">
                <i class="glyphicon glyphicon-trash icon-white"></i>
                Deletar
                </a> <? } ?>
            </td>
        </tr>
     <? }?>
    </tbody>
								</table>
			<? }else if(Url::getURL(2) == "editar") {
		$id = Url::getURL(4);
		$query_editar = mysqli_query($conn,"SELECT * FROM usuario WHERE id = {$id}");
		$dados_editar = mysqli_fetch_array($query_editar);
			?>
			
  
		<form method="post" name="cadastro" id="cadastro" action="">
					<div class="col-md-6">
						<div class="form-group">
							<label for="telefone">Nome completo</label>
							<input name="nome" type="text" required class="form-control" id="nome" value="<?=$dados_editar['nome'];?>">
						</div>
						<div class="form-group">
							<label for="email">E-mail</label>
							<input required type="email" class="form-control" id="email" name="email" value="<?=$dados_editar['email'];?>">
						</div>						
				

					  <div class="form-group">
							<label for="senha">Digite a senha</label>
							<input required type="password" class="form-control" id="senha" name="senha" value="<?=$dados_editar['senha'];?>">
						</div>

						<div class="form-group">
							<label for="senha2">Digite novamente a senha para confirmar</label>
							<input required type="password" class="form-control" id="senha2" name="senha2" value="<?=$dados_editar['senha'];?>">
						</div>
						
					

		  </div>					
					<div class="col-md-12">
						<button type="submit" class="btn btn-success" onclick="return validar()">Salvar</button>
						<input name="editar" type="hidden" id="editar" value="1">
						<button type="button" class="btn btn-info" onClick="history.go(-1)">Voltar</button>
					</div>
				</form>	
			
			<? }?>
			
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
          <!-- Horizontal Form -->
          
          <!-- /.box -->
          <!-- general form elements disabled -->
          
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
		

    </section>

<script>
	
	$('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
			
			var teste = $('.debug-url').html($(this).find('.danger').attr('href'));
			
			$(document).on('click','#botaodeletar',function(e){
				e.preventDefault();
				var id = $(this).attr('href');
				
				var clickedID = id.split('=');
				var DbNumberID = clickedID[1];
				var tabela = '<?=$tabela;?>';				
			
			
				$.ajax({
    url:'<?=URL::getBase();?>modulos/excluir.php?acao=deletar',
    type: 'POST',
    data: {id: DbNumberID, tabela: tabela},
    success: function(result) {
      //  console.log(id);

		$('#confirm-delete').modal('hide');
		 $('#item_'+DbNumberID).fadeOut();
		 
		
    }



  });
		
				
				
     
 }); });
       
       
		</script>

