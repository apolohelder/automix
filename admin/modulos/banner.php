
<? require("restrito.php");
/*foreach ($_SESSION as $key => $value) {
    print($key.' - '.$value.'<br>');
};*/
$tabela = 'tbbanners';
$pagina = 'banner';

if(isset($_POST['cadastrar']) && !empty($_POST['cadastrar']))	{
	
	

$link = $_POST['link'];
$foto = $_POST['nomefoto'];
$foto2 = $_POST['nomefoto2'];


	
	$query = mysqli_query($conn,"INSERT INTO ".$tabela." (link,foto,foto2) VALUES ('$link','$foto','$foto2')")  or die (mysqli_error($conn));
	//$last_id = mysqli_insert_id($conn);
	//print $last_id;
			
    echo '<script> bootbox.alert("Cadastro foi efetuado com sucesso!", function(){  location.href = "'.URL::getBase().''.$pagina.'/listar/listar";  })</script>';

		

}

if(isset($_POST['editar']) && !empty($_POST['editar']))	{
	


	$id = intval(Url::getURL(4));


	$query = mysqli_query($conn,"UPDATE ".$tabela." SET
	 link   = '{$_POST['link']}',
	 foto   = '{$_POST['nomefoto']}',
	 foto2   = '{$_POST['nomefoto2']}'
	 WHERE id  = '{$id}'") or die("Error: " . mysqli_error());
	
	
	  echo '<script> bootbox.alert("Cadastro foi atualizado com sucesso!", function(){  location.href = "'.URL::getBase().''.$pagina.'/listar/listar";  })</script>';
	
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
		 "order": [[0, "desc"]]
    } );
} );
///////////////////////// 
  $(document).ready(function(){
			
			
			
			
			$("#enviarnoticia").text("Aguardando os dados");
			//$("#enviarnoticia").html('Aguardando os dados');

            $("#file").change(function(){
				
				$('#enviarnoticia2').text('Aguardando os dados').prop('disabled', true);
				
				
                var fd = new FormData();

                var files = $('#file')[0].files[0];

                fd.append('file',files);

                $.ajax({
                    url:'<?php echo URL::getBase() ?>modulos/upload_banner.php',
                    type:'post',
                    data:fd,
                    contentType: false,
                    processData: false,
                    success:function(response){
						 var src = "<?php echo URL::getBase() ?>uploadbanner/original/";
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
	
	///////////////////////
$(document).ready(function(){
			
			
			
			
		
            $("#file2").change(function(){
							
				
				
                var fd = new FormData();

                var files = $('#file2')[0].files[0];

                fd.append('file',files);

                $.ajax({
                    url:'<?php echo URL::getBase() ?>modulos/upload_banner.php',
                    type:'post',
                    data:fd,
                    contentType: false,
                    processData: false,
                    success:function(response){
						 var src = "<?php echo URL::getBase() ?>uploadbanner/original/";
                        if(response != 0){
                            //$("#img").attr("src",response);
							$("#img2").attr("src", src + response);
                            $('.preview2 img').show();
							var texto = response;
							texto = texto.replace(/^\s+|\s+$/g,"");
							$('#nomefoto2').val(texto);	
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

<style type="text/css">


/*.progress {
	height: 1.5rem;
}

*/

.preview-img {
	width: 64px;
	height: 64px;
}

.dm-uploader {
	border: 0.25rem dashed #A5A5C7;
}
.dm-uploader.active {
	border-color: red;

	border-style: solid;
}

.progress {
	height: 1.5rem;
}

#files {
    overflow-y: scroll !important;
    min-height: 320px;
}
@media (min-width: 768px) {
	#files {
		min-height: 0;
	}
}


</style>

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
        Gerenciamento de Banners</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
        <li class="active">Lista de banners cadastradas</li>
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
					
					
					<div class="row">
  <div class="col-md-6"><!-- Stack the columns on mobile by making one full-width and the other half-width -->


<div class="row">
  <div class="col-md-8"><div class="form-group">
						  <label for="endereco">Link</label>
						  <input name="link" type="url" class="form-control" id="link" placeholder="http://www.uol.com.br">
						</div>	</div>

</div>
<div class="form-group">
							<label for="foto">Foto Principal</label>
(DESKTOP) Tamanho máximo 1920x700 Pixel
<div class="input-group">
						 
  <span class="input-group-btn">
    <span class="btn btn-primary" onclick="$(this).parent().find('input[type=file]').click();">Escolher foto para desktop</span>
    <input name="file" id="file" onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());" style="display: none;" type="file">
  </span>
  <span class="form-control"></span>
						
						  </div>
						</div><div class="form-group">				
			<div class='preview'>
                <img src="<?=URL::getBase() ?>images/default2.png" id="img" width="200">
            </div>
			</div><input name="nomefoto" type="hidden" id="nomefoto">
	  
	  <div class="form-group">
							<label for="foto">Foto Principal</label>
(CELULAR) Tamanho máximo 700x700 Pixel				        
<div class="input-group">
						 
  <span class="input-group-btn">
    <span class="btn btn-primary" onclick="$(this).parent().find('input[type=file]').click();">Escolher foto para celular</span>
    <input name="file2" id="file2" onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());" style="display: none;" type="file">
  </span>
  <span class="form-control"></span>
						
						  </div>
			  </div><div class="form-group">				
			<div class='preview2'>
                <img src="<?=URL::getBase() ?>images/default2.png" id="img2" width="200">
            </div>
			</div><input name="nomefoto2" type="hidden" id="nomefoto2">

</div>
						
					

				
						  
</div>
						
					<div class="col-md-12" style="margin-top: 10px;">
						<button type="submit" class="btn btn-success" id="enviarnoticia" disabled>Cadastrar</button>
						<button type="button" class="btn btn-info" onClick="history.go(-1)">Voltar</button>
						<input name="cadastrar" type="hidden" id="cadastrar" value="1">
				  </div>
		  </form>
			
			
	<? }    if(Url::getURL(2) == "listar") { ?>
		<a href="<?=URL::getBase(); ?><?=$pagina;?>/listar/mostrar"><div class="btn btn-success" style="margin: 10px;">CADASTRAR BANNER</div></a>	
		<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
    <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>LINK</th>
          <th>IMAGEM DESKTOP</th>
          <th>IMAGEM CELULAR</th>
            <th>OPÇÕES</th>
            </tr>
    </thead>
    <tfoot class="table-dark">
        <tr>
          <th>ID</th>
          <th>LINK</th>
          <th>IMAGEM DESKTOP</th>
          <th>IMAGEM CELULAR</th>
            <th>OPÇÕES</th>
            </tr>
    </tfoot>
    <tbody>
       <? $query = mysqli_query($conn,"Select *  from tbbanners");
					while ($dados = mysqli_fetch_array($query)) {
		?>
        <tr id="item_<?=$dados['id'];?>">
          <td align="center"><?=$dados['id'];?></td>
			<td><a href="<?=$dados['link'];?>" target="_blank"><?=$dados['link'];?></a></td>
          <td><? if(!empty($dados['foto'])) { ?><img src="<?php echo URL::getBase() ?>uploadbanner/thumbs/<?=$dados['foto'];?>" width="150"/><? } else { echo "Inserir banner versão DESKTOP"; } ?></td>
          <td><? if(!empty($dados['foto2'])) { ?><img src="<?php echo URL::getBase() ?>uploadbanner/thumbs/<?=$dados['foto2'];?>" width="150"/><? } else { echo "Inserir banner versão CELULAR"; } ?></td>
            <td>
				
						
			<a class="btn btn-info btn-responsive" href="<?=URL::getBase(); ?><?=$pagina;?>/listar/editar/id/<?=$dados['id'];?>">
          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>

          Editar
          </a>
              
              <a class="btn btn-danger btn-responsive" data-href="excluir.php?id=<?=$dados['id'];?>" data-toggle="modal" data-target="#confirm-delete" href="#" >
               <i class="fa fa-trash-o" aria-hidden="true"></i>
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
			
  
	<form name="editar" id="editar" method="post" action="">
					
					
				<div class="row">
  <div class="col-md-6"><!-- Stack the columns on mobile by making one full-width and the other half-width -->


<div class="row">
  <div class="col-md-8"><div class="form-group">
						  <label for="endereco">Link</label>
						  <input name="link" type="url" class="form-control" id="link" placeholder="http://www.uol.com.br" value="<?=$dados_editar['link'];?>">
						</div>	</div>

</div>
<div class="form-group">
							<label for="foto">Foto Principal (Desktop)  Tamanho máximo 1920x700 Pixel</label>
					 <div class="input-group">
						 
  <span class="input-group-btn">
    <span class="btn btn-primary" onclick="$(this).parent().find('input[type=file]').click();">Escolher foto principal</span>
    <input name="file" id="file" onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());" style="display: none;" type="file">
  </span>
  <span class="form-control"></span>
						
		      </div>	</div>
						 <div class="form-group">				
			<div class='preview'>
				<? if(empty($dados_editar['foto'])) { ?>
                <img src="<?=URL::getBase() ?>uploadbanner/default2.png" id="img" width="200">
				<? }else{ ?>
			  <img src="<?=URL::getBase() ?>uploadbanner/thumbs/<?=$dados_editar['foto'];?>" id="img" width="200">
				<? } ?>
              
            </div>
			</div><input name="nomefoto" type="hidden" id="nomefoto" value="<?=$dados_editar['foto'];?>">
	  
<div class="form-group">
							<label for="foto">Foto Principal (Celular)  Tamanho máximo 700x700 Pixel</label>
					 <div class="input-group">
						 
  <span class="input-group-btn">
    <span class="btn btn-primary" onclick="$(this).parent().find('input[type=file]').click();">Escolher foto principal</span>
    <input name="file2" id="file2" onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());" style="display: none;" type="file">
  </span>
  <span class="form-control"></span>
						
			    </div>	
			  </div>
			  <div class="form-group">				
			<div class='preview2'>
				<? if(empty($dados_editar['foto2'])) { ?>
                <img src="<?=URL::getBase() ?>uploadbanner/default2.png" id="img2" width="200">
				<? }else{ ?>
			  <img src="<?=URL::getBase() ?>uploadbanner/thumbs/<?=$dados_editar['foto2'];?>" id="img2" width="200">
				<? } ?>
              
            </div>
			</div><input name="nomefoto2" type="hidden" id="nomefoto2" value="<?=$dados_editar['foto2'];?>">

</div>
						
					

				
						  
</div>
						
					<div class="col-md-12" style="margin-top: 10px;">
						<button type="submit" class="btn btn-success">Salvar</button>
						<button type="button" class="btn btn-info" onClick="history.go(-1)">Voltar</button>
						<input name="editar" type="hidden" id="editar" value="1">
				  </div>
		  </form>
			
			<? }
			?>
			
			 <main role="main" class="container">
<input name="gallery" type="hidden" id="gallery" value="<?=$id;?>"><!-- /file list --><!-- /debug -->

    </main> <!-- /container --></div>
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
	$(document).ready(function(){
  $('input').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue',
    increaseArea: '20%' // optional
  });
});
	
	  //iCheck for checkbox and radio inputs
   /* $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })*/
	
	$('#valor').mask('#.##0,00', {reverse: true});
	$('#km').mask("##.#00", {reverse: true, maxlength: false});
	$("#placa").inputmask({mask: ['AAA-9999','AAA9A99']});
	
	$('#anofabricacao').keyup(function() {
  $(this).val(this.value.replace(/\D/g, ''));
});
		$('#anomodelo').keyup(function() {
  $(this).val(this.value.replace(/\D/g, ''));
});
	
	

/*$('#anomodelo').bind('keyup', function(e){
           if(e.keyCode < 47 || e.keyCode >57 ){
               alert(" esse e um campo apenas numerico");
               $(this).val("");
           }
       });*/


	
/*	$(document).ready(function(){
    $("#placa").inputmask({mask: ['AAA-9999','AAA9A99']});
		

});*/
	
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


<script src="<?php echo URL::getBase() ?>dist/js/jquery.dm-uploader.min.js"></script>
<script src="<?php echo URL::getBase() ?>dist/js/demo-ui.js"></script>
<!--    <script src="<?php echo URL::getBase() ?>dist/js/demo-config.js"></script>-->
 <script>
	$(function(){
  /*
   * For the sake keeping the code clean and the examples simple this file
   * contains only the plugin configuration & callbacks.
   * 
   * UI functions ui_* can be located in: demo-ui.js
   */
  $('#drag-and-drop-zone').dmUploader({ //
    url: '<?=URL::getBase();?>modulos/uploadfotos.php',
    maxFileSize: 15000000, // 15 Megs max
	allowedTypes: 'image/*',
	extFilter: ["jpg", "jpeg","png","gif"],
    auto: false,
    queue: true,
    onDragEnter: function(){
      // Happens when dragging something over the DnD area
      this.addClass('active');
    },
	  extraData: function(id) {
   return {
     "galleryid": $('#gallery').val()
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
		$(location).attr('href', '<?=URL::getBase();?>veiculos/listar/listar');
    },
    onNewFile: function(id, file){
      // When a new file is added using the file selector or the DnD area
      ui_add_log('New file added #' + id);
      ui_multi_add_file(id, file);
		 if (typeof FileReader !== "undefined"){
        var reader = new FileReader();
        var img = $('#uploaderFile' + id).find('img');
        
        reader.onload = function (e) {
          img.attr('src', e.target.result);
        }
        reader.readAsDataURL(file);
      }
    },
    onBeforeUpload: function(id){
		
      // about tho start uploading a file
      ui_add_log('Starting the upload of #' + id);
      ui_multi_update_file_status(id, 'uploading', 'Enviando...');
      ui_multi_update_file_progress(id, 0, '', true);
    },
    onUploadCanceled: function(id) {
      // Happens when a file is directly canceled by the user.
      ui_multi_update_file_status(id, 'warning', 'Cancelado');
      ui_multi_update_file_progress(id, 0, 'warning', false);
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


	  </script>
    <!-- File item template -->
    <script type="text/html" id="files-template">
      <li class="media">
	    <img class="mr-3 mb-2 preview-img" src="https://danielmg.org/assets/image/noimage.jpg?v=v10" alt="Generic placeholder image">
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


<script>
//$(document).ready(function(){
 
 //$('#btn_delete').click(function(){
	
$(document).on("click", "#btn_delete", function () {
	
	
	        bootbox.confirm({
    title: "Confirmação?",
    message: "Você tem certeza que deseja excluir? Esse procedimento é irreversível.",
    buttons: {
        cancel: {
            label: '<i class="fa fa-times"></i> Cancelar',
			className: 'btn-danger'
        },
        confirm: {
            label: '<i class="fa fa-check"></i> Confirmar',
			className: 'btn-success'
        }
    },
    callback: function (result) {
		
		            if(result){
						
						var id = [];  

   
   $(':checkbox:checked').each(function(i){
	   
       id[i] = $(this).val(); 	
	   
	   
   });
						  if(id.length === 0) //verifica se array tá em branco
   {
   // alert("Por favor, escolha pelo menos uma foto para deletar.");
	   bootbox.alert("Por favor, escolha pelo menos uma foto para deletar.");
   }
   else
   {
    $.ajax({
     url:'<?=URL::getBase(); ?>modulos/excluirfotosgaleria.php',
     method:'POST',
     data:{id:id},
      success: function(response){ 
     // alert (response);
		
      for(var i=0; i<id.length; i++)
      {
       $('#item_'+id[i]+'').css('background-color', '#ccc');
       $('#item_'+id[i]+'').fadeOut('slow');
      }
     }
     
    });
   }

             

            }
		
        //console.log('This was logged in the callback: ' + result);
    }
});
	
	
	///////////////////////////////////////////////////
  
 
 });
 
//});
</script>
