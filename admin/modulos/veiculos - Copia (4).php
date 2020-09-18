
<? require("restrito.php");
/*foreach ($_SESSION as $key => $value) {
    print($key.' - '.$value.'<br>');
};*/
$tabela = 'tbveiculos';
$pagina = 'veiculos';

if(isset($_POST['cadastrar']) && !empty($_POST['cadastrar']))	{
	
	

$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$versao = $_POST['versao'];
$km = $_POST['km'];
$cor = $_POST['cor'];
$anofabricacao = $_POST['anofabricacao'];
$anomodelo = $_POST['anomodelo'];
$combustivel = $_POST['combustivel'];
$portas = $_POST['portas'];
$cambio = $_POST['cambio'];
$estado = $_POST['estado'];
$municipio = $_POST['municipio'];
$ofertas = $_POST['ofertas'];
$placa = $_POST['placa'];
$valor = str_replace(",",".",str_replace(".","",$_POST["valor"]));
$descricao = $_POST['descricao'];
$opcionais =  implode( ",", $_POST['opcionais']);
$informacoes = implode( ",", $_POST['informacoes']);
$status = 1; // habilitado
$nvisitas = 0;
$destaque = 0;
	

	
	
	$query = mysqli_query($conn,"INSERT INTO ".$tabela." (marca,modelo,versao,km,cor,anofabricacao,anomodelo,combustivel,portas,cambio,estado,municipio,ofertas,placa,valor,descricao,opcionais,informacoes,status,nvisitas,destaque) VALUES ('$marca','$modelo','$versao','$km','$cor','$anofabricacao','$anomodelo','$combustivel','$portas','$cambio','$estado','$municipio','$ofertas','$placa','$valor','$descricao','$opcionais','$informacoes','$status','$nvisitas','$destaque')")  or die (mysqli_error());
			
	
	echo '<script> alert("cadastro foi efetuado com sucesso!"); window.location="'.URL::getBase().''.$pagina.'/listar/listar"; </script>';
	

}

