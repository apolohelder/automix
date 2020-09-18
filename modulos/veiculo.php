<?
$id = Url::getURL(1);


$query = mysqli_query($conn,"Select ve.id, ve.anomodelo,ve.anofabricacao, ma.marca, mo.modelo, ve.versao, ve.km, ve.cor, ve.anofabricacao, ve.anomodelo, ve.destaque, co.combustivel, po.portas, ca.cambio, es.nome as nomeestado, mu.nome as nomemunicipio, of.oferta, ve.placa, ve.valor, ve.descricao, ve.opcionais, ve.informacoes
from tbveiculos as ve
Join tbmarcas as ma
On ma.id = ve.marca
JOIN tbmodelos as mo 
on mo.id = ve.modelo
JOIN tbcombustivel as co 
on co.id = ve.combustivel
JOIN tbportas as po 
on po.portas = ve.portas
JOIN tbcambio as ca 
on ca.id = ve.cambio
JOIN tbestado as es 
on es.uf = ve.estado
JOIN tbmunicipio as mu 
on mu.id = ve.municipio
JOIN tbofertas of 
on of.id = ve.ofertas
WHERE  ve.id = ".$id."
");
$dados = mysqli_fetch_array($query);

$tag = $dados['opcionais'];
$taginformacoes = $dados['informacoes'];


?>
<style>
	@media screen and (min-width:992px){
		.img-veiculo{
			width: 730px;
			height: 550px;
			object-fit: cover;
			object-position: center;
		}
	}
</style>
<section class="container pt-5">
	<div class="row">
		<div class="col-md-8">
			<h2 class="border-bottom pb-2 text-uppercase bold mb-4 font-weight-bold"><?=$dados['marca'];?> <?=$dados['modelo'];?> <?=$dados['versao'];?></h2>
			
			<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					<? $query = mysqli_query($conn,"Select * from tbgaleriafotos WHERE idgaleria = ".$id."");
								$i = 0;
							    while($dadosf = mysqli_fetch_array($query)) { ?>
					<div class="carousel-item <? if($i==0) { echo "active"; } ?>">
						<img class="d-block w-100 img-veiculo" src="<?=URL::getBase() ?>admin/uploadfotos/media/<?=$dadosf['foto'];?>" alt="<?=$dados['marca'];?> <?=$dados['modelo'];?> <?=$dados['versao'];?>">
					</div>
					<? $i++;} ?>

					<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Anterior</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Próximo</span>
					</a>
				</div>
			</div>
			<div class="mb-5 mt-4">
				<span class="font-weight-bold">Compartilhar</span>
				<a href="<?=$protocolo.$url;?>" id="facebook-share-btt" rel="nofollow" target="_blank"><i class="fa fa-facebook" style="width: 70px; height: 30px; background: #3b5998; color: white;text-align: center;line-height: 30px;margin: 0 10px;"></i></a>
				<a href="<?=$protocolo.$url;?>" id="whatsapp-share-btt" rel="nofollow" target="_blank"><i class="fa fa-whatsapp" style="width: 70px; height: 30px; background: #25D366; color: white;text-align: center;line-height: 30px;"></i></a>
			</div>
		</div>
		<div class="col-md-4">
			<div class="bg-secondary text-white py-4 px-2">
				<p class="text-center text-white text-uppercase">Preencha formulário abaixo e receba nossa melhor proposta.</p>
			</div>
			<div class="rounded-bottom grey lighten-5 mb-4">
				<div class="rounded-bottom grey lighten-5 mb-4 pb-4">
					<p class="mb-0 pt-3 text-center d-none">à vista:</p>

					<h3 class="text-center bold text-1 mb-2 d-none">R$ <?=number_format($dados['valor'], 2, ',', '.');?></h3>
					
					<form method="post" action="<?php echo URL::getBase() ?>modulos/enviaremail.php" class="px-3 pt-4">
							
						<div class="mb-2 text-muted form-group mt-5">
							<input name="nome" type="text" required="required" class="form-control" id="nome" placeholder="Nome completo">
						</div>
						<div class="mb-2 form-group">
							<input name="email" type="email" required="required" class="form-control" id="email" placeholder="E-mail">
						</div>
						<div class="mb-2 form-group">
							<input name="telefone" type="tel" required="required" class="form-control" id="telefone" placeholder="(99) 9999-9999">
						</div>
						
						<input type="hidden" class="form-control" id="assunto" name="assunto"  value="Receber Proposta">
						<input type="hidden" class="form-control" id="mensagem" name="mensagem"  value="automática: Gostaria de receber sua melhor proposta para o modelo de carro abaixo">
						<input type="hidden" class="form-control" id="modelo" name="modelo" value="<?=$dados['marca'];?> <?=$dados['modelo'];?> <?=$dados['versao'];?>">
						<input type="hidden" class="form-control" id="valor" name="valor" value="R$ <?=number_format($dados['valor'], 2, ',', '.');?>">
						
						<input name="enviarcadastro" type="hidden" id="enviarcadastro" value="1">
						<button type="submit" class="mt-5 btn btn-warning btn-lg btn-block">Enviar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-12 mt-4">
		<div class="row">
			<div class="col-md-3 col-6 mb-3">
				<img class="mr-3" src="<?php echo URL::getBase() ?>assets/img/icon/location.svg" width="25">
				<span class="align-middle f-09">Estado: <?=$dados['nomeestado'];?></span>
			</div>
			<div class="col-md-3 col-6 mb-3">
				<img class="mr-3" src="<?php echo URL::getBase() ?>assets/img/icon/location.svg" width="25">
				<span class="align-middle f-09">Cidade: <?=$dados['nomemunicipio'];?></span>
			</div>
			<div class="col-md-3 col-6 mb-3">
				<img class="mr-3" src="<?php echo URL::getBase() ?>assets/img/icon/year.svg" width="25">
				<span class="align-middle f-09">Ano de Fabricação: <?=$dados['anofabricacao'];?></span>
			</div>
			<div class="col-md-3 col-6 mb-3">
				<img class="mr-3" src="<?php echo URL::getBase() ?>assets/img/icon/model.svg" width="25">
				<span class="align-middle f-09">Ano de Modelo: <?=$dados['anomodelo'];?></span>
			</div>
			<div class="col-md-3 col-6 mb-3">
				<img class="mr-3" src="<?php echo URL::getBase() ?>assets/img/icon/cor.svg" width="25">
				<span class="align-middle f-09">Cor: <?=$dados['cor'];?></span>
			</div>
			<div class="col-md-3 col-6 mb-3">
				<img class="mr-3" src="<?php echo URL::getBase() ?>assets/img/icon/kilometragem.svg" width="25">
				<span class="align-middle f-09">Kilometragem: <?=$dados['km'];?> Km</span>
			</div>
			<div class="col-md-3 col-6 mb-3">
				<img class="mr-3" src="<?php echo URL::getBase() ?>assets/img/icon/fuel.svg" width="25">
				<span class="align-middle f-09">Comb.: <?=$dados['combustivel'];?></span>
			</div>
			<div class="col-md-3 col-6 mb-3">
				<img class="mr-3" src="<?php echo URL::getBase() ?>assets/img/icon/manual-transmission.svg" width="25">
				<span class="align-middle f-09">Cambios: <?=$dados['cambio'];?></span>
			</div>
			<div class="col-md-3 col-6 mb-3">
				<img class="mr-3" src="<?php echo URL::getBase() ?>assets/img/icon/portas.svg" width="25">
				<span class="align-middle f-09">Portas: <?=$dados['portas'];?></span>
			</div>
			<div class="col-md-3 col-6 mb-3">
				<img class="mr-3" src="<?php echo URL::getBase() ?>assets/img/icon/placa.svg" width="25">
				<span class="align-middle f-09">Placa: <?=$dados['placa'];?></span>
			</div>
			<div class="col-md-3 col-6 mb-3">
				<img class="mr-3" src="<?php echo URL::getBase() ?>assets/img/icon/sell.svg" width="25">
				<span class="align-middle f-09">Ofertas: <?=$dados['oferta'];?></span>
			</div>
		</div>
	</div>
	<div class="row mt-5">
		<div class="col-md-12 mb-5">
			<h3 class="border-bottom pb-2 mb-4"> Dados Opcionais</h3>
			<div class="row">
				<?
	$tags = explode(",", $tag);
	$likes     = array();
	foreach ($tags as $tag)
	{
	 $likes []= "id LIKE '%{$tag}%'";
	}
	$likes = implode(" OR ", $likes);			   
				   
	$categorias = "SELECT * FROM tbopcionais WHERE ({$likes})";
	$sql = mysqli_query($conn,$categorias);
				   
				  // print $categorias;
	 while($dadoso = mysqli_fetch_array($sql)) {  ?>
				<div class="col-md-4 col-6 mb-3">
					<i class="fa fa-check-square-o mr-2" aria-hidden="true"></i>
					<span><?=$dadoso['opcional']?></span>
				</div>
				<? } ?>
			
			</div>
		</div>
		<div class="col-md-12 mb-5">
			<h3 class="border-bottom pb-2 mb-4"> Informações Complementares</h3>
			<div class="row">
					<?
	$tags = explode(",", $taginformacoes);
	$likes     = array();
	foreach ($tags as $tag)
	{
	 $likes []= "id LIKE '%{$tag}%'";
	}
	$likes = implode(" OR ", $likes);			   
				   
	$informacoes = "SELECT * FROM tbinformacoes WHERE ({$likes})";
	$sql = mysqli_query($conn,$informacoes);
				   
				  // print $categorias;
	 while($dadosi = mysqli_fetch_array($sql)) {  ?>
				<div class="col-md-4 col-6 mb-3">
					<i class="fa fa-check-square-o mr-2" aria-hidden="true"></i>
					<span><?=$dadosi['informacoes']?></span>
				</div>
				<? } ?>

			</div>
		</div>
	</div>
	<div class="row my-5 pb-5">
		<div class="col-12">
			<h3 class="border-bottom pb-2 mb-4"> Descrição</h3>
			<p><?=$dados['descricao'];?></p>
		</div>
	</div>
	<?php include'modulos/include-widget/ofertas.php' ?>
</section>
<script>
$(document).ready(function(){

  $("#telefone").inputmask("(99) 99999-9999");  //static mask


});
</script>
<script>
//Constrói a URL depois que o DOM estiver pronto
document.addEventListener("DOMContentLoaded", function() {            
    //altera a URL do botão
    document.getElementById("facebook-share-btt").href = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(window.location.href);
}, false);
//Constrói a URL depois que o DOM estiver pronto // whatsapp
document.addEventListener("DOMContentLoaded", function() {
    //conteúdo que será compartilhado: Título da página + URL
    var conteudo = encodeURIComponent(document.title + " " + window.location.href);
    //altera a URL do botão
    document.getElementById("whatsapp-share-btt").href = "https://api.whatsapp.com/send?text=" + conteudo;
}, false);
</script>


