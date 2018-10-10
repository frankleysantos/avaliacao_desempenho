<?php 
/**
* 
*/
class Cargo
{
	
	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function listaCargo(){
		$sql = $this->pdo->prepare("SELECT * FROM cargo");
		$sql -> execute();
		return $sql->fetchAll();
	}
}

?>