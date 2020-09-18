<?
require("restrito.php"); 

if(isset($_POST['cadastrar']) && !empty($_POST['cadastrar']))	{


	
    $titulo = $_POST['titulo'];
	$categoria = $_POST['categoria'];
	$foto = $_POST['nomefoto'];

	
	
	$query = mysqli_query($conn,"INSERT INTO tbgaleria (titulo,categoria,foto) VALUES ('$titulo','$categoria','$foto')")  or die (mysqli_error($conn));
	
	echo '<script> alert("cadastro foi efetuado com sucesso!"); window.location="index.php?pg=galeria&listar=listar&ativo=8&link=213"; </script>';
	

}

if(isset($_POST['editar']) && !empty($_POST['editar']))	{
	
	$id = intval($_GET['id']);
			
	$query = mysqli_query($conn,"UPDATE tbgaleria SET
	 titulo   = '{$_POST['titulo']}',
	 categoria    = '{$_POST['categoria']}',
	 foto = '{$_POST['nomefoto']}'

	 WHERE id  = '{$id}'") or die("Error: " . mysqli_error($conn));
	
	echo '<script> alert("cadastro foi atualizado com sucesso!");  window.location="index.php?pg=galeria&listar=listar&ativo=8&link=21"; </script>';
	
	
}
?>
<style type="text/css">
.preview{
	
    width: 150px;
   /* height: 100px;*/
    border: 1px solid black;   
    background: white;
}

/*.preview img{
    display: block;
}*/
</style>


<style type="text/css">
.colors {
  
   display: none;
}
</style>

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
                   
                        return 'MENU >> Lista de galeria';
                   
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
			
			$("#enviarusuarios").text("Enviar");

            $("#file").change(function(){
				
				$('#enviarusuarios').text('Aguardando os dados').prop('disabled', true);
				$('#enviarusuarios2').text('Aguardando os dados').prop('disabled', true);

                var fd = new FormData();

                var files = $('#file')[0].files[0];

                fd.append('file',files);

                $.ajax({
                    url:'uploadgaleria.php',
                    type:'post',
                    data:fd,
                    contentType: false,
                    processData: false,
                    success:function(response){
						 var src = "uploadgaleria/original/";
                        if(response != 0){
                            //$("#img").attr("src",response);
							$("#img").attr("src", src + response);
                            $('.preview img').show();
							$('#nomefoto').val(response);
							
							$("#enviarusuarios").removeAttr('disabled');
							$("#enviarusuarios").text("Enviar");
							$("#enviarusuarios2").removeAttr('disabled');
							$("#enviarusuarios2").text("Enviar");
							
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


   <div class="modal fade" id="confirm-delete6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirma&ccedil;&atilde;o</h4>
                </div>
            
                <div class="modal-body">
                    <p>Voc&ecirc; tem certeza que deseja desativar?</p>                    
                    <!--<p class="debug-url"></p>-->
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <a href="#" class="btn btn-warning warning" id="botaodeletar6">Desativar</a>
                </div>
            </div>
        </div>
    </div>

 <div class="modal fade" id="confirm-delete7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirma&ccedil;&atilde;o</h4>
                </div>
            
                <div class="modal-body">
                    <p>Voc&ecirc; tem certeza que deseja ativar?</p>                    
                    <!--<p class="debug-url"></p>-->
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <a href="#" class="btn btn-success success" id="botaodeletar7">Ativar</a>
                </div>
            </div>
        </div>
    </div>


<section class="content-header">
      <h1>Lista de álbuns</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
        <li class="active">Lista de álbuns</li>
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
			
						 
				 
					
					<div id="div2" >
						<div class="col-md-6">
				<form name="cadastro2" id="cadastro2" method="post" action="">
					
				  <div class="form-group">
					<label for="senha2">Título</label>
						  <input required type="text" class="form-control" id="titulo" name="titulo">
					  </div>
				
						
				  <div class="form-group">
							<label for="senha2">Categoria</label>
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
							<label for="foto">Foto de destaque</label>
					 <div class="input-group">
						 
  <span class="input-group-btn">
    <span class="btn btn-primary" onclick="$(this).parent().find('input[type=file]').click();">Escolher foto</span>
    <input name="file" id="file" onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());" style="display: none;" type="file">
  </span>
  <span class="form-control"></span>
						
						  </div>	</div>

				 
			 <div class="form-group">				
			<div class='preview'>
                <img src="upload/default.png" id="img" width="150">
            </div>
			</div><input name="nomefoto" type="hidden" id="nomefoto">
				
					<div>
					  <button type="submit" class="btn btn-success" id="enviarusuarios">Enviar</button>
						<input name="cadastrar" type="hidden" id="cadastrar" value="1">
				  </div>
					  </form>
					 </div>
			  </div>
		  
			
			
			
	<? } if($_GET['listar'] == "listar") { ?>
		<a href="index.php?pg=galeria&listar=mostrar&ativo=8&link=21"><div class="btn btn-success" style="margin: 10px;">CADASTRAR GALERIA</div></a>	
		<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>TÍTULO</th>
            <th>CATEGORIA</th>
            <th>OPÇÕES</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>TÍTULO</th>
            <th>CATEGORIA</th>
            <th>OPÇÕES</th>
        </tr>
    </tfoot>
    <tbody>
       <? $query = mysqli_query($conn,"Select tbg.id, tbg.titulo, tbc.categoria from tbgaleria tbg Join tbcategoria tbc On tbg.categoria = tbc.id");
					while ($dados = mysqli_fetch_array($query)) {
		?>
        <tr id="item_<?=$dados['id'];?>">
            <td><?=$dados['titulo'];?></td>
            <td><?=$dados['categoria'];?></td>
            <td> 
				
			 <a class="btn btn-success" href="index.php?pg=galeria2&listar=mostrar&id=<?=$dados['id'];?>&ativo=8&link=21">
              <i class="glyphicon glyphicon-arrow-up icon-white"></i>
              Adicionar Fotos
              </a>
				
			 <a class="btn btn-info" href="index.php?pg=galeria&listar=editar&id=<?=$dados['id'];?>&ativo=8&link=21">
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
		
		$query_editar = mysqli_query($conn,"SELECT * FROM tbgaleria WHERE id = {$_GET['id']}");
		$dados_editar = mysqli_fetch_array($query_editar);
			?>
			
  
		<form name="cadastro3" id="cadastro3" method="post" action="">
					
						<div class="form-group">
							<label for="senha2">Título</label>
							<input name="titulo" type="text" required class="form-control" id="titulo" value="<?=$dados_editar['titulo'];?>">
						</div>
						
							<div class="form-group">
						  <label for="subgrupo">Categoria</label>
					<? $querysetor = mysqli_query($conn,"select * from tbcategoria where id = ".$dados_editar['categoria']."");
					   $dadossetor = mysqli_fetch_array($querysetor);?>
							<select name="categoria" class="form-control selectpicker" id="categoria" data-live-search="true">
                      <option value="<?=$dadossetor['id'];?>" selected="selected"><?=$dadossetor['categoria'];?></option>
					<? $querysetor2 = mysqli_query($conn,"select * from tbcategoria where id != ".$dados_editar['categoria']."");
					   while($dadossetor2 = mysqli_fetch_array($querysetor2)) { ?>
                     <option <?php if ($dados_editar['categoria'] == $dadossetor2['id'] ) { echo "selected"; } ?> value="<?=$dadossetor2['id'];?>"><?=$dadossetor2['categoria'];?></option>
    				 <? }?>
        </select>
						</div>
						
				
						
					
						<div class="form-group">
							<label for="foto">Foto de destaque</label>
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
                <img src="uploadgaleria/default.png" id="img" width="150">
				<? }else{ ?>
			  <img src="uploadgaleria/thumbs/<?=$dados_editar['foto'];?>" id="img" >
				<? } ?>
					
            </div>
			</div><input name="nomefoto" type="hidden" id="nomefoto" value="<?=$dados_editar['foto'];?>">
				
					<div>
					  <button type="submit" class="btn btn-success" id="enviarusuarios2">Enviar</button>
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
    url:'excluir.php?acao=deletargaleria',
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
