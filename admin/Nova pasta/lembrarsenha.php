<?php
include('include-topo.php');



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

$msg="Olá $nome, você solicitou a recuperação de senha para o sistema da servitech<br>";
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
	
	$phpmail->Host = "email-ssl.com.br"; // SMTP servers	
	
	$phpmail->Port = "587";	

	

	$phpmail->Username = "site@servitech-am.com.br"; // SMTP username

	$phpmail->Password = "SITEic25tw10##"; // SMTP password
	
	
	$phpmail->IsHTML(true);

   # $phpmail->From = $_POST['email'];

    $phpmail->From = "site@servitech-am.com.br";

    $phpmail->FromName = "Servitech";

   
	$phpmail->AddAddress($email); # pra quem vai
	
	#$phpmail->AddReplyTo($email, $cpf_cnpj);
	
	#$phpmail->addCC($email, $cpf_cnpj);
	
	$mensagem = "Lembrete de senha Servitech";

    $phpmail->Subject = utf8_decode($mensagem);
	
	$phpmail->Body .= "Data da solicitação: ".date("d/m/Y")."<br />";
	
	$phpmail->Body .= "".$msg."<br />"; 
	

    $send = $phpmail->Send();



	
	echo '<script> alert("Senha enviada por e-mail, verifique sua caixa de mensagens ou sua caixa de spans."); window.location="login.php"; </script>';


}
}else{
	
	echo '<script> alert("E-mail não cadastrado em nosso sistema, caso não se lembre do email cadastrado, entre em contato conosco pelos números (92) 3633-1354"); window.location="lembrarsenha.php"; </script>';
	 #echo "Não foi possível enviar a mensagem. Erro: " .$phpmail->ErrorInfo;
   }
	
	}
?>

<!DOCTYPE html>


<div class="login-box lo-gin">
  <div class="login-logo">
    <a><img src="images/logo_login.png" width="300"> </a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Entre com seu email cadastrado no sistema para recuperar.</p>

    <form action="" name="login" id="login" method="post">
      <div class="form-group has-feedback">
        <input name="email" type="email" class="form-control" id="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
      </div>
      <div class="row">
        
        <!-- /.col -->
        <div class="col-xs-4">
			<input name="cadastrar" type="hidden" id="cadastrar" value="1" />
          <button type="submit" class="btn btn-primary btn-flat">ENVIAR</button>
        </div>
        <!-- /.col -->

      </div>
    </form>

    
    <!-- /.social-auth-links -->

 

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<? include ('include-rodape.php'); ?>


