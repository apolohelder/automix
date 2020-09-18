             <div class="container mt-5">
				<h2 class="border-bottom my-4 b-5 text-automix">Melhores Ofertas</h2>
				<div class="row">
					<? $query = mysqli_query($conn,"Select ve.id, ve.anomodelo,ve.anofabricacao, ma.marca, mo.modelo, ve.versao, ve.km, ve.cor, ve.anofabricacao, ve.anomodelo, ve.destaque, co.combustivel, po.portas, ca.cambio, es.nome as nomestado, mu.nome as nomemunicipio, of.oferta, ve.placa, ve.valor, ve.descricao, ve.ofertas as ofertas2, (SELECT foto FROM tbgaleriafotos WHERE idgaleria = ve.id && destaque = 1 order by id ASC LIMIT 1) AS foto, ve.destaque
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
					WHERE destaque = '1'
					order by id limit 8
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
							<p class="f-09 b-5 text-uppercase mb-0 pl-2"><?=$dados['modelo'];?> <?=$dados['versao'];?> </p>
							<p class="f-09 mb-4 pl-2"> <?=$dados['anofabricacao'];?>/<?=$dados['anomodelo'];?> </p>
							<div class="pb-3 clearfix border-bottom">
								<a href="<?=URL::getBase() ?>veiculo/<?=$dados['id'];?>/<?=url_amigavel($dados['versao'].'-'.$dados['marca'].'-'.$dados['modelo']);?>" class="float-left bg-automix p-2 leads b-9 text-white px-3"> Veja mais</a>
								<!-- span class="float-left bg-automix p-2 leads b-9 text-white"> R$ <?=number_format($dados['valor'], 2, ',', '.');?> </span -->
								<span class="float-right p-2 text-muted" style="font-size: 16px;">
									<i class="fa fa-tachometer" aria-hidden="true"></i>
									<?=$dados['km'];?> Km 
								</span>
							</div>
						</div>
					</div>
					<? } ?>
				</div>
             </div>
