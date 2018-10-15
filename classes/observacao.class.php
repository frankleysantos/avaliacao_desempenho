<?php  
/**
 * 
 */
class Observacao
{
	private $pdo;

	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}
	public function inserirObservacao($id_avaliado, $id_avaliacao, $obs_comissao, $presidente, $membro_um, $membro_dois){
		$sql = $this->pdo->prepare("INSERT INTO observacao (id_avaliado, id_avaliacao, obs_comissao, presidente, membro_um, membro_dois, obs_time) VALUES (:id_avaliado, :id_avaliacao, :obs_comissao, :presidente, :membro_um, :membro_dois, now())");
		$sql ->bindValue(":id_avaliado", $id_avaliado);
		$sql ->bindValue(":id_avaliacao", $id_avaliacao);
		$sql ->bindValue(":obs_comissao", $obs_comissao);
		$sql ->bindValue(":presidente", $presidente);
		$sql ->bindValue(":membro_um", $membro_um);
		$sql ->bindValue(":membro_dois", $membro_dois);
		return $sql->execute();
	}
	public function listaObservacao($id_avaliado, $id_avaliacao){
		$sql = $this->pdo->prepare("SELECT * FROM observacao WHERE id_avaliado = :id_avaliado AND id_avaliacao = :id_avaliacao");
		$sql ->bindValue(":id_avaliado", $id_avaliado);
		$sql ->bindValue(":id_avaliacao", $id_avaliacao);
		$sql ->execute();
		return $sql = $sql->fetchAll();
	}

}
?>