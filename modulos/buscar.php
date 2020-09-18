<?
//Verificar se está sendo passado na URL a página atual, senao é atribuido a pagina 
#$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
$teste = Url::getURL(2);
$pagina = (isset($teste)) ? $teste : 1;
#$pagina = intval(Url::getURL(2));
if(!empty($_GET['marca']) || (!empty($_GET['cambio'])) || (!empty($_GET['combustivel'])) || (!empty($_GET['portas'])) || (!empty($_GET['anofabricacao'])) || (!empty($_GET['anode'])) || (!empty($_GET['anoate'])) || (!empty($_GET['menor'])) || (!empty($_GET['maior'])) ) {
$marca = $_GET['marca'];
$modelo = $_GET['modelo'];
$anode = $_GET['anode'];
$anoate = $_GET['anoate'];
$menor = str_replace(",",".",str_replace(".","",$_GET["menor"]));
$maior = str_replace(",",".",str_replace(".","",$_GET["maior"]));
#$cambio = $_GET['cambio'];
#$combustivel = $_GET['combustivel'];
#$portas = $_GET['portas'];
#$anofabricacao = $_GET['anofabricacao']; 
}


$query_buscar = "SELECT ve.id,ve.cambio,ve.combustivel,ve.portas,ve.anofabricacao,ve.versao, ve.anomodelo, ve.km,ve.valor,ve.marca, mo.modelo as modelove, ma.marca as marcave, ve.ofertas as ofertas2, (SELECT foto FROM tbgaleriafotos WHERE idgaleria = ve.id && destaque = 1 order by id ASC LIMIT 1) AS foto FROM tbveiculos as ve
Join tbmarcas as ma
On ma.id = ve.marca
JOIN tbmodelos as mo 
on mo.id = ve.modelo";


		$cond = " WHERE ";		
		if (!empty($marca))	{  			
			$query_buscar .= $cond . " ve.marca LIKE '" . $marca."'";
			$cond = " AND ";			
		}
		if (!empty($modelo))	{  			
			$query_buscar .= $cond . " ve.modelo LIKE '" . $modelo."'";
			$cond = " AND ";			
		}	
		if (!empty($anode))	{  			
			$query_buscar .= $cond . " anofabricacao BETWEEN '" .$anode."' AND '" .$anoate."'";
			$cond = " AND ";
			
		}
		if (!empty($menor))	{  			
			$query_buscar .= $cond . " valor BETWEEN '" .$menor."' AND '" .$maior."'";
			$cond = " AND ";
			
		}

#print $query_buscar;

#$result_curso = "SELECT * FROM tbveiculos WHERE marca LIKE '%$valor_pesquisar%'";
$resultado_curso = mysqli_query($conn, $query_buscar);

//Contar o total de linhas
$total_query = mysqli_num_rows($resultado_curso);

//Seta a quantidade de linhas por pagina
$quantidade_pg = 12;

//calcular o número de pagina necessárias para apresentar os dados
$num_pagina = ceil($total_query/$quantidade_pg);

//Calcular o inicio da visualizacao
$incio = ($quantidade_pg*$pagina)-$quantidade_pg;

//Selecionar os dados a serem apresentado na página
$query_buscar = "SELECT ve.id,ve.cambio,ve.combustivel,ve.portas,ve.anofabricacao,ve.versao,ve.anomodelo,ve.km,ve.valor,ve.marca, mo.modelo as modelove, ma.marca as marcave, ve.ofertas as ofertas2,  (SELECT foto FROM tbgaleriafotos WHERE idgaleria = ve.id && destaque = 1 order by id ASC LIMIT 1) AS foto FROM tbveiculos as ve
Join tbmarcas as ma
On ma.id = ve.marca
JOIN tbmodelos as mo 
on mo.id = ve.modelo";
		$cond = " WHERE ";		
		if (!empty($marca))	{  			
			$query_buscar .= $cond . " ve.marca LIKE '" . $marca."'";
			$cond = " AND ";			
		}
		if (!empty($modelo))	{  			
			$query_buscar .= $cond . " ve.modelo LIKE '" . $modelo."'";
			$cond = " AND ";			
		}	
		if (!empty($anode))	{  			
			$query_buscar .= $cond . " anofabricacao BETWEEN '" .$anode."' AND '" .$anoate."'";
			$cond = " AND ";
			
		}
		if (!empty($menor))	{  			
			$query_buscar .= $cond . " valor BETWEEN '" .$menor."' AND '" .$maior."'";
			$cond = " AND ";
			
		}
		$query_buscar .= " limit $incio, $quantidade_pg";

