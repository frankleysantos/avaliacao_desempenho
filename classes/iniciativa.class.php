<?php  
/**
* 
*/
class Iniciativa
{
	private $pdo;
	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function inserirIniciativa($id_avaliacao, $id_avaliado, $id_gestor, $iniciativa_q1, $iniciativa_obs1, $iniciativa_q2, $iniciativa_obs2){
		$sql = $this->pdo->prepare("INSERT INTO iniciativa (id_avaliacao, id_avaliado, id_gestor, iniciativa_q1, iniciativa_obs1, iniciativa_q2, iniciativa_obs2) VALUES (:id_avaliacao, :id_avaliado, :id_gestor, :iniciativa_q1, :iniciativa_obs1, :iniciativa_q2, :iniciativa_obs2)");
		$sql ->bindValue(":id_avaliacao", $id_avaliacao);
		$sql ->bindValue(":id_gestor", $id_gestor);
		$sql ->bindValue(":id_avaliado", $id_avaliado);
		$sql ->bindValue(":iniciativa_q1", $iniciativa_q1);
		$sql ->bindValue(":iniciativa_obs1", $iniciativa_obs1);
		$sql ->bindValue(":iniciativa_q2", $iniciativa_q2);
		$sql ->bindValue(":iniciativa_obs2", $iniciativa_obs2);
		return $sql->execute();
	}

	public function calculoIniciativa($id_avaliado, $id_avaliacao){
        $sql = $this->pdo->prepare("SELECT SUM(iniciativa_q1+iniciativa_q2) as totaliniciativa FROM iniciativa WHERE id_avaliado = :id_avaliado AND id_avaliacao = :id_avaliacao");
        $sql ->bindValue(":id_avaliado", $id_avaliado);
        $sql ->bindValue(":id_avaliacao", $id_avaliacao);
        $sql ->execute();
        return $sql = $sql->fetch();
	}
}
?>