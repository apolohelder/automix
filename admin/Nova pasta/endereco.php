<? require("restrito.php"); 
/*foreach ($_SESSION as $key => $value) {
    print($key.' - '.$value.'<br>');
};*/

if(isset($_POST['editar']) && !empty($_POST['editar']))	{
	

	$id = 1;
		
	$query = mysqli_query($conn,"UPDATE tbendereco SET
	telefoneprime   = '{$_POST['telefoneprime']}',
	telefonemega   = '{$_POST['telefonemega']}',
	enderecoprime  = '{$_POST['enderecoprime']}',
	enderecomega  = '{$_POST['enderecomega']}',
	emailprime  = '{$_POST['emailprime']}',
	emailmega  = '{$_POST['emailmega']}',
	telefonetopo  = '{$_POST['telefonetopo']}',
	emailtopo  = '{$_POST['emailtopo']}',
	enderecohorarios  = '{$_POST['enderecohorarios']}',
	telefonewhats  = '{$_POST['telefonewhats']}'
	WHERE id  = '{$id}'") or die("Error: " . mysqli_error());
	
	echo '<script> alert("cadastro foi atualizado com sucesso!");  window.location="index.php?pg=endereco&listar=editar&ativo=6&link=18"; </script>';
		
	
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
        Dados do site<small></small>
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
			
						
					 
				 
				
			
			
	<? } if($_GET['listar'] == "listar") { ?>
		<a href="index.php?pg=endereco&listar=mostrar&ativo=1&link=20"><div class="btn btn-success" style="margin: 10px;">CADASTRAR endereco</div></a>
		<? }else if($_GET['listar'] == "editar") {
		
		$query_editar = mysqli_query($conn,"SELECT * FROM tbendereco WHERE id = '1'");
		$dados_editar = mysqli_fetch_array($query_editar);
			?>
			
  
		<form method="post" name="editar" id="editar" action="">
					<div class="col-md-6">
						
				
                <div class="bg-light-blue-active color-palette"><span>LOJA PRIME</span></div>               
              
						
						<div class="form-group">
							<label for="telefonewhats">Telefone</label>
							<input name="telefoneprime" type="text" required class="form-control" id="telefoneprime" value="<?=$dados_editar['telefoneprime'];?>">
						</div>
					  <div class="form-group">
					    <label for="telefonewhats">Endereço</label>
					    <input name="enderecoprime" type="text" required class="form-control" id="enderecoprime" value="<?=$dados_editar['enderecoprime'];?>">
						</div>	
						
					  <div class="form-group">
					    <label for="telefonewhats">Email</label>
					    <input name="emailprime" type="text" class="form-control" id="emailprime" value="<?=$dados_editar['emailprime'];?>">
						</div>
						
		  </div>
			<div class="col-md-6">
						<div class="bg-light-blue-active color-palette">MEGA LOJA</div>
						<div class="form-group">
							<label for="telefonewhats">Telefone</label>
							<input name="telefonemega" type="text" required class="form-control" id="telefonemega" value="<?=$dados_editar['telefonemega'];?>">
			  </div>
					  <div class="form-group">
					    <label for="telefonewhats">Endereço</label>
					    <input name="enderecomega" type="text" required class="form-control" id="enderecomega" value="<?=$dados_editar['enderecomega'];?>">
			  </div>	
						
					  <div class="form-group">
					    <label for="telefonewhats">Email</label>
					    <input name="emailmega" type="text" class="form-control" id="emailmega" value="<?=$dados_editar['emailmega'];?>">
			  </div>
						
		  </div>
				<div class="col-md-6">
						<div class="bg-light-blue-active color-palette">DADOS DOS TOPO DO SITE</div>
						<div class="form-group">
							<label for="telefonewhats">Telefone</label>
							<input name="telefonetopo" type="text" required class="form-control" id="telefonetopo" value="<?=$dados_editar['telefonetopo'];?>">
			  </div>
										
				  <div class="form-group">
				    <label for="telefonewhats">Email</label>
				    <input name="emailtopo" type="text" class="form-control" id="emailtopo" value="<?=$dados_editar['emailtopo'];?>">
			  </div>
					
					  <div class="form-group">
					    <label for="telefonewhats">Horários</label>
					    <input name="enderecohorarios" type="text" required class="form-control" id="enderecohorarios" value="<?=$dados_editar['enderecohorarios'];?>">
			  </div>
						
		  </div>
			<div class="col-md-6">
						<div class="bg-light-blue-active color-palette">TELEFONE DO WHATSAPP</div>
						<div class="form-group">
							<label for="telefonewhats">Telefone</label>
							<input name="telefonewhats" type="text" required class="form-control" id="telefonewhats" placeholder="Cuidado ao formato. Ex: 5592999968575" value="<?=$dados_editar['telefonewhats'];?>">
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
    url:'excluir.php?acao=deletarendereco',
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
