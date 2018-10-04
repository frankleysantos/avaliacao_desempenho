<?php  
/**
* 
*/
class Avaliado
{
	 private $pdo;

	 public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function listarAvaliado(){
		$sql = $this->pdo->prepare("SELECT * FROM avaliado");
		$sql ->execute();
		return $sql->fetchAll();
	}
}
?>