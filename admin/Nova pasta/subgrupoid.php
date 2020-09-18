<?
session_start();
require("class/classConn.php");
require("class/classAdmin.php");
$objConn  = new conn;
$objAdmin = new admin;
$conn     = $objConn->conexao;
mysqli_query($conn,"SET NAMES 'utf8'");
mysqli_query($conn,'SET character_set_connection=utf8');
mysqli_query($conn,'SET character_set_client=utf8');
mysqli_query($conn,'SET character_set_results=utf8');
require("restrito.php");

$departid = $_POST['grupo']; 

$result = mysqli_query($conn,"SELECT * FROM tbsubgrupo WHERE grupo=".$departid."");

$users_arr = array();

while( $row = mysqli_fetch_array($result) ){
    $userid = $row['id'];
    $subgrupo = $row['subgrupo'];

    $users_arr[] = array("id" => $userid, "subgrupo" => $subgrupo);
}

// encoding array to json format
echo json_encode($users_arr);
?>