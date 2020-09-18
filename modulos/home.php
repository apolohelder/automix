<?
$query = mysqli_query($conn,"SELECT * FROM tbbanners order by rand()");
$query2 = mysqli_query($conn,"SELECT * FROM tbbanners order by rand()");
?>

<script>
	$(document).ready(function() {
		$('#modelo').selectpicker('refresh');
		$("#marca").change(function() {
			var marcaid = $(this).val();

			$.ajax({
				url: '<?=URL::getBase(); ?>admin/modulos/modeloid.php',
				type: 'post',
				data: {
					marca: marcaid
				},
				dataType: 'json',
				success: function(response) {

					//console.log(response);

					var len = response.length;

					$("#modelo").empty();
					$("#modelo").append("<option value=''>Escolha um modelo</option>");
					for (var i = 0; i < len; i++) {
						var id = response[i]['id'];
						var modelo = response[i]['modelo'];
						//console.log(marcaid);

						$("#modelo").append("<option value='" + id + "'>" + modelo + "</option>");
						$('#modelo').selectpicker('refresh');

					}
				}
			});
		});
	});
</script>

<!-- Versão desktop -->
<div id="slide-home" class="carousel slide d-none d-md-block" data-ride="carousel">
	<div class="carousel-inner">
		<? 
		$i = 0;
		while($dados = mysqli_fetch_array($query)) { ?>
		<div class="carousel-item <? if($i==0) { echo "active"; } ?>">
			 <? if(!empty($dados['link'])) { ?>
		   <a href="<?=$dados['link'];?>" target="_blank">
			<img class="d-block w-100" src="<?=URL::getBase() ?>admin/uploadbanner/media/<?=$dados['foto'];?>" alt="Auto Mix">
			</a><? }else{ ?>
			<img class="d-block w-100" src="<?=URL::getBase() ?>admin/uploadbanner/media/<?=$dados['foto'];?>" alt="Auto Mix">
			<? }?>
		</div>
		<?  $i++;} ?>
	</div>
	<a class="carousel-control-prev" href="#slide-home" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#slide-home" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>
<!-- / Versão desktop -->

<!-- Versão mobile -->
<div id="slide-home-mobile" class="carousel slide d-md-none" data-ride="carousel">
	<div class="carousel-inner">
		
		<? 
		$ix = 0;
		while($dados = mysqli_fetch_array($query2)) { ?>
		<div class="carousel-item <? if($ix==0) { echo "active"; } ?>">
			<? if(!empty($dados['link'])) { ?>
		   <a href="<?=$dados['link'];?>" target="_blank">
			<img class="d-block w-100" src="<?=URL::getBase() ?>admin/uploadbanner/thumbs/<?=$dados['foto2'];?>" alt="Auto Mix">
			</a><? }else{ ?>
			<img class="d-block w-100" src="<?=URL::getBase() ?>admin/uploadbanner/thumbs/<?=$dados['foto2'];?>" alt="Auto Mix">
			<? }?>
		</div>    
		<? $ix++;} ?>
		
	</div>
	<a class="carousel-control-prev" href="#slide-home-mobile" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#slide-home-mobile" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>
<!-- / Versão mobile -->

