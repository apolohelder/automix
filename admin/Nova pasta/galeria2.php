<?
require("restrito.php"); 

?>

<link href="dist/css/jquery.dm-uploader.min.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

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
			
		<? if($_GET['listar'] == "mostrar") { 
	
			$id = intval($_GET['id']);
	
	       $queryalbum = mysqli_query($conn,"Select tbprodutos.id, tbprodutos.foto, tbcategoria.categoria, tbcategoria.id as id2
from tbprodutos
Join tbcategoria
On tbprodutos.categoria = tbcategoria.id WHERE tbcategoria.id = ".$id."");
	 		$dadostitulo = mysqli_fetch_array($queryalbum);
			
			?>
			
				<h3><?=$dadostitulo['categoria'];?></h3>	
	  <main role="main" class="container">

      

      <div class="row">
        <div class="col-md-6 col-sm-12">
          
          <!-- Our markup, the important part here! -->
          <div id="drag-and-drop-zone" class="dm-uploader p-5">
            <h3 class="mb-5 mt-5 text-muted">Arraste & solte</h3>

            <div class="btn btn-primary btn-block mb-5">
                <span>Escolher fotos</span>
                <input type="file" title='Clique para adicionar as fotos' />
            </div>
          </div><!-- /uploader -->
<div class="mt-2">
    	<a href="#" class="btn btn-primary" id="btnApiStart">
    		<i class="fa fa-play"></i> Iniciar
    	</a>
    	<a href="#" class="btn btn-danger" id="btnApiCancel">
    		<i class="fa fa-stop"></i> Parar
    	</a>
    </div>
        </div>
        <div class="col-md-6 col-sm-12">
          <div class="card h-100">
            <div class="card-header">
              Lista de fotos
            </div>

            <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
              <li class="text-muted text-center empty">Aguardando arquivos.</li>
            </ul>
          </div>
        </div>
      </div><!-- /file list -->

      <div class="row">
        <div class="col-12"></div>
      </div> <!-- /debug -->

    </main> <!-- /container -->

    <script src="dist/js/jquery.dm-uploader.min.js"></script>
    <script src="js/demo-ui.js"></script>
    <!--<script src="demo-config.js"></script>-->
 <script>
		  $(function(){
  /*
   * For the sake keeping the code clean and the examples simple this file
   * contains only the plugin configuration & callbacks.
   * 
   * UI functions ui_* can be located in:
   *   - assets/demo/uploader/js/ui-main.js
   *   - assets/demo/uploader/js/ui-multiple.js
   *   - assets/demo/uploader/js/ui-single.js
   */
  $('#drag-and-drop-zone').dmUploader({ //
   url: 'uploadfotos.php',
    maxFileSize: 15000000, // 15 Megs max
    auto: false,
    queue: true,
    onDragEnter: function(){
      // Happens when dragging something over the DnD area
      this.addClass('active');
    },
	  extraData: function() {
   return {
     "galleryid": <?=$_GET['id'];?>
   };
},
    onDragLeave: function(){
      // Happens when dragging something OUT of the DnD area
      this.removeClass('active');
    },
    onInit: function(){
      // Plugin is ready to use
      ui_add_log('Penguin initialized :)', 'info');
    },
    onComplete: function(){
      // All files in the queue are processed (success or error)
      ui_add_log('All pending tranfers finished');
	  $(location).attr('href', 'index.php?pg=produtos&listar=listar&ativo=15&link=24');
    },
    onNewFile: function(id, file){
      // When a new file is added using the file selector or the DnD area
      ui_add_log('New file added #' + id);
      ui_multi_add_file(id, file);
    },
    onBeforeUpload: function(id){
      // about tho start uploading a file
      ui_add_log('Starting the upload of #' + id);
      ui_multi_update_file_status(id, 'uploading', 'Enviando...');
      ui_multi_update_file_progress(id, 0, '', true);
    },
    onUploadProgress: function(id, percent){
      // Updating file progress
      ui_multi_update_file_progress(id, percent);
    },
    onUploadSuccess: function(id, data){
      // A file was successfully uploaded
      ui_add_log('Server Response for file #' + id + ': ' + JSON.stringify(data));
      ui_add_log('Upload of file #' + id + ' COMPLETED', 'success');
      ui_multi_update_file_status(id, 'success', 'Upload completo');
      ui_multi_update_file_progress(id, 100, 'success', false);
	  
    },
    onUploadCanceled: function(id) {
      ui_multi_update_file_status(id, 'warning', 'Cancelado');
      ui_multi_update_file_progress(id, 0, 'warning', false);
      ui_multi_update_file_controls(id, true, false);
    },
    onUploadError: function(id, xhr, status, message){
      ui_multi_update_file_status(id, 'danger', message);
      ui_multi_update_file_progress(id, 0, 'danger', false);  
    },
    onFallbackMode: function(){
      // When the browser doesn't support this plugin :(
      ui_add_log('Plugin cant be used here, running Fallback callback', 'danger');
    },
    onFileSizeError: function(file){
      ui_add_log('File \'' + file.name + '\' cannot be added: size excess limit', 'danger');
    }
  });

  /*
    Global controls
  */
  $('#btnApiStart').on('click', function(evt){
    evt.preventDefault();

    $('#drag-and-drop-zone').dmUploader('start');
  });

  $('#btnApiCancel').on('click', function(evt){
    evt.preventDefault();

    $('#drag-and-drop-zone').dmUploader('cancel');
  });
});
	 
$(document).ready(function(){

    // Delete
    $('.content div').click(function(){
        var id = this.id;
        var split_id = id.split("_");
		

        // Selecting image source
        var imgElement_src = $( '#img_'+split_id[1] ).attr("src");
        
        // AJAX request
        $.ajax({
            url: 'removerfotos.php',
            type: 'post',
            data: {path: imgElement_src, id:id },
            success: function(response){
				//console.log(id);
               // alert( response );
                // Changing image source when remove
				$('#item_'+split_id[1]).fadeOut();
               /* if(response == 1){
					
                    $("#img_" + split_id[1]).attr("src","images/noimage.png");
                }*/
            }
        });
    });
});
	  </script>
    <!-- File item template -->
    <script type="text/html" id="files-template">
      <li class="media">
        <div class="media-body mb-1">
          <p class="mb-2">
            <strong>%%filename%%</strong> - Status: <span class="text-muted">Aguardando</span>
          </p>
          <div class="progress mb-2">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
              role="progressbar"
              style="width: 0%" 
              aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
          <hr class="mt-1 mb-1" />
        </div>
      </li>
    </script>
			
			
			<div class="callout callout-success">                

                <p>Lista de fotos cadastradas nesta galeria.</p>
				
			</div>
<div class="container">
   
   <?php
   $id = intval($_GET['id']);
   $query = "SELECT * FROM tbgaleriafotos WHERE idgaleria = ".$id."";
   $result = mysqli_query($conn, $query);
   if(mysqli_num_rows($result) > 0)
   {
   ?>
   <div class="table-responsive">
    <table class="table table-bordered">
     <tr>
      <th>Fotos cadastradas</th>
      </tr>
   <?php
    while($row = mysqli_fetch_array($result))
    {
   ?>
     <tr id="item_<?=$row["id"];?>">
      <td><div class="img-thumbnail"><img src="uploadfotos/thumbs/<?=$row["foto"]; ?>" id='img_<?=$row["id"];?>' width="200" class="img-fluid">
		  <div id='delete_<?=$row["id"];?>' class="btn btn-block btn-danger">Deletar</div></div>
		  <input type="checkbox" name="customer_id[]" class="delete_customer" value="<?=$row["id"]; ?>" /></td>
      </tr>
   <?php
    }
   ?>
    </table>
  </div>
   <?php
   }
   ?>
   <div align="center">
    <button type="button" name="btn_delete" id="btn_delete" class="btn btn-success">Deletar arquivos selecionados</button>
   </div></div>
					
			
			
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
				
			 <a class="btn btn-success" href="index.php?pg=galeria2&listar=editar&id=<?=$dados['id'];?>&ativo=8&link=21">
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
//$(document).ready(function(){
 
 //$('#btn_delete').click(function(){
	
$(document).on("click", "#btn_delete", function () {
  
  if(confirm("Você tem certeza que deseja deletar?"))
  {
   var id = [];  

   
   $(':checkbox:checked').each(function(i){
	   
       id[i] = $(this).val(); 	
	   
	   
   });
   
   if(id.length === 0) //verifica se array tá em branco
   {
    alert("Por favor, escolha pelo menos uma foto para deletar.");
   }
   else
   {
    $.ajax({
     url:'excluirfotosgaleria.php',
     method:'POST',
     data:{id:id},
      success: function(response){ 
   // alert (response);
		
      for(var i=0; i<id.length; i++)
      {
       $('tr#item_'+id[i]+'').css('background-color', '#ccc');
       $('tr#item_'+id[i]+'').fadeOut('slow');
      }
     }
     
    });
   }
   
  }
  else
  {
   return false;
  }
 });
 
//});
</script>