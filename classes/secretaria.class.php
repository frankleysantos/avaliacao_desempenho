<?php  
/**
* 
*/
class Secretaria
{
	
	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function listaSecretaria(){
		$sql = $this->pdo->prepare("SELECT * FROM secretaria");
		$sql -> execute();

		return $sql->fetchAll();
	}
}
?>