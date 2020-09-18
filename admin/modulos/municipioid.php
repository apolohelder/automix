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
require("restrito.php");

$departid = $_POST['estado']; 


$result = mysqli_query($conn,"SELECT * FROM tbmunicipio WHERE uf LIKE '$departid'");

$users_arr = array();

while( $row = mysqli_fetch_array($result) ){
    $userid = $row['id'];
    $nome = $row['nome'];

    $users_arr[] = array("id" => $userid, "nome" => $nome);
}

echo json_encode($users_arr);
?>