#print $query_buscar;

#$query_buscar = "SELECT * FROM tbveiculos WHERE marca LIKE '%$valor_pesquisar%' limit $incio, $quantidade_pg";
$resultado_query = mysqli_query($conn, $query_buscar);
$total_query = mysqli_num_rows($resultado_query);


?>

<section class="container pt-5 ">
	<div class="row">
		<div class="col-md-3">
			<form class="bg-dark p-3 pb-4 sticky mb-4" action="<?=URL::getBase() ?>estoque" method="get">
				
				<div class="form-group">
					<label for="marca" class="border-bottom text-uppercase f-09 pl-4 b-5 text-white w-100 mb-3">Marca</label>
					<select name="marca" data-width="100%" class="selectpicker" id="marca" data-live-search="true">
						<option value="">Escolha a marca</option>
                      <? $query = mysqli_query($conn,"SELECT * FROM tbmarcas order by marca asc");
						 while($dados = mysqli_fetch_array($query)){ ?>
                      <option value="<?=$dados['id'];?>"><?=$dados['marca'];?></option>
                     <? } ?>
                    </select>
				</div>
				<div class="form-group">
					<label for="marca" data-width="100%" class="border-bottom text-uppercase f-09 pl-4 b-5 text-white w-100 mb-3">TRANSMISSÃO</label>
					<select name="cambio" class="selectpicker" id="cambio" data-live-search="true">
						<option value="">Escolha o câmbio</option>
                      <? $query = mysqli_query($conn,"SELECT * FROM tbcambio order by cambio asc");
						 while($dados = mysqli_fetch_array($query)){ ?>
                      <option value="<?=$dados['id'];?>"><?=$dados['cambio'];?></option>
                     <? }?>
                    </select>
				</div>
				<div class="form-group">
					<label for="marca" class="border-bottom text-uppercase f-09 pl-4 b-5 text-white w-100 mb-3">COMBUSTIVEL</label>
					<select name="combustivel" class="selectpicker" id="combustivel" data-live-search="true">
						<option value="">Escolha o combustível</option>
                      <? $query = mysqli_query($conn,"SELECT * FROM tbcombustivel order by combustivel asc");
						 while($dados = mysqli_fetch_array($query)){ ?>
                      <option value="<?=$dados['id'];?>"><?=$dados['combustivel'];?></option>
                     <? }?>
                    </select>
				</div>
				<div class="form-group">
					<label for="marca" class="border-bottom text-uppercase f-09 pl-4 b-5 text-white w-100 mb-3">PORTAS</label>
					<select name="portas" class="selectpicker" id="portas" data-live-search="true">
						<option value="">Quantidade de portas</option>
                      <? $query = mysqli_query($conn,"SELECT * FROM tbportas order by portas asc");
						 while($dados = mysqli_fetch_array($query)){ ?>
                      <option value="<?=$dados['portas'];?>"><?=$dados['portas'];?></option>
                     <? }?>
                    </select>
				</div>
				<div class="form-group">
					<label for="marca" class="border-bottom text-uppercase f-09 pl-4 b-5 text-white w-100 mb-3">ANO</label>
					<select name="anofabricacao" class="selectpicker" id="anofabricacao" data-live-search="true">
					  <option value="" selected="SELECTED">Escolha o ano</option>
						<? for($i = date('Y'); $i >= 1990; $i--) { ?>
						<option value="<?=$i;?>"><?=$i;?></option>
						<? }?>

					</select>
				</div>

				<button type="submit" class="btn btn-warning btn-lg btn-block">PESQUISAR</button>
				<input name="buscar" type="hidden" id="buscar" value="1">
			</form>
			
		</div>
		<div class="col-md-8">
			<div class="row">
				 <?   while($dados = mysqli_fetch_array($resultado_query)) { ?>
				<div class="col-md-4 col-lg-4 col-xs-12 mb-4">
					<div style="position: absolute; right: 17px; text-align: center;">
						<? if($dados['ofertas2']==1) { ?>
						<p class="p-1" style="background: #22dbfd;color: white;font-weight: bold;font-size: 13px;">Novas</p>
						<? }else if ($dados['ofertas2']==2) { ?>
						<p class="p-1" style="background: #4aa3ff;color: white;font-weight: bold;font-size: 13px;">Quentes</p>
						<? }else { ?>
						<p class="p-1" style="background: #ff0000;color: white;font-weight: bold;font-size: 13px;">Imperdível</p>
						<? } ?>
					</div>
					<a href="<?=URL::getBase() ?>veiculo/<?=$dados['id'];?>/<?=url_amigavel($dados['versao'].'-'.$dados['marcave'].'-'.$dados['modelove']);?>">
					<img class="w-100 img-fluid ng-lazyloaded" src="<?=URL::getBase() ?>admin/uploadfotos/thumbs/<?=$dados['foto'];?>"></a>
					<div class="card-body">
						<p class="f-09 b-5 text-uppercase mb-0 pl-2"><?=$dados['modelove'];?> <?=$dados['versao'];?> </p>
						<p class="f-09 mb-4 pl-2"> <?=$dados['anofabricacao'];?>/<?=$dados['anomodelo'];?> </p>
						<div class="pb-3 clearfix border-bottom">
							<a href="<?=URL::getBase() ?>veiculo/<?=$dados['id'];?>/<?=url_amigavel($dados['versao'].'-'.$dados['marcave'].'-'.$dados['modelove']);?>" class="float-left bg-automix p-2 leads b-9 text-white px-3"> Veja mais </a>
							<!-- span class="float-left bg-automix p-2 leads b-9 text-white"> R$ <?=number_format($dados['valor'], 2, ',', '.');?> </span -->
							<span class="float-right p-2 f-09 text-muted">
								<i class="fa fa-tachometer" aria-hidden="true"></i>
								<?=$dados['km'];?> Km 
							</span>
						</div>
					</div>
				</div>
				<? } 
				$pagina_anterior = $pagina - 1;
				$pagina_posterior = $pagina + 1;
				
				
