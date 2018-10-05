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

	public function respAvaliadoOK($id){
		$sql = $this->pdo->prepare("SELECT a.id, a.nome, a.matricula FROM avaliado as a INNER JOIN resposta as r ON a.id = r.id_avaliado AND a.id_gestor = r.id_gestor WHERE a.id = :id");
		$sql ->bindValue(":id", $id);
		$sql ->execute();
		return $sql->fetchAll();
	}

	public function respAvaliadoNO($id){
		$sql = $this->pdo->prepare("SELECT a.id, a.nome, a.matricula, (SELECT status FROM gestor WHERE id = :id) as status FROM avaliado as a, resposta as r WHERE a.id != r.id_gestor AND a.id_gestor = :id");
		$sql ->bindValue(":id", $id);
		$sql ->execute();
		return $sql->fetchAll();
	}

	public function inserirAvaliado($nome, $matricula, $chefe){
		$sql = $this->pdo->prepare("INSERT INTO avaliado (nome, matricula, id_gestor) VALUES (:nome, :matricula, :id_gestor)");
		$sql ->bindValue(":nome", $nome);
		$sql ->bindValue(":matricula", $matricula);
		$sql ->bindValue(":id_gestor", $chefe);
		return $sql ->execute();
	}
}
?>