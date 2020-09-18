<? require("restrito.php");
/*foreach ($_SESSION as $key => $value) {
    print($key.' - '.$value.'<br>');
};*/
$tabela = 'tbveiculos';
$pagina = 'veiculos';

if(isset($_POST['cadastrar']) && !empty($_POST['cadastrar']))	{
	
	
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
	
	if(strlen($modelo) != 0){
			 $sel_login = mysqli_query($conn,"SELECT * FROM ".$tabela." WHERE modelo='$modelo'");
			 $conta_login = mysqli_num_rows($sel_login);
		if($conta_login != 0){
			alert('Já existe um cadastro com este nome de modelo.');
		}else{	
	
	
	$query = mysqli_query($conn,"INSERT INTO ".$tabela." (marca,modelo) VALUES ('$marca','$modelo')")  or die (mysqli_error());
			
	
	echo '<script> alert("cadastro foi efetuado com sucesso!"); window.location="'.URL::getBase().''.$pagina.'/listar/listar"; </script>';
	

		}
	}
}

if(isset($_POST['editar']) && !empty($_POST['editar']))	{
	
	$modelo = $_POST['modelo'];

	$id = intval(Url::getURL(4));
	
	if(strlen($modelo) != 0){
			 $sel_login = mysqli_query($conn,"SELECT * FROM ".$tabela." WHERE modelo='$modelo' && id !='$id'");
			 $conta_login = mysqli_num_rows($sel_login);
		if($conta_login != 0){
			alert('Já existe um cadastro com este nome de modelo.');
			
		}else{
	
	
	$query = mysqli_query($conn,"UPDATE ".$tabela." SET
	 marca   = '{$_POST['marca']}',
	 modelo   = '{$_POST['modelo']}'
	 WHERE id  = '{$id}'") or die("Error: " . mysqli_error());
	
	echo '<script> alert("cadastro foi atualizado com sucesso!"); window.location="'.URL::getBase().''.$pagina.'/listar/listar"; </script>';
	
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
<script type="text/javascript">
$(document).ready(function(){
$('#modelo').selectpicker('refresh');
    $("#marca").change(function(){
        var marcaid = $(this).val();		

        $.ajax({
            url: '<?=URL::getBase(); ?>modulos/modeloid.php',
            type: 'post',
            data: {marca:marcaid},
            dataType: 'json',
            success:function(response){
				
				console.log(response);

                var len = response.length;

                $("#modelo").empty();
				$("#modelo").append("<option value=''>Escolha um modelo</option>");
                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var modelo = response[i]['modelo'];
					//console.log(marcaid);
                    
                    $("#modelo").append("<option value='"+id+"'>"+modelo+"</option>");
					$('#modelo').selectpicker('refresh');

                }
            }
        });
    });


});
///////////////////////////////////////////////////////
$(document).ready(function(){
$('#municipio').selectpicker('refresh');
    $("#estado").change(function(){
        var estadoid = $(this).val();		

        $.ajax({
            url: '<?=URL::getBase(); ?>modulos/municipioid.php',
            type: 'post',
            data: {estado:estadoid},
            dataType: 'json',
            success:function(response){
							

                var len = response.length;

                $("#municipio").empty();
				$("#municipio").append("<option value=''>Escolha um município</option>");
                for( var i = 0; i<len; i++){
                    var uf = response[i]['uf'];
                    var nome = response[i]['nome'];
					//console.log(estadoid);
                    
                    $("#municipio").append("<option value='"+uf+"'>"+nome+"</option>");
					$('#municipio').selectpicker('refresh');

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
        Gerenciamento de Veiculos</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
        <li class="active">Lista de veiculos cadastradas</li>
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
  <div class="col-xs-12 col-md-6"><div class="form-group">
							<label for="nome">Marca</label>
							<div>
					<select name="marca" required="required" class="form-control selectpicker" id="marca" data-live-search="true">
						<option value="">Escolha um grupo</option>
                      <? $query = mysqli_query($conn,"SELECT * FROM tbmarcas order by marca asc");
						 while($dados = mysqli_fetch_array($query)){ ?>
                      <option value="<?=$dados['id'];?>"><?=$dados['marca'];?></option>
                     <? }?>
                    </select></div>
						</div></div>
  <div class="col-md-6"><div class="form-group">
							<label for="nome">Modelo</label>
							<div>
					<select name="modelo" required="required" class="form-control selectpicker" id="modelo" data-live-search="true">
						<option value="">Aguardando escolha</option>                     
                    </select></div>
						</div></div>
</div>


<div class="row">
  <div class="col-md-6"><div class="form-group">
						  <label for="endereco">Versão do Veículo</label>
						  <input name="versao" type="text" required class="form-control" id="versao" placeholder="Ex: Elite 1.8 Automático">
						</div>	</div>
  <div class="col-md-6"><div class="form-group">
						  <label for="endereco">Quilometragem</label>
						  <input name="km" type="text" required class="form-control" id="km" placeholder="Ex: 16.510 ou 0 para Zero KM">
						</div>	</div>
  
</div>

<!-- Columns are always 50% wide, on mobile and desktop -->
<div class="row">
  <div class="col-xs-4"><div class="form-group">
						  <label for="endereco">Cor</label>
						  <input name="cor" type="text" required class="form-control" id="cor" placeholder="Ex: Azul">
						</div></div>
  <div class="col-xs-4"><div class="form-group">
						  <label for="endereco">Ano Fabricação</label>
						  <input name="anofabricacao" type="text" required class="form-control" id="anofabricacao" placeholder="Ex: 2010">
						</div></div>
  <div class="col-xs-4"><div class="form-group">
						  <label for="endereco">Ano Modelo</label>
						  <input name="anomodelo" type="text" required class="form-control" id="anomodelo" placeholder="Ex: 2010">
						</div></div>
</div>
						<div class="row">
  <div class="col-xs-4"><div class="form-group">
							<label for="nome">Combustível</label>
							<div>
					<select name="combustivel" required="required" class="form-control selectpicker" id="combustivel" data-live-search="true">
						<option value="">Escolha o tipo de combustível</option>
                      <? $query = mysqli_query($conn,"SELECT * FROM tbcombustivel order by combustivel asc");
						 while($dados = mysqli_fetch_array($query)){ ?>
                      <option value="<?=$dados['id'];?>"><?=$dados['combustivel'];?></option>
                     <? }?>
                    </select></div>
						</div></div>
  <div class="col-xs-4"><div class="form-group">
							<label for="nome">Portas</label>
							<div>
					<select name="combustivel" required="required" class="form-control selectpicker" id="combustivel" data-live-search="true">
						<option value="">Escolha o número de portas</option>
                      <? $query = mysqli_query($conn,"SELECT * FROM tbportas order by portas asc");
						 while($dados = mysqli_fetch_array($query)){ ?>
                      <option value="<?=$dados['id'];?>"><?=$dados['portas'];?></option>
                     <? }?>
                    </select></div>
						</div></div>
  <div class="col-xs-4"><div class="form-group">
							<label for="nome">Câmbio</label>
							<div>
					<select name="combustivel" required="required" class="form-control selectpicker" id="combustivel" data-live-search="true">
						<option value="">Escolha o tipo de câmbio</option>
                      <? $query = mysqli_query($conn,"SELECT * FROM tbcambio order by cambio asc");
						 while($dados = mysqli_fetch_array($query)){ ?>
                      <option value="<?=$dados['id'];?>"><?=$dados['cambio'];?></option>
                     <? }?>
                    </select></div>
						</div></div>
</div>
						<div class="row">
  <div class="col-md-6"><div class="form-group">
							<label for="nome">Estado</label>
							<div>
					<select name="estado" required="required" class="form-control selectpicker" id="estado" data-live-search="true">
						<option value="">Escolha um estado</option>
                      <? $query = mysqli_query($conn,"SELECT * FROM tbestado order by nome asc");
						 while($dados = mysqli_fetch_array($query)){ ?>
                      <option value="<?=$dados['uf'];?>"><?=$dados['nome'];?></option>
                     <? }?>
                    </select></div>
						</div>	</div>
  <div class="col-md-6"><div class="form-group">
							<label for="nome">Município</label>
							<div>
					<select name="municipio" required="required" class="form-control selectpicker" id="municipio" data-live-search="true">
						<option value="">Aguardando escolha</option>                     
                    </select></div>
						</div>	</div>
  
</div>
						<div class="row">
  <div class="col-xs-4"><div class="form-group">
							<label for="nome">Ofertas</label>
							<div>
					<select name="ofertas" required="required" class="form-control selectpicker" id="ofertas" data-live-search="true">
						<option value="">Escolha uma ofertas</option>
                      <? $query = mysqli_query($conn,"SELECT * FROM tbofertas order by oferta asc");
						 while($dados = mysqli_fetch_array($query)){ ?>
                      <option value="<?=$dados['id'];?>"><?=$dados['oferta'];?></option>
                     <? }?>
                    </select></div>
						</div></div>
  <div class="col-xs-4"><div class="form-group">
						  <label for="endereco">Placa</label>
						  <input name="placa" type="text" required class="form-control" id="placa" placeholder="Ex: JXS-8400 ou JXS8E00">
						</div></div>
  <div class="col-xs-4"><div class="form-group">
						  <label for="endereco">Valor</label>
						  <input name="valor" type="text" required class="form-control" id="valor" placeholder="Ex: 27.500">
						</div></div>
</div>
						
						
<div class="row">
  <div class="col-md-12"><div class="form-group">
						  <label for="endereco">Descrição</label>
						 <textarea name="descricao" id="descricao" class="form-control"></textarea>
						</div>	</div>

  
</div></div>
  <div class="col-md-6"><div class="form-group">
						  <label for="endereco">coluna do lado</label>
						  <input name="modelo" type="text" required class="form-control" id="modelo" placeholder="Ex: Siena">
						</div></div>
  
</div>
					
						

						
					
					
					<div class="col-md-12">
						<button type="submit" class="btn btn-success">Cadastrar</button>
						<input name="cadastrar" type="hidden" id="cadastrar" value="1">
				  </div>
		  </form>
			
			
	<? }    if(Url::getURL(2) == "listar") { ?>
		<a href="<?=URL::getBase(); ?><?=$pagina;?>/listar/mostrar"><div class="btn btn-success" style="margin: 10px;">CADASTRAR VEÍCULO</div></a>	
		<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
    <thead>
        <tr>
          <th width="80%">MARCA / MODELO</th>
            <th width="12%">OPÇÕES</th>
            </tr>
    </thead>
    <tfoot>
        <tr>
          <th>MARCA / MODELO</th>
            <th>OPÇÕES</th>
            </tr>
    </tfoot>
    <tbody>
       <? $query = mysqli_query($conn,"Select ma.id as idmarca, mo.id as idmodelo, ma.marca, mo.modelo
from tbmarcas as ma
Join tbmodelos as mo
On ma.id = mo.marca");
					while ($dados = mysqli_fetch_array($query)) {
		?>
        <tr id="item_<?=$dados['idmodelo'];?>">
          <td><a href="<?=URL::getBase(); ?><?=$pagina;?>/listar/editar/id/<?=$dados['idmodelo'];?>"><?=$dados['marca'];?> - <?=$dados['modelo'];?></a></td>
            <td><a class="btn btn-info" href="<?=URL::getBase(); ?><?=$pagina;?>/listar/editar/id/<?=$dados['idmodelo'];?>">
          <i class="glyphicon glyphicon-edit icon-white"></i>
          Editar
          </a>
              
              <a data-href="excluir.php?id=<?=$dados['idmodelo'];?>" data-toggle="modal" data-target="#confirm-delete" href="#" class="btn btn-danger">
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
					<? $queryen = mysqli_query($conn,"select * from tbmarcas where id = ".$dados_editar['marca']."");
					   $dadosen = mysqli_fetch_array($queryen);?>
							<select name="marca" class="form-control selectpicker" id="marca" data-live-search="true">
                      <option value="<?=$dadosen['id'];?>" selected="selected"><?=$dadosen['marca'];?></option>
					<? $queryuser5 = mysqli_query($conn,"select * from tbmarcas where id != ".$dados_editar['marca']."");
					   while($dadosuser5 = mysqli_fetch_array($queryuser5)) { ?>
                     <option <?php if ($dados_editar['marca'] == $dadosuser5['id'] ) { echo "selected"; } ?> value="<?=$dadosuser5['id'];?>"><?=$dadosuser5['marca'];?></option>
    				 <? }?>
			  </select>
						</div>
			
					
						<div class="form-group">
							<label for="modelo">Marca</label>
							<input name="modelo" type="text" required class="form-control" id="modelo" placeholder="Ex: Ford" value="<?=$dados_editar['modelo'];?>">
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
