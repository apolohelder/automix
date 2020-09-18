<?
session_start();
require("../class/classConn.php");
require("../class/classAdmin.php");
$objConn  = new conn;
$objAdmin = new admin;
$conn     = $objConn->conexao;
require("restrito.php");
#if($_POST['del_id'])
#{
/*$id=mysqli_real_escape_string($_POST['del_id']);
$delete = "DELETE FROM users WHERE uid=24";
mysqli_query( $delete);
print 1;*/
#}

if(!$_GET['acao']) exit();
if($_GET['acao']=='delRegistro'){
	if(empty($_GET['id_registro']) ) {
		print('alert("O código do registro não foi informado.");');
		exit;
	}
}

 switch ($_GET['acao']){
		 
	case'deletar':
		 $id = mysqli_real_escape_string($conn,$_POST['id']);
		 $tabela = mysqli_real_escape_string($conn,$_POST['tabela']);
	  if($_POST['id']) {
		$query = mysqli_query($conn,"DELETE FROM ".$tabela."
		WHERE id = '{$id}'") or die("Error: " . mysqli_error());
		 
		print 1;
		  break;
	}
		 
		 	
}
	/*$sql = mysqli_query('DELETE FROM '.$_GET['tabela'].' WHERE uid='.$_GET['id_registro'].'');
	if(mysqli_affected_rows()) { #print'alert("'.$_GET['id_registro'].'");';
		print'document.getElementById("linha_'.$_GET['id_registro'].'").style.display="none";';
	}else {
		print'alert("Registro não encontrado!!");';
	}*/
	//print 1;
//	break;
	
 
//}
?>