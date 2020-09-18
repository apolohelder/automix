<?
session_start();
require("../class/classConn.php");
require("../class/classAdmin.php");
$objConn  = new conn;
$objAdmin = new admin;
$conn     = $objConn->conexao;
mysqli_query($conn,"SET NAMES 'utf8'");
mysqli_query($conn,'SET character_set_connection=utf8');
mysqli_query($conn,'SET character_set_client=utf8');
mysqli_query($conn,'SET character_set_results=utf8');

$id=$_POST['id'];
$destaque=$_POST['destaque'];

$query = mysqli_query($conn,"UPDATE tbveiculos SET

	 destaque   = '{$destaque}'

	 WHERE id  = '{$id}'") or die("Error: " . mysqli_error($conn));
?>

