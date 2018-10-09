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

	public function inserirResponsabilidade( $id_avaliado, $id_gestor, $responsabilidade_q1, $responsabilidade_obs1, $responsabilidade_q2, $responsabilidade_obs2){
		$sql = $this->pdo->prepare("INSERT INTO responsabilidade (id_avaliado, id_gestor, responsabilidade_q1, responsabilidade_obs1, responsabilidade_q2, responsabilidade_obs2) VALUES (:id_avaliado, :id_gestor, :responsabilidade_q1, :responsabilidade_obs1, :responsabilidade_q2, :responsabilidade_obs2)");
		$sql ->bindValue(":id_gestor", $id_gestor);
		$sql ->bindValue(":id_avaliado", $id_avaliado);
		$sql ->bindValue(":responsabilidade_q1", $responsabilidade_q1);
		$sql ->bindValue(":responsabilidade_obs1", $responsabilidade_obs1);
		$sql ->bindValue(":responsabilidade_q2", $responsabilidade_q2);
		$sql ->bindValue(":responsabilidade_obs2", $responsabilidade_obs2);
		return $sql->execute();
	}

	public function calculoResponsabilidade($id_avaliado){
        $sql = $this->pdo->prepare("SELECT SUM(responsabilidade_q1+responsabilidade_q2) as totalresponsabilidade FROM responsabilidade WHERE id_avaliado = :id_avaliado");
        $sql ->bindValue(":id_avaliado", $id_avaliado);
        $sql ->execute();
        return $sql = $sql->fetch();
	}
}
?>