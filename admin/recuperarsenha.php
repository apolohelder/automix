<?
session_start();
require("class/classConn.php");
$objConn  = new conn;
$conn     = $objConn->conexao;
mysqli_query($conn,"SET NAMES 'utf8'");
mysqli_query($conn,'SET character_set_connection=utf8');
mysqli_query($conn,'SET character_set_client=utf8');
mysqli_query($conn,'SET character_set_results=utf8');

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Recuperar Senha</title>
<link rel="stylesheet" href="css/bootstrap4.1.3.css">
<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/popper1.15.0.min.js"></script>
<script src="js/bootstrap4.1.3.min.js"></script>
<script src="bootbox/bootbox.min.js"></script>
<script src="bootbox/bootbox.locales.min.js"></script>
</head>
<body>
<?
if(isset($_POST['cadastrar']) && !empty($_POST['cadastrar']))	{

		

$email=$_POST['email'];
	
	$query = mysqli_query($conn,"SELECT * FROM usuario WHERE email = '$email'");


$verifica=mysqli_num_rows($query);
	
	#echo $verifica;

if($verifica == 1){

while($dados = mysqli_fetch_array($query)){
                $nome = $dados['nome'];
                $senha = $dados['senha'];
                }

$msg="Olá $nome, você solicitou a recuperação de senha para o sistema da Automix<br>";
$msg.="Sua senha é: $senha";

#########################################################################

require 'PHPMailer-master/PHPMailerAutoload.php';
$erros = "";

if( empty($erros) ){

	#$phpmail->CharSet = 'UTF-8';

    $phpmail = new PHPMailer();
	
	$phpmail->IsSMTP(); // envia por SMTP

    $phpmail->SMTPAuth = true; // Caso o servidor SMTP precise de autenticação
    
	
	//$phpmail->SMTPSecure = "ssl";
	
	$phpmail->Host = "mail.automixmanaus.com.br"; // SMTP servers	
	
	$phpmail->Port = "587";	

	

	$phpmail->Username = "enviaremail@automixmanaus.com.br"; // SMTP username

	$phpmail->Password = "admin123!@#"; // SMTP password
	
	
	$phpmail->IsHTML(true);

   # $phpmail->From = $_POST['email'];

    $phpmail->From = "enviaremail@automixmanaus.com.br";

    $phpmail->FromName = "Automix";

   
	$phpmail->AddAddress($email); # pra quem vai
	
	#$phpmail->AddReplyTo($email, $cpf_cnpj);
	
	#$phpmail->addCC($email, $cpf_cnpj);
	
	$mensagem = "Lembrete de senha Automix";

    $phpmail->Subject = $mensagem;
	
	$phpmail->Body .= "Data da solicitação: ".date("d/m/Y")."<br />";
	
	$phpmail->Body .= "".$msg."<br />"; 
	

    $send = $phpmail->Send();


echo '<script> bootbox.alert("Senha enviada por e-mail, verifique sua caixa de mensagens ou sua caixa de spans.", function(){     location.href = \'login.php\';  })</script>';
	

}
	
}else{
	
	echo '<script>	bootbox.alert("E-mail não cadastrado em nosso sistema, caso não se lembre do email cadastrado."); </script>';

	 #echo "Não foi possível enviar a mensagem. Erro: " .$phpmail->ErrorInfo;
   }
	
}
?>
<div class="container h-100">
		<div class="row h-100 justify-content-center align-items-center">
			<div class="card">
				 <div class="login-logo m-3">
    <a><img src="images/logo_login.png"> </a>
  </div>
				<h4 class="card-header">Entre com seu email para recuperar.</h4>
				<div class="card-body">				
					<form action="" name="login" id="login" method="post">					
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
								
								  <div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fa fa-envelope-open-o" aria-hidden="true"></i></span>
										</div>
									  <input name="email" type="text" required="" class="form-control" id="email" placeholder="E-mail">
									</div>
									
								</div>
							</div>
						</div>				
				
						<div class="row">
							<div class="col-md-12">
								<input name="cadastrar" type="hidden" id="cadastrar" value="1" />
								<input type="submit" class="btn btn-success btn-lg btn-block" value="Recuperar minha senha" name="submit">
							</div>
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</div>
</body>
</html>

