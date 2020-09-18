<? require("restrito.php"); 
/*foreach ($_SESSION as $key => $value) {
    print($key.' - '.$value.'<br>');
};*/

if(isset($_POST['cadastrar']) && !empty($_POST['cadastrar']))	{
	


	$grupo = $_POST['grupo'];
    $subgrupo = $_POST['subgrupo'];


	
	if(strlen($subgrupo) != 0){
			 $sel_login = mysqli_query($conn,"SELECT * FROM tbsubgrupo WHERE subgrupo='$subgrupo' && grupo='$grupo'");
			 $conta_login = mysqli_num_rows($sel_login);
		if($conta_login != 0){
			alert('Já existe um cadastro com esta relação.');
		}else{	
	
	
	$query = mysqli_query($conn,"INSERT INTO tbsubgrupo (grupo,subgrupo) VALUES ('$grupo','$subgrupo')")  or die (mysqli_error());
	
	echo '<script> alert("cadastro foi efetuado com sucesso!"); window.location="index.php?pg=subgrupo&listar=mostrar&ativo=1"; </script>';
	

		}
	}
}

if(isset($_POST['editar']) && !empty($_POST['editar']))	{
	
	$subgrupo = $_POST['subgrupo'];
	$id = $_GET['id'];
	
	if(strlen($subgrupo) != 0){
			 $sel_login = mysqli_query($conn,"SELECT * FROM tbsubgrupo WHERE subgrupo='$subgrupo' && grupo='$grupo' && id !='$id'");
			 $conta_login = mysqli_num_rows($sel_login);
		if($conta_login != 0){
			alert('Já existe um cadastro com este nome de subgrupo.');
			
		}else{
	
	
	$query = mysqli_query($conn,"UPDATE tbsubgrupo SET
	 grupo   = '{$_POST['grupo']}',
	 subgrupo   = '{$_POST['subgrupo']}'
	 WHERE id  = '{$id}'") or die("Error: " . mysqli_error());
	
	echo '<script> alert("cadastro foi atualizado com sucesso!");  window.location="index.php?pg=subgrupo&listar=listar&ativo=1"; </script>';
	
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
                   
                        return 'MENU >> Lista de solicitações';
                   
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
        Grupos<small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
        <li class="active">Lista de grupos</li>
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
							<label for="nome">Grupo</label>
							<div>
					<select name="grupo" required="required" class="form-control selectpicker" id="grupo" data-live-search="true">
						<option value="">Escolha um grupo</option>
                      <? $query = mysqli_query($conn,"SELECT * FROM tbgrupo order by grupo asc");
						 while($dados = mysqli_fetch_array($query)){ ?>
                      <option value="<?=$dados['id'];?>"><?=$dados['grupo'];?></option>
                     <? }?>
                    </select></div>
						</div>
					
						<div class="form-group">
						  <label for="endereco">Nome do subgrupo</label>
						  <input required type="text" class="form-control" id="subgrupo" name="subgrupo">
						</div>	
						
					</div>
					
					<div class="col-md-12">
						<button type="submit" class="btn btn-success">Enviar</button>
						<input name="cadastrar" type="hidden" id="cadastrar" value="1">
				  </div>
		  </form>
			
			
	<? } if($_GET['listar'] == "listar") { ?>
		<a href="index.php?pg=subgrupo&listar=mostrar&link=3&ativo=1"><div class="btn btn-success" style="margin: 10px;">CADASTRAR SUBGRUPO</div></a>	
		<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th width="80%">SUBGRUPO</th>
            <th width="20%">OPÇÕES</th>
            </tr>
    </thead>
    <tfoot>
        <tr>
            <th>SUBGRUPO</th>
            <th>OPÇÕES</th>
            </tr>
    </tfoot>
    <tbody>
       <? $query = mysqli_query($conn,"Select sg.id, g.grupo, sg.subgrupo
from tbgrupo as g
Join tbsubgrupo as sg
On g.id = sg.grupo");
					while ($dados = mysqli_fetch_array($query)) {
		?>
        <tr id="item_<?=$dados['id'];?>">
            <td><b><?=$dados['grupo'];?></b> - <?=$dados['subgrupo'];?></td>
            <td><a class="btn btn-info" href="index.php?pg=subgrupo&listar=editar&id=<?=$dados['id'];?>&link=3&ativo=1">
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
		
		$query_editar = mysqli_query($conn,"SELECT * FROM tbsubgrupo WHERE id = {$_GET['id']}");
		$dados_editar = mysqli_fetch_array($query_editar);
			?>
			
  
		<form method="post" name="editar" id="editar" action="">
					<div class="col-md-6">
						<div class="form-group">
						  <label for="grupo">Grupo</label>
					<? $queryen = mysqli_query($conn,"select * from tbgrupo where id = ".$dados_editar['grupo']."");
					   $dadosen = mysqli_fetch_array($queryen);?>
							<select name="grupo" class="form-control selectpicker" id="grupo" data-live-search="true">
                      <option value="<?=$dadosen['id'];?>" selected="selected"><?=$dadosen['grupo'];?></option>
					<? $queryuser5 = mysqli_query($conn,"select * from tbgrupo where id != ".$dados_editar['grupo']."");
					   while($dadosuser5 = mysqli_fetch_array($queryuser5)) { ?>
                     <option <?php if ($dados_editar['grupo'] == $dadosuser5['id'] ) { echo "selected"; } ?> value="<?=$dadosuser5['id'];?>"><?=$dadosuser5['grupo'];?></option>
    				 <? }?>
        </select>
						</div>
						
						<div class="form-group">
							<label for="subgrupo">subgrupo</label>
							<input name="subgrupo" type="text" required class="form-control" id="subgrupo" value="<?=$dados_editar['subgrupo'];?>">
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
    url:'excluir.php?acao=deletarsubgrupo',
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
