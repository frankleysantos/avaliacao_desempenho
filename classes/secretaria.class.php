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

	public function listaSecretariaID($id_secretaria){
		$sql = $this->pdo->prepare("SELECT nome FROM secretaria WHERE id = :id_secretaria");
		$sql ->bindValue(":id_secretaria", $id_secretaria);
		$sql -> execute();

		return $sql->fetch();
	}
}
?>