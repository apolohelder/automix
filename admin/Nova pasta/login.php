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
	  
	  
      print("<script>location.href = 'index.php?pg=principal&listar=mostrar&link=1&ativo=7'</script>");
	  
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


<div class="login-box lo-gin">
  <div class="login-logo">
    <a><img src="images/logo_login.png" width="300"> </a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Entre com seu email e senha</p>

    <form action="" name="login" id="login" method="post">
      <div class="form-group has-feedback">
        <input name="email" type="email" class="form-control" id="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="senha" type="password" class="form-control" id="senha" placeholder="Senha">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        
        <!-- /.col -->
        <div class="col-xs-4">
			<input name="logar" type="hidden" id="logar" value="1" />
          <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
        </div>
        <!-- /.col -->
		      <a href="lembrarsenha.php" class="btn btn-success  btn-flat">Esqueci a senha</a>

      </div>
		
    </form>

    
    <!-- /.social-auth-links -->

 

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<? include ('include-rodape.php'); ?>


