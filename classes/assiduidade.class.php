<?php  
/**
* 
*/
class Assiduidade
{
	private $pdo;
	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function inserirAssiduidade($id_gestor, $id_avaliado, $assiduidade_q1, $assiduidade_obs1, $assiduidade_q2, $assiduidade_obs2){
		$sql = $this->pdo->prepare("INSERT INTO assiduidade (id_gestor, id_avaliado, assiduidade_q1, assiduidade_obs1, assiduidade_q2, assiduidade_obs2) VALUES (:id_gestor, :id_avaliado, :assiduidade_q1, :assiduidade_obs1, :assiduidade_q2, :assiduidade_obs2)");
		$sql ->bindValue(":id_gestor", $id_gestor);
		$sql ->bindValue(":id_avaliado", $id_avaliado);
		$sql ->bindValue(":assiduidade_q1", $assiduidade_q1);
		$sql ->bindValue(":assiduidade_obs1", $assiduidade_obs1);
		$sql ->bindValue(":assiduidade_q2", $assiduidade_q2);
		$sql ->bindValue(":assiduidade_obs2", $assiduidade_obs2);
		return $sql->execute();
	}
	public function calculoAssiduidade($id_avaliado){
        $sql = $this->pdo->prepare("SELECT SUM(assiduidade_q1+assiduidade_q2) as totalassiduidade FROM assiduidade WHERE id_avaliado = :id_avaliado");
        $sql ->bindValue(":id_avaliado", $id_avaliado);
        $sql ->execute();
        return $sql = $sql->fetch();
	}
}
?>