<?php
include('include-topo.php');

#session_start();

if (isset($_POST['logar'])){
	
	$tipo = 1; // 1 admin

  $autenticaUsuario = $objAdmin->autenticaUsuario($_POST["email"], $_POST["senha"], $tipo, $conn);
  if(mysqli_num_rows($autenticaUsuario))
  {   
  
  
      
      $arrayUsuario = mysqli_fetch_array($autenticaUsuario);
      $_SESSION["id"]  = $arrayUsuario["id"];
	  $_SESSION["email"]  = $arrayUsuario["email"];
	  $_SESSION["senha"]  = $arrayUsuario["senha"];
      $_SESSION["nome"]   = $arrayUsuario["nome"];
      $_SESSION["tipo"]   = $arrayUsuario["tipo"]; // 1 admin

	  
	   
	    date_default_timezone_set("America/Manaus");
	  	setlocale(LC_ALL, 'pt_BR');
	 
	  	$datahora = date("Y-m-d H:i:s");
		$banco = "idusuario,datahora";
    	$variaveis = "'{$_SESSION['id']}','$datahora'";
		$sql = mysqli_query($conn,"INSERT INTO acessos (".$banco.") VALUES (".$variaveis.")") or die("Erro no comando SQL:".mysqli_error());
	  
	  
      print("<script>location.href = 'principal/listar/listar'</script>");
	  
  } 
  else
  {
      print("<script>alert('E-mail ou senha incorretos');</script>");
  }
}
#############
function ultimoAcesso() {
   
      $sql = "
      SELECT DATE_FORMAT(datahora, '%d/%m/%Y às %H:%i:%s') AS dataf
      FROM acessos
      WHERE idusuario = '".$_SESSION['id']."'
      ORDER BY datahora DESC LIMIT 1,1";
      
      $rs = mysqli_query($sql) OR DIE(mysqli_ERROR());
      
      if (mysqli_affected_rows()) {
         $c = mysqli_fetch_assoc($rs);
         return $c['dataf'];
      } else {
         return "Esta é sua primeira visita.";
      }
   }
?>

<!DOCTYPE html>


<div class="container h-100">
		<div class="row h-100 justify-content-center align-items-center">
			<div class="card">
				 <div class="login-logo m-3">
    <a><img src="images/logo_login.png"> </a>
  </div>
				<h4 class="card-header">Entre com seu email e senha</h4>
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
								<div class="form-group">
									
								  <div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fa fa-unlock" aria-hidden="true"></i></span>
										</div>
									  <input name="senha" type="password" required="" class="form-control" id="senha" placeholder="Senha">
									</div>
									
								</div>
							</div>
						</div>
				
						<div class="row">
							<div class="col-md-12">
								<input name="logar" type="hidden" id="logar" value="1" />
								<input type="submit" class="btn btn-success btn-lg btn-block" value="Entrar" name="submit">
							</div>
						</div>
					</form>
					<div class="clear"></div>
					
					<i class="fa fa-undo fa-fw pt-3"></i> Esqueceu a senha? <a href="<?=URL::getBase(); ?>recuperarsenha.php">Recuperar</a>
				</div>
			</div>
		</div>
	</div>
<!-- /.login-box -->

<? include ('include-rodape.php'); ?>