function createQueryString() {

   $queryString = $_SERVER['QUERY_STRING'];
   $params = 'page';
   parse_str($queryString, $ar);

   $newQueryString = http_build_query(array_diff_key($ar, array($params => '')));

   if($newQueryString != ''):
      return '&'.$newQueryString; 
   endif;

}
$params = createQueryString();
#echo $params;
				
				?>
			
			</div>
			<nav class="col-12">
				<ul class="pagination">
					<li class="page-item">
						<?
						if($pagina_anterior != 0){ ?>
							<a class="page-link" href="<? echo URL::getBase() ?>buscar/pagina/<?=$pagina_anterior; ?>/?/<?=$params;?>" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
						<? }else{ ?>
							<span class="page-link" aria-hidden="true">&laquo;</span>
					<? }  ?>
					</li>
					<? 
					//Apresentar a paginacao
					for($i = 1; $i < $num_pagina + 1; $i++){ ?>
					
					<? if($pagina == $i) { ?>
					
					<li class="page-item active"><span class="page-link"><?=$i;?><span class="sr-only">(atual)</span></span></li>
					
					<? }else{ ?>
					
					<li class="page-item"><a class="page-link" href="<? echo URL::getBase() ?>buscar/pagina/<?=$i;?>/?/<?=$params;?>"><? echo $i; ?></a></li>
					
					<? } } ?>
					<li class="page-item">
						<?
						if($pagina_posterior <= $num_pagina){ ?>
							<a class="page-link" href="<? echo URL::getBase() ?>buscar/pagina/<?=$pagina_posterior;?>/?/<?=$params;?>" aria-label="Previous">
								<span aria-hidden="true">&raquo;</span>
							</a>
						<? }else{ ?>
							<span class="page-link" aria-hidden="true">&raquo;</span>
					<? }  ?>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</section>