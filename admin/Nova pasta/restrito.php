<?php 


if(isset($_SESSION["email"]) && isset($_SESSION["senha"]) && ($_SESSION["tipo"] == 1))



{



  $autenticaUsuario = $objAdmin->autenticaUsuario($_SESSION["email"], $_SESSION["senha"], $_SESSION["tipo"], $conn);


			print("");


		} else {



			print("<script> location = 'login.php'</script>");



			exit();

}















?>