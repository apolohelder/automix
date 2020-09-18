<? require("restrito.php"); 
/*foreach ($_SESSION as $key => $value) {
    print($key.' - '.$value.'<br>');
};*/

if(isset($_POST['editar']) && !empty($_POST['editar']))	{
	

	$id = 1;
		
	$query = mysqli_query($conn,"UPDATE tbtextos SET
	a1   = '{$_POST['a1']}',
	a2   = '{$_POST['a2']}',
	a3   = '{$_POST['a3']}',
	a4   = '{$_POST['a4']}',
	a5   = '{$_POST['a5']}',
	a6   = '{$_POST['a6']}',
	a7   = '{$_POST['a7']}',
	a8   = '{$_POST['a8']}'
	
	WHERE id  = '{$id}'") or die("Error: " . mysqli_error());
	
	echo '<script> alert("cadastro foi atualizado com sucesso!");  window.location="index.php?pg=endereco&listar=editar&ativo=3&link=10"; </script>';
		
	
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
		
		$query_editar = mysqli_query($conn,"SELECT * FROM tbtextos WHERE id = '1'");
		$dados_editar = mysqli_fetch_array($query_editar);
			?>
			
  
		<form method="post" name="editar" id="editar" action="">
					<div class="col-md-6">
						
				
						
						<div class="form-group">
							
							<input name="a1" type="text" required class="form-control" id="a1" value="<?=$dados_editar['a1'];?>">
						</div>
					  <div class="form-group">
					    <input name="a2" type="text" required class="form-control" id="a2" value="<?=$dados_editar['a2'];?>">
					  </div>	
						
					  <div class="form-group">
					    <textarea name="a3" rows="5" class="form-control" id="a3"><?=$dados_editar['a3'];?></textarea>
					  </div>
						
		
						
						<div class="form-group">
							
							<input name="a4" type="text" required class="form-control" id="a4" value="<?=$dados_editar['a4'];?>">
			  </div>
										
				  <div class="form-group">
					    <textarea name="a5" rows="5" class="form-control" id="a5"><?=$dados_editar['a5'];?></textarea>
					  </div>
					
					  <div class="form-group">
					  
					    <input name="a6" type="text" required class="form-control" id="a6" value="<?=$dados_editar['a6'];?>">
			  </div>
						
						  <div class="form-group">
					    <textarea name="a7" rows="5" class="form-control" id="a7"><?=$dados_editar['a7'];?></textarea>
					  </div>
						  <div class="form-group">
					  
					    <input name="a8" type="text" required class="form-control" id="a8" value="<?=$dados_editar['a8'];?>">
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
