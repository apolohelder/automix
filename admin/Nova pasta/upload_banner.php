<?
session_start();
require("class/classConn.php");
require("class/classAdmin.php");
$objConn  = new conn;
$objAdmin = new admin;
$conn     = $objConn->conexao;
require("restrito.php");

include('class.upload.php');

	$caracteres = 32;
	$senha = substr(md5(uniqid(rand(), true)),0,$caracteres);
    $handle = new Upload($_FILES['file']);
    if ($handle->uploaded) 	{  
	$teste = $handle->image_src_x;  	
	$nome_da_imagem = $handle->file_new_name_body = $senha;		
	
        $handle->Process('uploadbanner/original');
        
        $handle->image_resize            = true;       
		$handle->image_ratio_x           = true;       	
		$handle->image_y                 = 200;
		$handle->file_new_name_body = "$nome_da_imagem";       
        $handle->Process('uploadbanner/thumbs/');
        
		$handle->image_resize            = true;       
		$handle->image_ratio_x           = true;       	
		$handle->image_y                 = 500;
		$handle->file_new_name_body = "$nome_da_imagem";       
        $handle->Process('uploadbanner/media/');

        $handle-> Clean();

    } 	else 	{       

        echo '<fieldset>';

        echo '  <legend>file not uploaded on the server</legend>';

        echo '  Error: ' . $handle->error . '';

        echo '</fieldset>';

    } 
	
$nomeimagem = "".$nome_da_imagem.".".$handle->file_src_name_ext."";

#echo "upload/original/".$nomeimagem;
echo $nomeimagem;

?>