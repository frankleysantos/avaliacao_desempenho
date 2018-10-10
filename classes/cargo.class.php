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

	public function listaCargoID($id_cargo){
		$sql = $this->pdo->prepare("SELECT nome FROM cargo WHERE id = :id_cargo");
		$sql ->bindValue(":id_cargo", $id_cargo);
		$sql -> execute();
		return $sql->fetch();
	}
}

?>