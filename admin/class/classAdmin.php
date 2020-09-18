<?


class admin 


{

	var $query            = NULL;


	function autenticaUsuario($email, $senha, $tipo, $conn)


	  {




	      $this->email        = $email;

	      $this->senha        = $senha;
		
	      $this->tipo       =   $tipo;


		  $this->conn         = $conn;


		  $this->query        = mysqli_query($this->conn,"select * from usuario


		                                          where email = '".$this->email."'


												 && senha   = '".$this->senha."'
												 
												 
												 && tipo   = '1'");




		  return $this->query;




	  }









}




?>




