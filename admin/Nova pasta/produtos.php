<? require("restrito.php"); 
/*foreach ($_SESSION as $key => $value) {
    print($key.' - '.$value.'<br>');
};*/



if(isset($_POST['cadastrar']) && !empty($_POST['cadastrar']))	{
	
	$categoriaprodutos = $_POST['categoriaprodutos'];
    $categoria = $_POST['categoria'];
  	$foto = $_POST['nomefoto'];	
	
	
	$query = mysqli_query($conn,"INSERT INTO tbprodutos (categoria,foto,categoriaprodutos) VALUES ('$categoria','$foto','$categoriaprodutos')")  or die (mysqli_error($conn));
	
	echo '<script> alert("Produto foi cadastrado com sucesso!"); window.location="index.php?pg=produtos&listar=listar&id=1&ativo=15&link=24"; </script>';
	

	
}

if(isset($_POST['editar']) && !empty($_POST['editar']))	{
	
	
	$id = intval($_GET['id']);

			
	$query = mysqli_query($conn,"UPDATE tbprodutos SET
	 categoria   = '{$_POST['categoria']}',
	 foto = '{$_POST['nomefoto']}',
	 categoriaprodutos = '{$_POST['categoriaprodutos']}'

	 WHERE id  = '{$id}'") or die("Error: " . mysqli_error($conn));
	
	echo '<script> alert("Produto foi atualizado com sucesso!");  window.location="index.php?pg=produtos&listar=listar&id=1&ativo=15&link=24"; </script>';
	
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
                   
                        return 'MENU >> Lista de produtos';
                   
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
                    url:'upload_produtos.php',
                    type:'post',
                    data:fd,
                    contentType: false,
                    processData: false,
                    success:function(response){
						 var src = "uploadprodutos/original/";
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
        produtos</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
        <li class="active">Lista de produtos</li>
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
					<label for="senha2">Categoria</label>
							<div>
					<select name="categoriaprodutos" required="required" class="form-control selectpicker" id="categoriaprodutos" data-live-search="true">
						<option value="">Escolha uma categoria</option>
                      <? $query = mysqli_query($conn,"SELECT * FROM tbcategoriaprodutos order by categoria asc");
						 while($dados = mysqli_fetch_array($query)){ ?>
                      <option value="<?=$dados['id'];?>"><?=$dados['categoria'];?></option>
                     <? }?>
                    </select></div>
						</div>	
						
					
				  <div class="form-group">
					<label for="senha2">SubCategoria</label>
							<div>
					<select name="categoria" required="required" class="form-control selectpicker" id="categoria" data-live-search="true">
						<option value="">Escolha uma categoria</option>
                      <? $query = mysqli_query($conn,"SELECT * FROM tbcategoria order by categoria asc");
						 while($dados = mysqli_fetch_array($query)){ ?>
                      <option value="<?=$dados['id'];?>"><?=$dados['categoria'];?></option>
                     <? }?>
                    </select></div>
						</div>					 					
						
					
				
						
						<div class="form-group">
							<label for="foto">Foto da Capa</label>
					 <div class="input-group">
						 
  <span class="input-group-btn">
    <span class="btn btn-primary" onclick="$(this).parent().find('input[type=file]').click();">Escolher foto inicial</span>
    <input name="file" id="file" onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());" style="display: none;" type="file">
  </span>
  <span class="form-control"></span>
						
						  </div>	</div>
						 <div class="form-group">				
			<div class='preview'>
                <img src="uploadprodutos/default2.png" id="img" width="200">
            </div>
			</div><input name="nomefoto" type="hidden" id="nomefoto">					
					
					  
						
					</div>
					
					<div class="col-md-12">
						<button type="submit" class="btn btn-success" id="enviarnoticia" disabled>Enviar</button>
						<input name="cadastrar" type="hidden" id="cadastrar" value="1">
				  </div>
		  </form>
			
			
	<? } if($_GET['listar'] == "listar") { ?>
		<a href="index.php?pg=produtos&listar=mostrar&ativo=1&link=24"><div class="btn btn-success" style="margin: 10px;">CADASTRAR PRODUTOS</div></a>	
		<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th width="70%">CATEGORIA</th>
            <th width="30%">OPÇÕES</th>
            </tr>
    </thead>
    <tfoot>
        <tr>
            <th>CATEGORIA</th>
            <th>OPÇÕES</th>
            </tr>
    </tfoot>
    <tbody>
       <? $query = mysqli_query($conn,"Select tbprodutos.id, tbprodutos.foto, tbcategoria.categoria, tbcategoriaprodutos.categoria as categoriaprincipal
from tbprodutos
Join tbcategoria
On tbprodutos.categoria = tbcategoria.id
JOIN tbcategoriaprodutos
ON tbprodutos.categoriaprodutos = tbcategoriaprodutos.id
");
					while ($dados = mysqli_fetch_array($query)) {
		?>
        <tr id="item_<?=$dados['id'];?>">
            <td><?=$dados['categoriaprincipal'];?> - <?=$dados['categoria'];?></td>
            <td>
			
		 <a class="btn btn-success" href="index.php?pg=galeria2&listar=mostrar&id=<?=$dados['id'];?>&ativo=1&link=24">
              <i class="glyphicon glyphicon-arrow-up icon-white"></i>
              Adicionar Fotos
              </a>
				
		  <a class="btn btn-info" href="index.php?pg=produtos&listar=editar&id=<?=$dados['id'];?>&ativo=1&link=24">
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
		
		$query_editar = mysqli_query($conn,"Select tbprodutos.id, tbprodutos.foto, tbcategoria.categoria, tbcategoria.id as id2, tbprodutos.categoriaprodutos as id3
from tbprodutos
Join tbcategoria
On tbprodutos.categoria = tbcategoria.id 
JOIN tbcategoriaprodutos
ON tbcategoriaprodutos.id = tbprodutos.categoriaprodutos
WHERE tbprodutos.id = {$_GET['id']}");
		$dados_editar = mysqli_fetch_array($query_editar);
			?>
			
  
		<form name="editar" id="editar" method="post" action="">
					<div class="col-md-6">
						
					    <div class="form-group">
						  <label for="subgrupo">Categoria</label>
					<? $queryempresa = mysqli_query($conn,"select * from tbcategoriaprodutos where id = ".$dados_editar['id3']."");
					   $dadosempresa = mysqli_fetch_array($queryempresa);?>
							<select name="categoriaprodutos" class="form-control selectpicker" id="categoriaprodutos" data-live-search="true">
                      <option value="<?=$dadosempresa['id'];?>" selected="selected"><?=$dadosempresa['categoria'];?></option>
					<? $queryempresa2 = mysqli_query($conn,"select * from tbcategoriaprodutos where id != ".$dados_editar['id3']."");
					   while($dadosempresa2 = mysqli_fetch_array($queryempresa2)) { ?>
                     <option <?php if ($dados_editar['id3'] == $dadosempresa2['id'] ) { echo "selected"; } ?> value="<?=$dadosempresa2['id'];?>"><?=$dadosempresa2['categoria'];?></option>
    				 <? }?>
        </select>
					  </div>		
					
				    <div class="form-group">
						  <label for="subgrupo">SubCategoria</label>
					<? $queryempresa = mysqli_query($conn,"select * from tbcategoria where id = ".$dados_editar['id2']."");
					   $dadosempresa = mysqli_fetch_array($queryempresa);?>
							<select name="categoria" class="form-control selectpicker" id="categoria" data-live-search="true">
                      <option value="<?=$dadosempresa['id'];?>" selected="selected"><?=$dadosempresa['categoria'];?></option>
					<? $queryempresa2 = mysqli_query($conn,"select * from tbcategoria where id != ".$dados_editar['id2']."");
					   while($dadosempresa2 = mysqli_fetch_array($queryempresa2)) { ?>
                     <option <?php if ($dados_editar['id2'] == $dadosempresa2['id'] ) { echo "selected"; } ?> value="<?=$dadosempresa2['id'];?>"><?=$dadosempresa2['categoria'];?></option>
    				 <? }?>
        </select>
					  </div>					 					
						
										
						<div class="form-group">
							<label for="foto">Foto da Capa</label>
					 <div class="input-group">
						 
  <span class="input-group-btn">
    <span class="btn btn-primary" onclick="$(this).parent().find('input[type=file]').click();">Escolher foto inicial</span>
    <input name="file" id="file" onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());" style="display: none;" type="file">
  </span>
  <span class="form-control"></span>
						
						  </div>	</div>
						 <div class="form-group">				
			<div class='preview'>
				<? if(empty($dados_editar['foto'])) { ?>
                <img src="uploadprodutos/default2.png" id="img" width="200">
				<? }else{ ?>
			  <img src="uploadprodutos/thumbs/<?=$dados_editar['foto'];?>" id="img" width="200">
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
    url:'excluir.php?acao=deletarprodutos',
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
