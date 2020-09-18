<?php 
require("class/classConn.php");
require("class/classAdmin.php");
$objConn  = new conn;
$objAdmin = new admin;
$conn     = $objConn->conexao;



$path = $_POST['path'];
$nome_arquivo = $_POST['id'];
$arquivo = explode('_', $nome_arquivo);


$id = $arquivo[1];
// Check file exist or not
if( file_exists($path) ){

  $query = "DELETE FROM tbgaleriafotos WHERE id = '".$id."'";
  mysqli_query($conn, $query);
	//echo $query;

    // Remove file 
   unlink($path);
  
    // Set status
    $return_text = 1;
}else{

    // Set status
    $return_text = 0;
}

// Return status
echo $return_text;
?>
