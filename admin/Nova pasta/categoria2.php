<? require("restrito.php"); 
/*foreach ($_SESSION as $key => $value) {
    print($key.' - '.$value.'<br>');
};*/

if(isset($_POST['cadastrar']) && !empty($_POST['cadastrar']))	{
	


	
    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];
    $url = $_POST['url'];


	
	if(strlen($categoria) != 0){
			 $sel_login = mysqli_query($conn,"SELECT * FROM tbcategoria2 WHERE categoria='$categoria'");
			 $conta_login = mysqli_num_rows($sel_login);
		if($conta_login != 0){
			alert('Já existe um cadastro com este nome de categoria.');
		}else{	
	
	
	$query = mysqli_query($conn,"INSERT INTO tbcategoria2 (categoria,descricao,url) VALUES ('$categoria','$descricao','$url')")  or die (mysqli_error());
			
	
	echo '<script> alert("cadastro foi efetuado com sucesso!"); window.location="index.php?pg=categoria2&listar=mostrar&ativo=2&link=20"; </script>';
	

		}
	}
}

if(isset($_POST['editar']) && !empty($_POST['editar']))	{
	
	$categoria = $_POST['categoria'];

	$id = intval($_GET['id']);
	
	if(strlen($categoria) != 0){
			 $sel_login = mysqli_query($conn,"SELECT * FROM tbcategoria2 WHERE categoria='$categoria' && id !='$id'");
			 $conta_login = mysqli_num_rows($sel_login);
		if($conta_login != 0){
			alert('Já existe um cadastro com este nome de categoria.');
			
		}else{
	
	
	$query = mysqli_query($conn,"UPDATE tbcategoria2 SET
	 categoria   = '{$_POST['categoria']}',
	 descricao   = '{$_POST['descricao']}',
	 url   = '{$_POST['url']}'
	 WHERE id  = '{$id}'") or die("Error: " . mysqli_error());
	
	echo '<script> alert("cadastro foi atualizado com sucesso!");  window.location="index.php?pg=categoria2&listar=listar&ativo=2&link=20"; </script>';
	
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
<script>
$(document).ready(function(){
      $('input[name=favorite]').on("click",function(){
    var id    = $(this).prop('id');

    if($(this).prop('checked')) {
        var favorite = 1;
    } else {
        var favorite = 0;
    }

    $.ajax({
        type:'POST',
        url:'updateustaus.php',
        data:'id= ' + id + '&favorite='+favorite
    });
    console.log('id: ' + id );

 }); });	
</script>
   <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirma&ccedil;&atilde;o</h4>
                </div>
            
                <div class="modal-body">
                    <p>Voc&ecirc; tem certeza que deseja excluir? Esse procedimento &eacute; irrevers&iacute;vel.</p>                    
                    <!--<p class="debug-url"></p>-->
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
        Categoria de serviços<small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
        <li class="active">Lista de categoria de fotos</li>
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
			
		<? if($_GET['listar'] == "mostrar") { ?>
			
						
					 
				 
				<form name="cadastro" id="cadastro" method="post" action="">
					<div class="col-md-6">
					
						<div class="form-group">
						  <label for="endereco">Nome da categoria</label>
						  <input name="categoria" type="text" required class="form-control" id="categoria" placeholder="Ex: segurança">
						</div>	
						
					  <div class="form-group">
					    <label for="endereco">Descrição</label>
					    <input name="descricao" type="text" required class="form-control" id="descricao" placeholder="Ex: Itens de segurança - Alarmes - Travas elétricas - Rastreadores - Bloqueadores - Películas anti-vandalismo ">
						</div>
					  <div class="form-group">
					    <label for="endereco">Endereço do site</label>
					    <input name="url" type="url" class="form-control" id="url" placeholder="http://www.servitech-am.com.br">
						</div>
						
					</div>
					
					<div class="col-md-12">
						<button type="submit" class="btn btn-success">Enviar</button>
						<input name="cadastrar" type="hidden" id="cadastrar" value="1">
				  </div>
		  </form>
			
			
	<? } if($_GET['listar'] == "listar") { ?>
		<a href="index.php?pg=categoria2&listar=mostrar&ativo=2&link=20"><div class="btn btn-success" style="margin: 10px;">CADASTRAR CATEGORIA</div></a>	
		<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
    <thead>
        <tr>
          <th width="80%">CATEGORIA</th>
            <th width="12%">OPÇÕES</th>
            </tr>
    </thead>
    <tfoot>
        <tr>
          <th>CATEGORIA</th>
            <th>OPÇÕES</th>
            </tr>
    </tfoot>
    <tbody>
       <? $query = mysqli_query($conn,"SELECT * FROM tbcategoria2");
					while ($dados = mysqli_fetch_array($query)) {
		?>
        <tr id="item_<?=$dados['id'];?>">
          <td><b><?=$dados['categoria'];?></b> - <?=$dados['descricao'];?></td>
            <td><a class="btn btn-info" href="index.php?pg=categoria2&listar=editar&id=<?=$dados['id'];?>&ativo=2&link=6">
          <i class="glyphicon glyphicon-edit icon-white"></i>
          Editar
          </a>
              
              <a data-href="excluir.php?id=<?=$dados['id'];?>" data-toggle="modal" data-target="#confirm-delete" href="#" class="btn btn-danger">
                <i class="glyphicon glyphicon-trash icon-white"></i>
                Deletar
                </a></td>
            </tr>
     <? }?>
    </tbody>
								</table>
			<? }else if($_GET['listar'] == "editar") {
		
		$query_editar = mysqli_query($conn,"SELECT * FROM tbcategoria2 WHERE id = {$_GET['id']}");
		$dados_editar = mysqli_fetch_array($query_editar);
			?>
			
  
		<form method="post" name="editar" id="editar" action="">
					<div class="col-md-6">
						<div class="form-group">
							<label for="categoria">Categoria</label>
							<input name="categoria" type="text" required class="form-control" id="categoria" placeholder="Ex: segurança" value="<?=$dados_editar['categoria'];?>">
						</div>
					  <div class="form-group">
					    <label for="endereco">Descrição</label>
					    <input name="descricao" type="text" required class="form-control" id="descricao" placeholder="Ex: Itens de segurança - Alarmes - Travas elétricas - Rastreadores - Bloqueadores - Películas anti-vandalismo " value="<?=$dados_editar['descricao'];?>">
						</div>	
						
					  <div class="form-group">
					    <label for="endereco">Endereço do site</label>
					    <input name="url" type="url" class="form-control" id="url" placeholder="http://www.servitech-am.com.br" value="<?=$dados_editar['url'];?>">
						</div>
						
		  </div>					
					<div class="col-md-12">
						<button type="submit" class="btn btn-success">Salvar</button>
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
				
			
			
				$.ajax({
    url:'excluir.php?acao=deletarcategoria2',
    type: 'POST',
    data:'id='+DbNumberID,
    success: function(result) {
        console.log(id);

		$('#confirm-delete').modal('hide');
		 $('#item_'+DbNumberID).fadeOut();
		 
		
    }



  });
		
				
				
     
 }); });
       
       
		</script>
