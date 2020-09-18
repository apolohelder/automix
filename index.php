<?
 if($_SERVER["HTTPS"] != "on"){
 	header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
 	exit();
 }

session_start();
require("admin/class/classConn.php");
$objConn  = new conn;
$conn     = $objConn->conexao;
mysqli_query($conn,"SET NAMES 'utf8'");
mysqli_query($conn,'SET character_set_connection=utf8');
mysqli_query($conn,'SET character_set_client=utf8');
mysqli_query($conn,'SET character_set_results=utf8');
setlocale(LC_ALL, 'en_US.UTF8');
function url_amigavel($str, $replace=array(), $delimiter='-') {
    if( !empty($replace) ) {
        $str = str_replace((array)$replace, ' ', $str);
    }
 
    $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
    $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
    $clean = strtolower(trim($clean, '-'));
    $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
 
    return $clean;
}
$id = intval(Url::getURL(1));
if(!empty($id)) {
	$querybuscar = mysqli_query($conn,"SELECT * FROM tbgaleriafotos WHERE idgaleria = {$id}");
	$dadosfotos = mysqli_fetch_array($querybuscar);
}
$protocolo = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=="on") ? "https" : "http");
$url = '://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$server = $_SERVER['SERVER_NAME']; 

?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<?php include 'assets/css/bootstrap-css.php' ?>
		<link rel="stylesheet import" href="<?php echo URL::getBase() ?>assets/css/style.css">
		<?php include 'assets/css/nouisliderf0da-css.php' ?>
		<?php include 'admin/css/bootstrap-select.min.php' ?>
		
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,500,700,900&display=swap" rel="stylesheet">
		
		<?php include 'admin/js/jquery-3.4.1.min.php' ?>
		<?php include 'admin/js/popper1.15.0.min.php' ?>
		<?php include 'assets/js/bootstrap.min.php' ?>
		<?php include 'assets/js/nouisliderf0da.php' ?>
		<?php include 'assets/js/wNumb.php' ?>
		<?php include 'admin/js/bootstrap-select.min.php' ?>
		<?php include 'admin/js/defaults-pt_BR.min.php' ?>
		<?php include 'admin/js/jquery.inputmask.bundle.min.php' ?>

		<link rel="icon" href="<?php echo URL::getBase() ?>assets/img/favicon.ico">

		<meta name="robots" content="index">
		<meta name="googlebot" content="index">
		<meta name="googlebot" content="index">
		<meta name="googlebot-news" content="snippet">

		<meta name="keywords" content="Audi, Chevrolet, Citroen, Fiat, Ford, Honda, Hyundai, Jaguar, Jeep, Land Rover, Mercedes-Benz, Nissan, Range Rover, Renault, Toyota, Volkswagen, Yamaha">
		<meta name="description" content="Concessionária Multimarcas referência em atendimento e especialista em Nacionais e Importados. Fundada em 2006 e oferece além de veículos oficina multimarcas própria.">
		<meta property="og:type" content="website">
		<meta property="og:url" content="<?=$protocolo.$url;?>">
		<meta property="og:site_name" content="Automix Multimarcas">
		<? if(!empty($id)) {  ?>
		<meta property="og:image" content="https://<?=$server;?>/admin/uploadfotos/thumbs/<?=$dadosfotos['foto'];?>">
		<? }else{  ?>
		<meta property="og:image" content="https://<?=$server;?>/assets/img/automix.jpg">
		<? }?>
		<meta property="og:image:type" content="image/jpg">
		<meta property="og:description" content="Concessionária Multimarcas referência em atendimento e especialista em Nacionais e Importados. Fundada em 2006 e oferece além de veículos oficina multimarcas própria.">
		
		<script>
			$(document).ready(function(){
				$("#phone").inputmask("(99) 99999-9999");  //static mask
			});
		</script>
		
		<!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-103932828-61"></script>
        <script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			
			gtag('config', 'UA-103932828-61');
        </script>

		<title>Automix Multimarcas</title>
	</head>
	<body>
		<header>
			<nav class="container navbar navbar-expand-lg navbar-light">
				<a class="navbar-brand" href="<?php echo URL::getBase() ?>">
					<img src="<?php echo URL::getBase() ?>assets/img/automix.png" width="60" alt="Automix">
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainMenu" aria-controls="mainMenu" aria-expanded="false" aria-label="Alterna navegação">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="mainMenu">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link" href="<?php echo URL::getBase() ?>">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo URL::getBase() ?>quem-somos">Sobre nós</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo URL::getBase() ?>nossas-linhas">Nossas linhas</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#contatoWhat">Fale Conosco</a>
						</li>
					</ul>
				</div>
			</nav>
			<!-- Modal -->
			<?php include 'include-modal.php' ?>

		</header>
		<?php
			class Url{
				private static $url = null;
				private static $baseUrl = null;
			
				public static function getURL( $id ){
					if( self::$url == null )
					// Verifica se a lista de URL já foi preenchida
					self::getURLList();
				
					// Valida se existe o ID informado e retorna.
					if( isset( self::$url[ $id ] ) )
					return self::$url[ $id ];
				
					// Caso não exista o ID, retorna nulo
					return null;
				}
			
				public static function getBase(){
					if( self::$baseUrl != null )
					return self::$baseUrl;
				
					global $_SERVER;
					$startUrl = strlen( $_SERVER["DOCUMENT_ROOT"] );
					$excludeUrl = substr( $_SERVER["SCRIPT_FILENAME"], $startUrl, -9 );
				
					if( $excludeUrl[0] == "/" )
					self::$baseUrl = $excludeUrl; 
					else self::$baseUrl = "/" . $excludeUrl;
					return self::$baseUrl;
				}
			
				private static function getURLList(){
					
					global $_SERVER;
			  
					// Primeiro traz todos as pastas abaixo do index.php
					$startUrl = strlen( $_SERVER["DOCUMENT_ROOT"] ) -1;
					$excludeUrl = substr( $_SERVER["SCRIPT_FILENAME"], $startUrl, -10 );
					
					// a variável$request possui toda a string da URL após o domínio.
					$request = $_SERVER['REQUEST_URI'];
					
					// Agora retira toda as pastas abaixo da pasta raiz
					$request = substr( $request, strlen( $excludeUrl ) );
					
					// Explode a URL para pegar retirar tudo após o ?
					$urlTmp = explode("?", $request);
					$request = $urlTmp[ 0 ];
					
					// Explo a URL para pegar cada uma das partes da URL
					$urlExplodida = explode("/", $request);
					
					$retorna = array();
				
					for($a = 0; $a <= count($urlExplodida); $a ++){
						if(isset($urlExplodida[$a]) AND $urlExplodida[$a] != ""){
							array_push($retorna, $urlExplodida[$a]);
						}
					}
					self::$url = $retorna;
				}
			}
			//Chama as páginas 
			$modulo = Url::getURL( 0 );
			if( $modulo == null )
			$modulo = "home";
			if( file_exists( "modulos/" . $modulo . ".php" ) )
				require "modulos/" . $modulo . ".php";
			else
				require "modulos/404.php";
		?>
		<footer id="localizacao">
			<div class="py-5" style="background-color:#101010!important">
				<div class="container">
					<div class="row">
						
						<div class="col-xl-3">
							<div class="bg-automix p-4 box-2">
								<h6 class="text-uppercase text-center font-weight-bold border-bottom pb-1 mb-3 f-15"> ATENDIMENTO LOJA FÍSICA</h6>
								<p class="f-08 mb-0 font-weight-bold">Segunda à Sexta:</p>
								<p class="f-08 mb-2">08:00 às 18:00</p>
								<p class="f-08 mb-0 font-weight-bold">Sábado:</p>
								<p class="f-08 mb-2">08:00 às 15:00</p>
							</div>
						</div>
						<div class="col-xl-9">
							<h5 class="h5 text-uppercase font-weight-bold mb-3 text-center">
								<span class="text-title-2">lojas físicas</span>
							</h5>
							<div class="row">
								<div class="col-md-4">
									<address class="b-info__contacts">
										<div class="b-info__contacts-item text-white">
											<span class="fa fa-2x fa-map-marker mr-2 ml-3"></span>
											<strong>AUTOMIX MOTORS</strong>
										</div>
										<div class="b-info__contacts-item mt-3 ml-4">AV. DESEMBARGADOR JOÃO MACHADO, 03 - CAMPOS ELÍSEOS</div>
									</address>
								</div>
								<div class="col-md-4">
									<address class="b-info__contacts">
										<div class="b-info__contacts-item text-white">
											<span class="fa fa-2x fa-map-marker mr-2 ml-3"></span>
											<strong>AUTOMIX MULTIMARCAS</strong>
										</div>
										<div class="b-info__contacts-item mt-3 ml-4">Loja 01<br>AV. DESEMBARGADOR JOÃO MACHADO, 13 - BELVEDERE</div>
									</address>
								</div>
								<div class="col-md-4">
									<address class="b-info__contacts">
										<div class="b-info__contacts-item text-white">
											<span class="fa fa-2x fa-map-marker mr-2 ml-3"></span>
											<strong>AUTOMIX MULTIMARCAS</strong>
										</div>
										<div class="b-info__contacts-item mt-3 ml-4">Loja 02<br>AV. ROUXINOL 51 - CIDADE NOVA</div>
									</address>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid bg-light py-4">
				<div class="container">
					<div class="row">
						<div class="col-md-2">
							<a href="<?php echo URL::getBase() ?>">
								<img src="<?php echo URL::getBase() ?>assets/img/automix.png" height="50" alt="Automix Multimarcas">
							</a>
						</div>
						<div class="col-md-8 text-center f-08">
							<p class="mt-3">© Copyright | Todos os direitos reservados | <a href="http://vanguardacomunicacao.com.br/" class="text-danger" target="_blank">Vanguarda Comunicação</a>
						</div>
						<div class="col-md-2 pt-3">
							<a href="https://www.facebook.com/grupoautomix/" target="_blank"><i class="fa fa-facebook-square text-muted fa-2x" aria-hidden="true"></i></a>
							<a href="" target="_blank"><i class="fa fa-instagram text-muted fa-2x" aria-hidden="true"></i></a>
						</div>
					</div>
				</div>
			</div>
			
		</footer>
		<a class="box-what" href="https://api.whatsapp.com/send?phone=5592991355371&text=%20Ol%C3%A1%2C%20estou%20interessado%20em%20informa%C3%A7%C3%B5es%20sobre%20um%20ve%C3%ADculo%20que%20vi%20no%20site" target="_blank">
			<i class="fa fa-whatsapp" aria-hidden="true"></i>
		</a>
		<!--a class="box-what" href="https://api.whatsapp.com/send?phone=5592991355371" target="_blank">
			<i class="fa fa-whatsapp" aria-hidden="true"></i>
		</a-->
		
	</body>
</html>

