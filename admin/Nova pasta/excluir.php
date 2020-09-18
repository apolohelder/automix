<?
session_start();
require("class/classConn.php");
require("class/classAdmin.php");
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
		 
	case'deletarparceiros':
		 $id = mysqli_real_escape_string($conn,$_POST['id']);	
	  if($_POST['id']) {
		$query = mysqli_query($conn,"DELETE FROM tbbannerparceiros
		WHERE id = '{$id}'") or die("Error: " . mysqli_error());
		 
		print 1;
		  break;
	}
		 
	case'deletarcategoriaserv':
		 $id = mysqli_real_escape_string($conn,$_POST['id']);	
	  if($_POST['id']) {
		$query = mysqli_query($conn,"DELETE FROM tbcservitech
		WHERE id = '{$id}'") or die("Error: " . mysqli_error());
		 
		print 1;
		  break;
	}
		 
	case'deletarbanner':
		 $id = mysqli_real_escape_string($conn,$_POST['id']);	
	  if($_POST['id']) {
		$query = mysqli_query($conn,"DELETE FROM tbbanner
		WHERE id = '{$id}'") or die("Error: " . mysqli_error());
		 
		print 1;
		  break;
	}
		 
	case'deletaremail':
		 $id = mysqli_real_escape_string($conn,$_POST['id']);	
	  if($_POST['id']) {
		$query = mysqli_query($conn,"DELETE FROM tbemail
		WHERE id = '{$id}'") or die("Error: " . mysqli_error());
		 
		print 1;
		  break;
	}
		 
	
	case'deletarcategoria':
		 $id = mysqli_real_escape_string($conn,$_POST['id']);	
	  if($_POST['id']) {
		$query = mysqli_query($conn,"DELETE FROM tbcategoria
		WHERE id = '{$id}'") or die("Error: " . mysqli_error());
		 
		print 1;
		  break;
	}
	case'deletarcategoria2':
		 $id = mysqli_real_escape_string($conn,$_POST['id']);	
	  if($_POST['id']) {
		$query = mysqli_query($conn,"DELETE FROM tbcategoria2
		WHERE id = '{$id}'") or die("Error: " . mysqli_error());
		 
		print 1;
		  break;
	}
	case'deletarprodutos':
		 $id = mysqli_real_escape_string($conn,$_POST['id']);	
	  if($_POST['id']) {
		$query = mysqli_query($conn,"DELETE FROM tbprodutos
		WHERE id = '{$id}'") or die("Error: " . mysqli_error());
		 
		print 1;
		  break;
	}
	case'deletarservico':
		 $id = mysqli_real_escape_string($conn,$_POST['id']);	
	  if($_POST['id']) {
		$query = mysqli_query($conn,"DELETE FROM tbservicos
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