if(isset($_POST['editar']) && !empty($_POST['editar']))	{
	


	$id = intval(Url::getURL(4));
	$valor = str_replace(",",".",str_replace(".","",$_POST["valor"]));
	$opcionais =  implode( ",", $_POST['opcionais']);
	$informacoes = implode( ",", $_POST['informacoes']);

	$query = mysqli_query($conn,"UPDATE ".$tabela." SET
	 marca   = '{$_POST['marca']}',
	 modelo   = '{$_POST['modelo']}',
	 versao   = '{$_POST['versao']}',
	 km   = '{$_POST['km']}',
	 cor   = '{$_POST['cor']}',
	 anofabricacao   = '{$_POST['anofabricacao']}',
	 anomodelo   = '{$_POST['anomodelo']}',
	 combustivel   = '{$_POST['combustivel']}',
	 portas   = '{$_POST['portas']}',
	 cambio   = '{$_POST['cambio']}',
	 estado   = '{$_POST['estado']}',
	 municipio   = '{$_POST['municipio']}',
	 ofertas   = '{$_POST['ofertas']}',
	 placa   = '{$_POST['placa']}',
	 valor   = '{$valor}',
	 descricao   = '{$_POST['descricao']}',
	 opcionais   = '{$opcionais}',
	 informacoes   = '{$informacoes}',
	 destaque   = '{$destaque}'
	 WHERE id  = '{$id}'") or die("Error: " . mysqli_error());
	
	echo '<script> alert("cadastro foi atualizado com sucesso!"); window.location="'.URL::getBase().''.$pagina.'/listar/listar"; </script>';
	

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
///////////////////////// 
	

$(document).ready(function(){
  // $('input[name=destaque]').on("click",function(){
	$('input[name=destaque]').on('ifChecked ifUnchecked', function(event){   
    var id    = $(this).prop('id');

    if($(this).prop('checked')) {
	
        var destaque = 1;
    } else {
        var destaque = 0;
    }

    $.ajax({
        type:'POST',
        url:'<?=URL::getBase(); ?>modulos/updateustaus.php',
        data:'id= ' + id + '&destaque='+destaque
    });
  //  console.log('id: ' + id );

 }); });	
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
				
				//console.log(response);

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
                    var id = response[i]['id'];
                    var nome = response[i]['nome'];
					//console.log(estadoid);
                    
                    $("#municipio").append("<option value='"+id+"'>"+nome+"</option>");
					$('#municipio').selectpicker('refresh');

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
/* These are for the single examle */
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
        Gerenciamento de Veículos</h1>
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
  <div class="col-md-6"><div class="form-group">
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
						<option value="">Aguardando escolha da marca</option>                     
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
  <div class="col-md-4"><div class="form-group">
						  <label for="endereco">Cor</label>
						  <input name="cor" type="text" required class="form-control" id="cor" placeholder="Ex: Azul">
						</div></div>
  <div class="col-md-4"><div class="form-group">
						  <label for="endereco">Ano Fabricação</label>
						  <input name="anofabricacao" type="text" required class="form-control" id="anofabricacao" placeholder="Ex: 2010">
						</div></div>
  <div class="col-md-4"><div class="form-group">
						  <label for="endereco">Ano Modelo</label>
						  <input name="anomodelo" type="text" required class="form-control" id="anomodelo" placeholder="Ex: 2010">
						</div></div>
</div>
						<div class="row">
  <div class="col-md-4"><div class="form-group">
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
  <div class="col-md-4"><div class="form-group">
							<label for="nome">Portas</label>
							<div>
					<select name="portas" required="required" class="form-control selectpicker" id="portas" data-live-search="true">
						<option value="">Escolha o número de portas</option>
                      <? $query = mysqli_query($conn,"SELECT * FROM tbportas order by portas asc");
						 while($dados = mysqli_fetch_array($query)){ ?>
                      <option value="<?=$dados['portas'];?>"><?=$dados['portas'];?></option>
                     <? }?>
                    </select></div>
						</div></div>
  <div class="col-md-4"><div class="form-group">
							<label for="nome">Câmbio</label>
							<div>
					<select name="cambio" required="required" class="form-control selectpicker" id="cambio" data-live-search="true">
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
						<option value="">Aguardando escolha do estado</option>                     
                    </select></div>
						</div>	</div>
  
</div>
						<div class="row">
  <div class="col-md-4"><div class="form-group">
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
  <div class="col-md-4"><div class="form-group">
						  <label for="endereco">Placa</label>
						  <input name="placa" type="text" required class="form-control" id="placa" placeholder="Ex: JXS-8400 ou JXS8E00">
						</div></div>
  <div class="col-md-4"><div class="form-group">
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
						
						
						
  <div class="col-md-6">
	  
	  <div class="col-md-12">	
	  <div class="row">
	  <h2>Opcionais de série do veículo</h2><div></div>
	  <? $query = mysqli_query($conn,"SELECT * FROM tbopcionais ORDER BY opcional ASC");
	     while($dados = mysqli_fetch_array($query)) { ?>
	 <div class="col-md-6" style="margin-top: 8px;"><input name="opcionais[]" type="checkbox" class="minimal" id="opcionais[]" value="<?=$dados['id'];?>"> <?=$dados['opcional'];?></div>
	  <? } ?> 
						
	  </div></div>
	   <div class="col-md-12">		
						 <div class="row border-top my-5 border-success pt-4">
						 <h2>Informações complementares</h2><div><hr></div>
	  <? $query = mysqli_query($conn,"SELECT * FROM tbinformacoes ORDER BY informacoes ASC");
	     while($dados = mysqli_fetch_array($query)) { ?>
	 <div class="col-md-6" style="margin-top: 8px;"><input name="informacoes[]" type="checkbox" class="minimal" id="informacoes[]" value="<?=$dados['id'];?>"> <?=$dados['informacoes'];?></div>
	 
	  <? } ?>
					</div>
					  </div>
	</div>
				
						  
</div>
						
					<div class="col-md-12" style="margin-top: 10px;">
						<button type="submit" class="btn btn-success">Cadastrar</button>
						<button type="button" class="btn btn-info" onClick="history.go(-1)">Voltar</button>
						<input name="cadastrar" type="hidden" id="cadastrar" value="1">
				  </div>
		  </form>
			
			
	<? }    if(Url::getURL(2) == "listar") { ?>
		<a href="<?=URL::getBase(); ?><?=$pagina;?>/listar/mostrar"><div class="btn btn-success" style="margin: 10px;">CADASTRAR VEÍCULO</div></a>	
		<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
    <thead class="table-dark">
        <tr>
          <th>OFERTAS</th>
          <th>MARCA / MODELO</th>
          <th>PLACA</th>
          <th>VALOR</th>
            <th>OPÇÕES</th>
            </tr>
    </thead>
    <tfoot class="table-dark">
        <tr>
          <th>OFERTAS</th>
          <th>MARCA / MODELO</th>
          <th>PLACA</th>
          <th>VALOR</th>
            <th>OPÇÕES</th>
            </tr>
    </tfoot>
    <tbody>
       <? $query = mysqli_query($conn,"Select ve.id, ma.marca, mo.modelo, ve.versao, ve.km, ve.cor, ve.anofabricacao, ve.anomodelo, ve.destaque, co.combustivel, po.portas, ca.cambio, es.nome as nomestado, mu.nome as nomemunicipio, of.oferta, ve.placa, ve.valor, ve.descricao
from tbveiculos as ve
Join tbmarcas as ma
On ma.id = ve.marca
JOIN tbmodelos as mo 
on mo.id = ve.modelo
JOIN tbcombustivel as co 
on co.id = ve.combustivel
JOIN tbportas as po 
on po.id = ve.portas
JOIN tbcambio as ca 
on ca.id = ve.cambio
JOIN tbestado as es 
on es.uf = ve.estado
JOIN tbmunicipio as mu 
on mu.id = ve.municipio
JOIN tbofertas of 
on of.id = ve.ofertas");
					while ($dados = mysqli_fetch_array($query)) {
		?>
        <tr id="item_<?=$dados['id'];?>">
          <td align="center"><input type="checkbox" id="<?=$dados['id'];?>"  name="destaque" value="<?=$dados['destaque'];?>" <?=$dados['destaque'] == '1' ? 'checked' : '' ;?>/></td>
          <td>
			  
			  
			  <a href="<?=URL::getBase(); ?><?=$pagina;?>/listar/editar/id/<?=$dados['id'];?>"><?=$dados['marca'];?> - <?=$dados['modelo'];?></a></td>
          <td><?=$dados['placa'];?></td>
          <td><?=number_format($dados['valor'], 2, ',', '.');?></td>
            <td>
				
				 <a class="btn btn-success btn-responsive" href="<?=URL::getBase(); ?><?=$pagina;?>/listar/editarfotos/id/<?=$dados['id'];?>">
              <i class="fa fa-picture-o" aria-hidden="true"></i>
              Fotos
              </a>
				
				
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
		$opcionais = explode(",", $dados_editar["opcionais"]);
		$informacoes = explode(",", $dados_editar["informacoes"]);
			?>
			
  
	<form name="editar" id="editar" method="post" action="">
					
					
					<div class="row">
  <div class="col-md-6"><!-- Stack the columns on mobile by making one full-width and the other half-width -->
<div class="row">
  <div class="col-md-6">
	<div class="form-group">
						  <label for="marca">Marca</label>	
							<select name="marca" class="form-control selectpicker" id="marca" data-live-search="true">                     
					<? $query = mysqli_query($conn,"select * from tbmarcas");
					   while($dados = mysqli_fetch_array($query)) { ?>
                     <option <?php if ($dados_editar['marca'] == $dados['id'] ) { echo "selected"; } ?> value="<?=$dados['id'];?>"><?=$dados['marca'];?></option>
    				 <? }?>
			  </select>
						</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
						<label for="nome">Modelo</label>	  				
					<div>
						<select name="modelo" required="required" class="form-control selectpicker" id="modelo" data-live-search="true">						
							<?
						        $query = mysqli_query($conn,"select * from tbmodelos where marca = ".$dados_editar['marca']."");
								while($dados = mysqli_fetch_array($query)) {
							?>
							<option <? if ($dados_editar['modelo'] == $dados['id'] ) { echo "selected"; } ?> value="<?=$dados['id'];?>"><?=$dados['modelo'];?></option>
						 	<? }?>                    
						</select>
	  				</div>
		</div>
	</div>
</div>


<div class="row">
  <div class="col-md-6"><div class="form-group">
						  <label for="endereco">Versão do Veículo</label>
						  <input name="versao" type="text" required class="form-control" id="versao" placeholder="Ex: Elite 1.8 Automático" value="<?=$dados_editar['versao'];?>">
						</div>	</div>
  <div class="col-md-6"><div class="form-group">
						  <label for="endereco">Quilometragem</label>
						  <input name="km" type="text" required class="form-control" id="km" placeholder="Ex: 16.510 ou 0 para Zero KM" value="<?=$dados_editar['km'];?>">
						</div>	</div>
  
</div>

<!-- Columns are always 50% wide, on mobile and desktop -->
<div class="row">
  <div class="col-md-4"><div class="form-group">
						  <label for="endereco">Cor</label>
						  <input name="cor" type="text" required class="form-control" id="cor" placeholder="Ex: Azul" value="<?=$dados_editar['cor'];?>">
						</div></div>
  <div class="col-md-4"><div class="form-group">
						  <label for="endereco">Ano Fabricação</label>
						  <input name="anofabricacao" type="text" required class="form-control" id="anofabricacao" placeholder="Ex: 2010" value="<?=$dados_editar['anofabricacao'];?>">
						</div></div>
  <div class="col-md-4"><div class="form-group">
						  <label for="endereco">Ano Modelo</label>
						  <input name="anomodelo" type="text" required class="form-control" id="anomodelo" placeholder="Ex: 2010" value="<?=$dados_editar['anomodelo'];?>">
						</div></div>
</div>
						<div class="row">
  <div class="col-md-4"><div class="form-group">
							<label for="nome">Combustível</label>
							<div>
					<select name="combustivel" required="required" class="form-control selectpicker" id="combustivel" data-live-search="true">
						<option value="">Escolha o tipo de combustível</option>
                      <? $query = mysqli_query($conn,"SELECT * FROM tbcombustivel order by combustivel asc");
						 while($dados = mysqli_fetch_array($query)){ ?>
                       <option <?php if ($dados_editar['combustivel'] == $dados['id'] ) { echo "selected"; } ?> value="<?=$dados['id'];?>"><?=$dados['combustivel'];?></option>
                     <? }?>
                    </select></div>
						</div></div>
  <div class="col-md-4"><div class="form-group">
							<label for="nome">Portas</label>
							<div>
					<select name="portas" required="required" class="form-control selectpicker" id="portas" data-live-search="true">
						<option value="">Escolha o número de portas</option>
                      <? $query = mysqli_query($conn,"SELECT * FROM tbportas order by portas asc");
						 while($dados = mysqli_fetch_array($query)){ ?>
                      <option <?php if ($dados_editar['portas'] == $dados['id'] ) { echo "selected"; } ?> value="<?=$dados['id'];?>"><?=$dados['portas'];?></option>
                     <? }?>
                    </select></div>
						</div></div>
  <div class="col-md-4"><div class="form-group">
							<label for="nome">Câmbio</label>
							<div>
					<select name="cambio" required="required" class="form-control selectpicker" id="cambio" data-live-search="true">
						<option value="">Escolha o tipo de câmbio</option>
                      <? $query = mysqli_query($conn,"SELECT * FROM tbcambio order by cambio asc");
						 while($dados = mysqli_fetch_array($query)){ ?>
                      <option <?php if ($dados_editar['cambio'] == $dados['id'] ) { echo "selected"; } ?> value="<?=$dados['id'];?>"><?=$dados['cambio'];?></option>
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
                      <option <?php if ($dados_editar['estado'] == $dados['uf'] ) { echo "selected"; } ?> value="<?=$dados['uf'];?>"><?=$dados['nome'];?></option>
                     <? }?>
                    </select></div>
						</div>	</div>
  <div class="col-md-6"><div class="form-group">
							<label for="nome">Município</label>
							<div>
					<select name="municipio" required="required" class="form-control selectpicker" id="municipio" data-live-search="true">						
							<?
						        $query = mysqli_query($conn,"select * from tbmunicipio where id = ".$dados_editar['municipio']."");
								while($dados = mysqli_fetch_array($query)) {
							?>
							<option <? if ($dados_editar['municipio'] == $dados['id'] ) { echo "selected"; } ?> value="<?=$dados['id'];?>"><?=$dados['nome'];?></option>
						 	<? }?>                    
					</select></div>
						</div>	</div>
  
</div>
						<div class="row">
  <div class="col-md-4"><div class="form-group">
							<label for="nome">Ofertas</label>
							<div>
					<select name="ofertas" required="required" class="form-control selectpicker" id="ofertas" data-live-search="true">
						<option value="">Escolha uma ofertas</option>
                      <? $query = mysqli_query($conn,"SELECT * FROM tbofertas order by oferta asc");
						 while($dados = mysqli_fetch_array($query)){ ?>
                      <option <? if ($dados_editar['ofertas'] == $dados['id'] ) { echo "selected"; } ?> value="<?=$dados['id'];?>"><?=$dados['oferta'];?></option>
                     <? }?>
                    </select></div>
						</div></div>
  <div class="col-md-4"><div class="form-group">
						  <label for="endereco">Placa</label>
						  <input name="placa" type="text" required class="form-control" id="placa" placeholder="Ex: JXS-8400 ou JXS8E00" value="<?=$dados_editar['placa'];?>">
						</div></div>
  <div class="col-md-4"><div class="form-group">
						  <label for="endereco">Valor</label>
						  <input name="valor" type="text" required class="form-control" id="valor" placeholder="Ex: 27.500" value="<?=$dados_editar['valor'];?>">
						</div></div>
</div>
						
						
<div class="row">
  <div class="col-md-12"><div class="form-group">
						  <label for="endereco">Descrição</label>
						 <textarea name="descricao" id="descricao" class="form-control"><?=$dados_editar['descricao'];?></textarea>
						</div>	</div>

  
</div></div>
						
						
						
  <div class="col-md-6">
	  
	  <div class="col-md-12">	
	  <div class="row">
	  <h2>Opcionais de série do veículo</h2><div></div>
	  <? $query = mysqli_query($conn,"SELECT * FROM tbopcionais ORDER BY opcional ASC");
	     while($dados = mysqli_fetch_array($query)) { ?>
	 <div class="col-md-6" style="margin-top: 8px;"><input name="opcionais[]" type="checkbox" class="minimal" id="opcionais[]" value="<?=$dados['id'];?>" <?=(in_array($dados['id'],$opcionais))?('checked'):('');?>> <?=$dados['opcional'];?></div>
	  <? } ?> 
						
	  </div></div>
	   <div class="col-md-12">		
						 <div class="row border-top my-5 border-success pt-4">
						 <h2>Informações complementares</h2><div><hr></div>
	  <? $query = mysqli_query($conn,"SELECT * FROM tbinformacoes ORDER BY informacoes ASC");
	     while($dados = mysqli_fetch_array($query)) { ?>
	 <div class="col-md-6" style="margin-top: 8px;"><input name="informacoes[]" type="checkbox" class="minimal" id="informacoes[]" value="<?=$dados['id'];?>" <?=(in_array($dados['id'],$informacoes))?('checked'):('');?>> <?=$dados['informacoes'];?></div>
	 
	  <? } ?>
					</div>
					  </div>
	</div>
				
						  
</div>
						
					<div class="col-md-12" style="margin-top: 10px;">
						<button type="submit" class="btn btn-success">Salvar</button>
						<button type="button" class="btn btn-info" onClick="history.go(-1)">Voltar</button>
						<input name="editar" type="hidden" id="editar" value="1">
				  </div>
		  </form>
			
			<? }else if(Url::getURL(2) == "editarfotos") {
	
		$id = Url::getURL(4);
		
		$query_editar = mysqli_query($conn,"SELECT * FROM ".$tabela." WHERE id = {$id}");
		$dados_editar = mysqli_fetch_array($query_editar);
			?>
			
			 <main role="main" class="container">
<input name="gallery" type="hidden" id="gallery" value="<?=$id;?>">
      

      <div class="row">
        <div class="col-md-6 col-sm-12">
          
          <!-- Our markup, the important part here! -->
          <div id="drag-and-drop-zone" class="dm-uploader p-5">
            <h3 align="center">Arraste & solte as imagens</h3>

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
	<button type="button" class="btn btn-info" onClick="history.go(-1)">Voltar</button>
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
			
			<div class="container pt-3">
			<div class="callout callout-success">                

                <p>Lista de fotos cadastradas nesta galeria.</p>
				
			</div>
			
			 <div class="col-md-12">
	  <div class="row">
	 
	   <?php
   $id = Url::getURL(4);
   $query = "SELECT * FROM tbgaleriafotos WHERE idgaleria = ".$id."";
   $result = mysqli_query($conn, $query);
   if(mysqli_num_rows($result) > 0)
   {
   ?>
		  <?php
    while($dados = mysqli_fetch_array($result))
    {
   ?>
	 <div class="col-md-2"><div class="row" id="item_<?=$dados["id"];?>"><div class="img-thumbnail"><img src="<?=URL::getBase(); ?>uploadfotos/thumbs/<?=$dados["foto"]; ?>" id='img_<?=$dados["id"];?>' width="220" class="img-fluid">

		  <div id='delete_<?=$dados["id"];?>' class="btn btn-block btn-danger"><input type="checkbox" name="customer_id[]" class="delete_customer" value="<?=$dados["id"]; ?>" /></div></div>
		  </div></div>
	  <? } ?> 
						
	  </div>
			
			
				</div>
			
			<? }  ?>
			  <div align="center">
    <button type="button" name="btn_delete" id="btn_delete" class="btn btn-danger">Deletar arquivos selecionados</button>
   </div><? }  ?>
        </div> </div>
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
