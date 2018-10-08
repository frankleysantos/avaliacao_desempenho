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

	public function inserirAssiduidade($id_gestor, $id_avaliado, $assiduidade_q1, $assiduidade_q2){
		$sql = $this->pdo->prepare("INSERT INTO assiduidade (id_gestor, id_avaliado, assiduidade_q1, assiduidade_q2) VALUES (:id_gestor, :id_avaliado, :assiduidade_q1, :assiduidade_q2)");
		$sql ->bindValue(":id_gestor", $id_gestor);
		$sql ->bindValue(":id_avaliado", $id_avaliado);
		$sql ->bindValue(":assiduidade_q1", $assiduidade_q1);
		$sql ->bindValue(":assiduidade_q2", $assiduidade_q2);
		return $sql->execute();
	}
}
?>