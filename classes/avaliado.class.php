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
		$sql = $this->pdo->prepare("SELECT a.id, a.nome, a.matricula, a.status, (SELECT perfil FROM gestor WHERE id =:id) as perfil FROM avaliado as a WHERE a.id_gestor = :id ORDER BY status asc");
		$sql ->bindValue(":id", $id);
		$sql ->execute();
		return $sql->fetchAll();
	}

	public function inserirAvaliado($nome, $matricula, $cargo, $secretaria, $data_nomeacao ,$chefe){
		$sql = $this->pdo->prepare("INSERT INTO avaliado (nome, matricula, cargo, secretaria, data_nomeacao, id_gestor) VALUES (:nome, :matricula, :cargo, :secretaria, :data_nomeacao, :id_gestor)");
		$sql ->bindValue(":nome", $nome);
		$sql ->bindValue(":matricula", $matricula);
		$sql ->bindValue(":cargo", $cargo);
		$sql ->bindValue(":secretaria", $secretaria);
		$sql ->bindValue(":data_nomeacao", $data_nomeacao);
		$sql ->bindValue(":id_gestor", $chefe);
		return $sql ->execute();
	}

	public function updateStatus($id_avaliado){
		$sql = $this->pdo->prepare("UPDATE avaliado SET status = '1' WHERE id = :id_avaliado");
		$sql ->bindValue(":id_avaliado", $id_avaliado);
		return $sql ->execute();
	}

	public function verificaAvaliado($matricula){
        $sql = $this->pdo->prepare("SELECT * FROM avaliado WHERE matricula = :matricula");
        $sql ->bindValue(":matricula", $matricula);
        $sql ->execute();
        return $sql = $sql ->fetchAll();
	}
}
?>