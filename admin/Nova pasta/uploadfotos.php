<?php
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

include('class.upload.php');

	$caracteres = 32;
	$senha = substr(md5(uniqid(rand(), true)),0,$caracteres);
    $handle = new Upload($_FILES['file']);
    if ($handle->uploaded) 	{  
	$teste = $handle->image_src_x;  	
	$nome_da_imagem = $handle->file_new_name_body = $senha;		
	
        $handle->Process('uploadfotos/original');
        
        $handle->image_resize            = true;       
		$handle->image_ratio_x           = true;       	
		$handle->image_y                 = 200;
		$handle->file_new_name_body = "$nome_da_imagem";       
        $handle->Process('uploadfotos/thumbs/');
        
		$handle->image_resize            = true;       
		$handle->image_ratio_x           = true;       	
		$handle->image_y                 = 500;
		$handle->file_new_name_body = "$nome_da_imagem";       
        $handle->Process('uploadfotos/media/');

        $handle-> Clean();

    } 	else 	{       

        echo '<fieldset>';

        echo '  <legend>file not uploaded on the server</legend>';

        echo '  Error: ' . $handle->error . '';

        echo '</fieldset>';

    } 
	
$nomeimagem = "".$nome_da_imagem.".".$handle->file_src_name_ext."";

#echo "upload/original/".$nomeimagem;
#echo $nomeimagem;

    $idgaleria = $_POST['galleryid'];

	#$nomeimagem = $_POST['nomeimagem'];
	#$noticia = $_POST['editor'];	
	
	
	$query = mysqli_query($conn,"INSERT INTO tbgaleriafotos (idgaleria,foto) VALUES ('$idgaleria','$nomeimagem')")  or die (mysqli_error($conn));

?>