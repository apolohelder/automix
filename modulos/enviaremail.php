<?

if(isset($_POST['enviarcadastro']) && !empty($_POST['enviarcadastro']))	{
	


require '../PHPMailer-master/PHPMailerAutoload.php';

$erros = "";

if( empty($erros) ){


    $phpmail = new PHPMailer();
	
	$phpmail->IsSMTP(); // envia por SMTP
    $phpmail->SMTPAuth = true; // Caso o servidor SMTP precise de autenticação    
	
	//$phpmail->SMTPSecure = "ssl";
	
	$phpmail->Host = "mail.automixmanaus.com.br"; // SMTP servers	
	$phpmail->Port = "587";	
	$phpmail->CharSet = 'UTF-8';
	$phpmail->Username = "enviaremail@automixmanaus.com.br"; // SMTP username
	$phpmail->Password = "admin123!@#"; // SMTP password
	
	
	$phpmail->IsHTML(true);

   # $phpmail->From = $_POST['email'];

    $phpmail->From = 'enviaremail@automixmanaus.com.br';
    $phpmail->FromName = "Contato do site Auto Mix";
    $arquivo   = $_FILES["arquivo"];
	
	$phpmail->AddAddress("marketing@grupoautomix.com");
	
    $phpmail->Subject = "Contato do site Auto Mix ";
    $phpmail->Body .= "Nome: ".$_POST['nome']."<br />"; 
	$phpmail->Body .= "E-mail: ".$_POST['email']."<br />"; 
	$phpmail->Body .= "Telefone de Contato: ".$_POST['telefone']."<br />"; 
	$phpmail->Body .= "Assunto: ".$_POST['assunto']."<br />"; 
	$phpmail->Body .= "Mensagem: ".$_POST['mensagem']."<br />"; 
	
	if(!empty($_POST['modelo'])) {
		$phpmail->Body .= "Dados do veículo: ".$_POST['modelo']."<br />";
		#$phpmail->Body .= "Valor: ".$_POST['valor']."<br />";
	}
		
    $send = $phpmail->Send();
    
    if($send){
		$server = $_SERVER['SERVER_NAME']; 
		$redi = "https://$server/obrigado";
		echo '<script> window.location="'.$redi.'"; </script>';
		##print $codigofinal;
		#print $strSQL;
    }else{
       echo "Não foi possível enviar a mensagem. Erro: " .$phpmail->ErrorInfo;
    }
}else{
    echo $erros;
}


}

?>
