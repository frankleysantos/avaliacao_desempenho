<?php  
/**
* 
*/
class Produtividade
{
	private $pdo;
	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function inserirprodutividade($id_gestor, $id_avaliado, $produtividade_q1, $produtividade_obs1, $produtividade_q2, $produtividade_obs2){
		$sql = $this->pdo->prepare("INSERT INTO produtividade (id_gestor, id_avaliado, produtividade_q1, produtividade_obs1, produtividade_q2, produtividade_obs2) VALUES (:id_gestor, :id_avaliado, :produtividade_q1, :produtividade_obs1, :produtividade_q2, :produtividade_obs2)");
		$sql ->bindValue(":id_gestor", $id_gestor);
		$sql ->bindValue(":id_avaliado", $id_avaliado);
		$sql ->bindValue(":produtividade_q1", $produtividade_q1);
		$sql ->bindValue(":produtividade_obs1", $produtividade_obs1);
		$sql ->bindValue(":produtividade_q2", $produtividade_q2);
		$sql ->bindValue(":produtividade_obs2", $produtividade_obs2);
		return $sql->execute();
	}
}
?>