<section>
	<div class="container-fluid bg-secondary py-5">
		<div class="container bg-white px-4 pt-2 pb-5">
			<h3 class="text-center mb-5 pt-5">
						<span class="py-lg-0 py-xl-3 px-4 bg-automix text-uppercase font-weight-bolder">
							<span class="h1-automix px-3"><i class="fa fa-car" aria-hidden="true"></i> que carro você está procurando? encontre aqui</span>
						</span>
					</h3>
			<form class="txt-form" action="<?=URL::getBase() ?>buscar" method="get">
				<div class="row">
					<div class="col-xl-3">
						<select name="marca" class="form-control selectpicker" id="marca" data-live-search="true">
							<option value="">Escolha uma marca</option>
							<? $query = mysqli_query($conn,"SELECT * FROM tbmarcas order by marca asc");
						 while($dados = mysqli_fetch_array($query)){ ?>
								<option value="<?=$dados['id'];?>">
									<?=$dados['marca'];?>
								</option>
								<? }?>
						</select>
					</div>
					<div class="col-xl-3">
						<select name="modelo" class="form-control selectpicker" id="modelo" data-live-search="true">
							<option value="">Aguardando escolha da marca</option>
						</select>
					</div>
					<div class="col-xl-3">
						<select name="anode" class="selectpicker" id="anode" data-live-search="true">
							<option value="" selected="SELECTED">Ano de</option>
							<? for($i = date('Y'); $i >= 1990; $i--) { ?>
								<option value="<?=$i;?>">
									<?=$i;?>
								</option>
								<? }?>

						</select>
					</div>
					<div class="col-xl-3">
						<select name="anoate" class="selectpicker" id="anoate" data-live-search="true">
							<option value="" selected="SELECTED">Ano de</option>
							<? for($i = date('Y'); $i >= 1990; $i--) { ?>
								<option value="<?=$i;?>">
									<?=$i;?>
								</option>
								<? }?>

						</select>
					</div>
				</div>
				<div class="row"> <!-- justify-content-end -->
					<div class="col-xl-9 col-12 mt-5 d-none">
						<div class="row">
							<div class="col-sm-2 text-center"><strong>Preços</strong></div>
							<div class="col-sm-10">
							<div id="steps-slider"></div>
								<input name="menor" type="hidden" id="input-with-keypress-0">
								<input name="maior" type="hidden" id="input-with-keypress-1">

								<script>
									var stepsSlider = document.getElementById('steps-slider');
									var input0 = document.getElementById('input-with-keypress-0');
									var input1 = document.getElementById('input-with-keypress-1');
									var inputs = [input0, input1];


									noUiSlider.create(stepsSlider, {
										start: [15000, 500000],
										step: 500,
										connect: true,
										tooltips: [true, wNumb({
											decimals: 1,
											thousand: '.',
											suffix: ',00'
										})],
										range: {
											'min': [15000],
											'max': 500000
										},
										format: wNumb({
											decimals: 3,
											thousand: '.',
											suffix: ',00'
										})
									});

									stepsSlider.noUiSlider.on('update', function(values, handle) {
										inputs[handle].value = values[handle];
									});
								</script>
							</div>
						</div>
						

					</div>
					<div class="col-xl-3 mt-4">
						<button type="submit" class="btn btn-buscar"><i class="fa fa-search" aria-hidden="true"></i> BUSCAR CARROS</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="container my-5">
		<h2 class="border-bottom my-4 b-5 text-automix">Últimos Veículos</h2>
		<div class="row">
			<? $query = mysqli_query($conn,"Select ve.id, ve.anomodelo,ve.anofabricacao, ma.marca, mo.modelo, ve.versao, ve.km, ve.cor, ve.anofabricacao, ve.anomodelo, ve.destaque, co.combustivel, po.portas, ca.cambio, es.nome as nomestado, mu.nome as nomemunicipio, of.oferta, ve.placa, ve.valor, ve.descricao, ve.ofertas as ofertas2, (SELECT foto FROM tbgaleriafotos WHERE idgaleria = ve.id && destaque = 1 order by id ASC LIMIT 1) AS foto
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
					order by rand() limit 8
					");
					   while($dados = mysqli_fetch_array($query)) {
					?>

				<div class="col-md-3 col-lg-3 col-xs-12 mb-4">
					<div style="position: absolute; right: 17px; text-align: center;">
						<? if($dados['ofertas2']==1) { ?>
						<p class="p-1" style="background: #22dbfd;color: white;font-weight: bold;font-size: 13px;">Novas</p>
						<? }else if ($dados['ofertas2']==2) { ?>
						<p class="p-1" style="background: #4aa3ff;color: white;font-weight: bold;font-size: 13px;">Quentes</p>
						<? }else { ?>
						<p class="p-1" style="background: #ff0000;color: white;font-weight: bold;font-size: 13px;">Imperdível</p>
						<? } ?>
						
					</div>
					<a href="<?=URL::getBase() ?>veiculo/<?=$dados['id'];?>/<?=url_amigavel($dados['versao'].'-'.$dados['marca'].'-'.$dados['modelo']);?>">
						<img class="img-fluid ng-lazyloaded img-car-home" src="<?=URL::getBase() ?>admin/uploadfotos/thumbs/<?=$dados['foto'];?>" alt="<?=$dados['marca'];?> <?=$dados['modelo'];?> <?=$dados['versao'];?>">
					</a>
					<div class="card-body">
						<p class="f-09 b-5 text-uppercase mb-0 pl-2">
							<?=$dados['modelo'];?> <?=$dados['versao'];?>
						</p>
						<p class="f-09 mb-4 pl-2">
							<?=$dados['anofabricacao'];?>/
								<?=$dados['anomodelo'];?>
						</p>
						<div class="pb-3 clearfix border-bottom">
							<a href="<?=URL::getBase() ?>veiculo/<?=$dados['id'];?>/<?=url_amigavel($dados['versao'].'-'.$dados['marca'].'-'.$dados['modelo']);?>" class="float-left bg-automix p-2 leads b-9 text-white px-3"> Veja mais </a>
							<!-- span class="float-left bg-automix p-2 leads b-9 text-white"> R$ <?=number_format($dados['valor'], 2, ',', '.');?> </span -->
							<span class="float-right p-2 f-09 text-muted">
									<i class="fa fa-tachometer" aria-hidden="true"></i>
									<?=$dados['km'];?> Km 
								</span>
						</div>
					</div>
				</div>

				<? } ?>
		</div>
		<div class="col-12 text-center">
			<a href="<?=URL::getBase() ?>estoque" class="btn btn-plus-car">VER MAIS</a>
		</div>
	</div>
	<div class="b-welcome" id="sobre-nos">
		<div class="container">
			<div class="row justify-content-end py-5">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="b-welcome__text pl-5 text-white box-m-l">
						<h2 style="letter-spacing: 1px;">CONHEÇA MAIS SOBER NÓS</h2>
						<h3>Automix Multimarcas</h3>
						<p>Concessionária Multimarcas referência em atendimento e especialista em Nacionais e Importados. Fundada em 2006 e oferece além de veículos oficina multimarcas própria.</p>
						<p class="mb-2">Possui as melhores condições como:</p>
						<ul>
							<li><i class="fa fa-check"></i> Taxas especiais.</li>
							<li><i class="fa fa-check"></i> Financiamento com todos os bancos.</li>
							<li><i class="fa fa-check"></i> Troca com troco.</li>
							<li><i class="fa fa-check"></i> 4 meses de garantia</li>
							<li><i class="fa fa-check"></i> Entrada facilitada em até 12x no cartão</li>
						</ul>
					</div>
				</div>
				<div class="col-xl-4 col-md-4 col-sm-6 col-xs-12">
					<div class="b-welcome__services">
						<div class="row">
							<div class="col-md-6 col-xs-6 m-padding">
								<div class="box-services py-4 px-1 bg-white">
									<i class="fa fa-car"></i>
									<h3>FINANCIAMENTO <br>PRÉ <br>APROVADO</h3>
								</div>
							</div>
							<div class="col-md-6 col-xs-6 m-padding">
								<div class="box-services py-4 px-1 bg-white">
									<i class="fa fa-male"></i>
									<h3>PROCEDÊNCIA, GARANTIA E MAIS SEGURANÇA</h3>
								</div>
							</div>
							<div class="col-md-12 text-center">
								<div class="b-welcome__services-circle"></div>
							</div>
							<div class="col-md-6 col-xs-6 m-padding">
								<div class="box-services  py-4 px-1 bg-white">
									<i class="fa fa-book"></i>
									<h3>AS MELHORES MARCAS COM AS MELHORES OFERTAS</h3>
								</div>
							</div>
							<div class="col-md-6 col-xs-6 m-padding">
								<div class="box-services py-4 px-1 bg-white">
									<i class="fa fa-phone"></i>
									<h3>(92) 99135-5371 <br> (92) 98417-8776</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include'modulos/include-widget/ofertas.php' ?>
</section>