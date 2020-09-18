<?
session_start();
require("class/classConn.php");
require("class/classAdmin.php");
$objConn  = new conn;
$objAdmin = new admin;
$conn     = $objConn->conexao;
require("restrito.php");



if(isset($_POST["id"]))
{
 foreach($_POST["id"] as $id)
 {
	 
	 $query2 = mysqli_query($conn,"select * from tbgaleriafotos where id = '".$id."'");
	 $dados = mysqli_fetch_array($query2);
	 
	 $path =  'uploadfotos/thumbs/'.$dados['foto'];
	 $path2 =  'uploadfotos/media/'.$dados['foto'];
	 $path3 =  'uploadfotos/original/'.$dados['foto'];
		
	 unlink($path);
	 unlink($path2);
	 unlink($path3);
	 
  $query = "DELETE FROM tbgaleriafotos WHERE id = '".$id."'";
  mysqli_query($conn, $query);
	 
	 
  echo $query;
 }
}
?>