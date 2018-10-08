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

	public function respAvaliado($id){
		$sql = $this->pdo->prepare("SELECT a.id, a.nome, a.matricula, a.status, (SELECT perfil FROM gestor WHERE id =:id) as perfil FROM avaliado as a WHERE a.id_gestor = :id");
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

	public function updateStatus($id_avaliado){
		$sql = $this->pdo->prepare("UPDATE avaliado SET status = '1' WHERE id = :id_avaliado");
		$sql ->bindValue(":id_avaliado", $id_avaliado);
		return $sql ->execute();
	}
}
?>