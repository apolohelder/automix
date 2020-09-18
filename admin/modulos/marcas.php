<?
require("restrito.php");

/*foreach ($_SESSION as $key => $value) {
    print($key.' - '.$value.'<br>');
};*/
$tabela = 'tbmarcas';
$pagina = 'marcas';

if(isset($_POST['cadastrar']) && !empty($_POST['cadastrar']))	{
	
	
    $marca = $_POST['marca'];
	
	if(strlen($marca) != 0){
			 $sel_login = mysqli_query($conn,"SELECT * FROM ".$tabela." WHERE marca='$marca'");
			 $conta_login = mysqli_num_rows($sel_login);
		if($conta_login != 0){
			
			echo '<script> bootbox.alert("Já existe um cadastro com este nome de marca.")</script>';
			
		}else{	
	
	
	$query = mysqli_query($conn,"INSERT INTO ".$tabela." (marca) VALUES ('$marca')")  or die (mysqli_error());
			
	 echo '<script> bootbox.alert("Cadastro foi efetuado com sucesso!", function(){  location.href = "'.URL::getBase().''.$pagina.'/listar/listar";  })</script>';
			
		

		}
	}
}

if(isset($_POST['editar']) && !empty($_POST['editar']))	{
	
	$marca = $_POST['marca'];

	$id = intval(Url::getURL(4));
	
	if(strlen($marca) != 0){
			 $sel_login = mysqli_query($conn,"SELECT * FROM ".$tabela." WHERE marca='$marca' && id !='$id'");
			 $conta_login = mysqli_num_rows($sel_login);
		if($conta_login != 0){
			
			echo '<script> bootbox.alert("Já existe um cadastro com este nome de marca.")</script>';
			
		}else{
	
	
	$query = mysqli_query($conn,"UPDATE ".$tabela." SET
	 marca   = '{$_POST['marca']}'
	 WHERE id  = '{$id}'") or die("Error: " . mysqli_error());
	
			 echo '<script> bootbox.alert("Cadastro foi atualizado com sucesso!", function(){  location.href = "'.URL::getBase().''.$pagina.'/listar/listar";  })</script>';
	
		} 
	}
}
?>


<script type="text/javascript" language="javascript" class="init">
	
$(function () {
	$.fn.dataTable.moment('DD/MM/YYYY');    //Formatação sem Hora
 
    $('#example').DataTable( {
		"scrollX": true,
		 dom: 'Bfrtip',
		"pageLength": 20,
        buttons: [
            {
                extend: 'print',
                messageTop: function () {                    
                   
                        return 'MENU >> Lista de categorias';
                   
                },
                messageBottom: null
            }
        ],
        	 "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.13/i18n/Portuguese-Brasil.json"
        },
		 "order": [[0, "asc"]]
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
        Gerenciamento de Marcas<small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
        <li class="active">Lista de marcas cadastradas</li>
      </ol>
    </section>


<section class="content container-fluid">

      <!--------------------------
        | Conteúdo da página |
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
						  <label for="endereco">Marca</label>
						  <input name="marca" type="text" required class="form-control" id="marca" placeholder="Ex: Ford">
						</div>							
						
					</div>
					
					<div class="col-md-12">
						<button type="submit" class="btn btn-success">Cadastrar</button>
						<button type="button" class="btn btn-info" onClick="history.go(-1)">Voltar</button>
						<input name="cadastrar" type="hidden" id="cadastrar" value="1">
				  </div>
		  </form>
			
			
	<? }    if(Url::getURL(2) == "listar") { ?>
		<a href="<?=URL::getBase(); ?><?=$pagina;?>/listar/mostrar"><div class="btn btn-success" style="margin: 10px;">CADASTRAR MARCA</div></a>	
		<table id="example" class="table table-hover table-striped table-bordered" width="100%" cellspacing="0">
    <thead class="table-dark">
        <tr>
          <th width="80%">MARCA</th>
            <th width="12%">OPÇÕES</th>
            </tr>
    </thead>
    <tfoot class="table-dark">
        <tr>
          <th>MARCA</th>
            <th>OPÇÕES</th>
            </tr>
    </tfoot>
    <tbody>
       <? $query = mysqli_query($conn,"SELECT * FROM ".$tabela."");
					while ($dados = mysqli_fetch_array($query)) {
		?>
        <tr id="item_<?=$dados['id'];?>">
          <td><a href="<?=URL::getBase(); ?><?=$pagina;?>/listar/editar/id/<?=$dados['id'];?>"><?=$dados['marca'];?></a></td>
            <td><a class="btn btn-info btn-responsive" href="<?=URL::getBase(); ?><?=$pagina;?>/listar/editar/id/<?=$dados['id'];?>">
          <i class="glyphicon glyphicon-edit icon-white"></i>
          Editar
          </a>
              
              <a data-href="excluir.php?id=<?=$dados['id'];?>" data-toggle="modal" data-target="#confirm-delete" href="#" class="btn btn-danger btn-responsive">
                <i class="glyphicon glyphicon-trash icon-white"></i>
                Deletar
                </a></td>
            </tr>
     <? }?>
    </tbody>
		</table>
			<? }else if(Url::getURL(2) == "editar") {
	
		$id = Url::getURL(4);
		
		$query_editar = mysqli_query($conn,"SELECT * FROM ".$tabela." WHERE id = {$id}");
		$dados_editar = mysqli_fetch_array($query_editar);
			?>
			
  
		<form method="post" name="editar" id="editar" action="">
			
					<div class="col-md-6">
						<div class="form-group">
							<label for="marca">Marca</label>
							<input name="marca" type="text" required class="form-control" id="marca" placeholder="Ex: Ford" value="<?=$dados_editar['marca'];?>">
						</div>					
						
		  </div>					
					<div class="col-md-12">
						<button type="submit" class="btn btn-success">Salvar</button>
						<button type="button" class="btn btn-info" onClick="history.go(-1)">Voltar</button>
						<input name="editar" type="hidden" id="editar" value="1">
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
			//data:'id='+DbNumberID,
			data: {id: DbNumberID, tabela: tabela},
			success: function(result) {
        	//console.log(tabela);

			$('#confirm-delete').modal('hide');
		 	$('#item_'+DbNumberID).fadeOut();
		 
		
    }

  });			
     
 }); });       
       
</script>
