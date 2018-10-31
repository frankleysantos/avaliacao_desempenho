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

	public function inserirProdutividade($id_avaliacao, $id_avaliado, $id_gestor, $produtividade_q1, $produtividade_obs1, $produtividade_q2, $produtividade_obs2){
		$sql = $this->pdo->prepare("INSERT INTO produtividade (id_avaliacao, id_avaliado, id_gestor, produtividade_q1, produtividade_obs1, produtividade_q2, produtividade_obs2, insercao) VALUES (:id_avaliacao, :id_avaliado, :id_gestor, :produtividade_q1, :produtividade_obs1, :produtividade_q2, :produtividade_obs2, now())");
		$sql ->bindValue(":id_avaliacao", $id_avaliacao);
		$sql ->bindValue(":id_gestor", $id_gestor);
		$sql ->bindValue(":id_avaliado", $id_avaliado);
		$sql ->bindValue(":produtividade_q1", $produtividade_q1);
		$sql ->bindValue(":produtividade_obs1", $produtividade_obs1);
		$sql ->bindValue(":produtividade_q2", $produtividade_q2);
		$sql ->bindValue(":produtividade_obs2", $produtividade_obs2);
		return $sql->execute();
	}

	public function calculoProdutividade($id_avaliado, $id_avaliacao){
        $sql = $this->pdo->prepare("SELECT SUM(produtividade_q1+produtividade_q2) as totalprodutividade FROM produtividade WHERE id_avaliado = :id_avaliado AND id_avaliacao = :id_avaliacao");
        $sql ->bindValue(":id_avaliado", $id_avaliado);
        $sql ->bindValue(":id_avaliacao", $id_avaliacao);
        $sql ->execute();
        return $sql = $sql->fetch();
	}

	public function avaliacaoProdutividade($id_avaliacao, $id_avaliado){
        $sql = $this->pdo->prepare("SELECT * FROM produtividade WHERE id_avaliacao = :id_avaliacao AND id_avaliado = :id_avaliado");
        $sql ->bindValue(":id_avaliacao", $id_avaliacao);
        $sql ->bindValue(":id_avaliado", $id_avaliado);
        $sql ->execute();
        return $sql = $sql->fetchAll();
	}
}
?>