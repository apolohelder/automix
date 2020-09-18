<?
function alert($msg){
	echo "<script>alert('$msg');</script>";
}
function redir($url){
	echo "<script>location='$url';</script>";
}
class conn{
	public function __construct(){

		$this->servidor = "localhost";
		$this->usuario  = "manausautomix_siteautomix";
		$this->senha    = ".Kn;)[K16V^y";
		$this->Banco   	= "manausautomix_siteautomix";

		$this->conexao  = mysqli_connect($this->servidor, $this->usuario, $this->senha);
		if($this->conexao == true){
			$this->SelecionaBanco = mysqli_select_db($this->conexao, $this->Banco);
			return $this->conexao;
		}else{
			return exit();
		}
    }
}

?>