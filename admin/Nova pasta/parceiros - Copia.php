<? require("restrito.php"); 
/*foreach ($_SESSION as $key => $value) {
    print($key.' - '.$value.'<br>');
};*/



if(isset($_POST['cadastrar']) && !empty($_POST['cadastrar']))	{	
    
  	$foto = $_POST['nomefoto'];		
	
	$query = mysqli_query($conn,"INSERT INTO tbbannerparceiros (foto) VALUES ('$foto')")  or die (mysqli_error($conn));
	
	echo '<script> alert("Banner de parceiros foi cadastrado com sucesso!"); window.location="index.php?pg=parceiros&listar=listar&id=1&ativo=15&link=24"; </script>';
	

	
}

if(isset($_POST['editar']) && !empty($_POST['editar']))	{	
	
	$id = intval($_GET['id']);
			
	$query = mysqli_query($conn,"UPDATE tbbannerparceiros SET
	
	foto = '{$_POST['nomefoto']}'

	 WHERE id  = '{$id}'") or die("Error: " . mysqli_error($conn));
	
	echo '<script> alert("Banner de parceiros foi atualizado com sucesso!");  window.location="index.php?pg=parceiros&listar=listar&id=1&ativo=15&link=24"; </script>';
	
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
                   
                        return 'MENU >> Lista de banner';
                   
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
<script type="text/javascript">

        $(document).ready(function(){
			
			
			
			
			$("#enviarnoticia").text("Aguardando os dados");
			//$("#enviarnoticia").html('Aguardando os dados');

            $("#file").change(function(){
				
				$('#enviarnoticia2').text('Aguardando os dados').prop('disabled', true);
				
				
                var fd = new FormData();

                var files = $('#file')[0].files[0];

                fd.append('file',files);

                $.ajax({
                    url:'upload_banner_parceiros.php',
                    type:'post',
                    data:fd,
                    contentType: false,
                    processData: false,
                    success:function(response){
						 var src = "uploadbannerparceiros/original/";
                        if(response != 0){
                            //$("#img").attr("src",response);
							$("#img").attr("src", src + response);
                            $('.preview img').show();
							var texto = response;
							texto = texto.replace(/^\s+|\s+$/g,"");
							$('#nomefoto').val(texto);	
							//$('#nomefoto').val(response);
							$("#enviarnoticia").removeAttr('disabled');
							$("#enviarnoticia").text("Enviar");
							$("#enviarnoticia2").removeAttr('disabled');
							$("#enviarnoticia2").text("Enviar");
							
							//console.log(texto);
							
							
                        }else{
                            alert('Arquivo não enviado');
                        }
                    }
                });
            });
        });


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
        banner parceiros</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
        <li class="active">Lista de banner parceiros</li>
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
							<label for="foto">Banner Home Parceiros *(Altura mínima: 150px)</label>
					 <div class="input-group">
						 
  <span class="input-group-btn">
    <span class="btn btn-primary" onclick="$(this).parent().find('input[type=file]').click();">Escolher foto</span>
    <input name="file" id="file" onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());" style="display: none;" type="file">
  </span>
  <span class="form-control"></span>
						
						  </div>	</div>
						 <div class="form-group">				
			<div class='preview'>
                <img src="uploadbanner/default2.png" id="img" width="200">
            </div>
			</div><input name="nomefoto" type="hidden" id="nomefoto">					
					
					  
						
					</div>
					
					<div class="col-md-12">
						<button type="submit" class="btn btn-success" id="enviarnoticia" disabled>Enviar</button>
						<input name="cadastrar" type="hidden" id="cadastrar" value="1">
				  </div>
		  </form>
			
			
	<? } if($_GET['listar'] == "listar") { ?>
		<a href="index.php?pg=parceiros&listar=mostrar&ativo=17&link=36"><div class="btn btn-success" style="margin: 10px;">CADASTRAR BANNER PARCEIROS</div></a>	
		<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th width="70%">IMAGEM</th>
            <th width="30%">OPÇÕES</th>
            </tr>
    </thead>
    <tfoot>
        <tr>
            <th>IMAGEM</th>
            <th>OPÇÕES</th>
            </tr>
    </tfoot>
    <tbody>
       <? $query = mysqli_query($conn,"Select * from tbbannerparceiros");
				while ($dados = mysqli_fetch_array($query)) {
		?>
        <tr id="item_<?=$dados['id'];?>">
            <td><img src="uploadbannerparceiros/thumbs/<?=$dados['foto'];?>"/></td>
            <td>
			
					
		  <a class="btn btn-info" href="index.php?pg=parceiros&listar=editar&id=<?=$dados['id'];?>&ativo=17&link=36">
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
		
		$query_editar = mysqli_query($conn,"Select *
from tbbannerparceiros
WHERE tbbannerparceiros.id = {$_GET['id']}");
		$dados_editar = mysqli_fetch_array($query_editar);
			?>
			
  
		<form name="editar" id="editar" method="post" action="">
					<div class="col-md-6">
					
										
						<div class="form-group">
							<label for="foto">Banner Home Parceiros *(Altura mínima: 150px)</label>
					 <div class="input-group">
						 
  <span class="input-group-btn">
    <span class="btn btn-primary" onclick="$(this).parent().find('input[type=file]').click();">Escolher foto</span>
    <input name="file" id="file" onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());" style="display: none;" type="file">
  </span>
  <span class="form-control"></span>
						
						  </div>	</div>
						 <div class="form-group">				
			<div class='preview'>
				<? if(empty($dados_editar['foto'])) { ?>
                <img src="uploadbanner/default2.png" id="img" width="200">
				<? }else{ ?>
			  <img src="uploadbannerparceiros/thumbs/<?=$dados_editar['foto'];?>" id="img">
				<? } ?>
              
            </div>
			</div><input name="nomefoto" type="hidden" id="nomefoto" value="<?=$dados_editar['foto'];?>">
											
						
					</div>
					
					<div class="col-md-12">
						<button type="submit" class="btn btn-success" id="enviarnoticia2">Enviar</button>
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
    url:'excluir.php?acao=deletarparceiros',
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
