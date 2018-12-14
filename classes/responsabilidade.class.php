<?php  
/**
* 
*/
class Responsabilidade
{
	private $pdo;
	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function inserirResponsabilidade($id_avaliacao, $id_avaliado, $id_gestor, $responsabilidade_q1, $responsabilidade_obs1, $responsabilidade_q2, $responsabilidade_obs2){
		$sql = $this->pdo->prepare("INSERT INTO responsabilidade (id_avaliacao, id_avaliado, id_gestor, responsabilidade_q1, responsabilidade_obs1, responsabilidade_q2, responsabilidade_obs2, insercao) VALUES (:id_avaliacao, :id_avaliado, :id_gestor, :responsabilidade_q1, :responsabilidade_obs1, :responsabilidade_q2, :responsabilidade_obs2, now())");
		$sql ->bindValue(":id_avaliacao", $id_avaliacao);
		$sql ->bindValue(":id_gestor", $id_gestor);
		$sql ->bindValue(":id_avaliado", $id_avaliado);
		$sql ->bindValue(":responsabilidade_q1", $responsabilidade_q1);
		$sql ->bindValue(":responsabilidade_obs1", $responsabilidade_obs1);
		$sql ->bindValue(":responsabilidade_q2", $responsabilidade_q2);
		$sql ->bindValue(":responsabilidade_obs2", $responsabilidade_obs2);
		return $sql->execute();
	}

	public function calculoResponsabilidade($id_avaliado, $id_avaliacao){
        $sql = $this->pdo->prepare("SELECT SUM(responsabilidade_q1+responsabilidade_q2) as totalresponsabilidade FROM responsabilidade WHERE id_avaliado = :id_avaliado AND id_avaliacao = :id_avaliacao");
        $sql ->bindValue(":id_avaliado", $id_avaliado);
        $sql ->bindValue(":id_avaliacao", $id_avaliacao);
        $sql ->execute();
        return $sql = $sql->fetch();
	}

	public function avaliacaoResponsabilidade($id_avaliacao, $id_avaliado){
        $sql = $this->pdo->prepare("SELECT * FROM responsabilidade WHERE id_avaliacao = :id_avaliacao AND id_avaliado = :id_avaliado");
        $sql ->bindValue(":id_avaliacao", $id_avaliacao);
        $sql ->bindValue(":id_avaliado", $id_avaliado);
        $sql ->execute();
        return $sql = $sql->fetchAll();
	}


	public function ultNotaResponsabilidade($id_avaliado){
        $sql = $this->pdo->prepare("SELECT SUM(responsabilidade_q1+responsabilidade_q2) as totalresponsabilidade, insercao FROM responsabilidade WHERE id_avaliado = :id_avaliado AND id_avaliacao = (select max(id_avaliacao) from responsabilidade WHERE id_avaliado = :id_avaliado)");
        $sql ->bindValue(":id_avaliado", $id_avaliado);
        $sql ->execute();
        return $sql = $sql->fetch();
	}
}
?>