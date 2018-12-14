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

	public function inserirAssiduidade($id_avaliacao, $id_gestor, $id_avaliado, $assiduidade_q1, $assiduidade_obs1, $assiduidade_q2, $assiduidade_obs2){
		$sql = $this->pdo->prepare("INSERT INTO assiduidade (id_avaliacao, id_gestor, id_avaliado, assiduidade_q1, assiduidade_obs1, assiduidade_q2, assiduidade_obs2, insercao) VALUES (:id_avaliacao, :id_gestor, :id_avaliado, :assiduidade_q1, :assiduidade_obs1, :assiduidade_q2, :assiduidade_obs2, now())");
		$sql ->bindValue(":id_avaliacao", $id_avaliacao);
		$sql ->bindValue(":id_gestor", $id_gestor);
		$sql ->bindValue(":id_avaliado", $id_avaliado);
		$sql ->bindValue(":assiduidade_q1", $assiduidade_q1);
		$sql ->bindValue(":assiduidade_obs1", $assiduidade_obs1);
		$sql ->bindValue(":assiduidade_q2", $assiduidade_q2);
		$sql ->bindValue(":assiduidade_obs2", $assiduidade_obs2);
		return $sql->execute();
	}
	public function calculoAssiduidade($id_avaliado, $id_avaliacao){
        $sql = $this->pdo->prepare("SELECT SUM(assiduidade_q1+assiduidade_q2) as totalassiduidade, insercao FROM assiduidade WHERE id_avaliado = :id_avaliado AND id_avaliacao = :id_avaliacao");
        $sql ->bindValue(":id_avaliado", $id_avaliado);
        $sql ->bindValue(":id_avaliacao", $id_avaliacao);
        $sql ->execute();
        return $sql = $sql->fetch();
	}

	public function avaliacaoAssiduidade($id_avaliacao, $id_avaliado){
        $sql = $this->pdo->prepare("SELECT * FROM assiduidade WHERE id_avaliacao = :id_avaliacao AND id_avaliado = :id_avaliado");
        $sql ->bindValue(":id_avaliacao", $id_avaliacao);
        $sql ->bindValue(":id_avaliado", $id_avaliado);
        $sql ->execute();
        return $sql = $sql->fetchAll();
	}

	public function listaAssiduidade($id_avaliado){
		$sql = $this->pdo->prepare("SELECT id FROM assiduidade WHERE id_avaliado = :id_avaliado");
		$sql->bindValue(":id_avaliado", $id_avaliado);
		$sql->execute();
		return $sql = $sql->fetchAll();
	}
    
    public function countAssiduidade($id_avaliado){
		$sql = $this->pdo->prepare("SELECT id_avaliado, count(id_avaliado) as resposta FROM assiduidade WHERE id_avaliado = :id_avaliado GROUP BY id_avaliado");
		$sql->bindValue(":id_avaliado", $id_avaliado);
		$sql->execute();
		return $sql = $sql->fetchAll();
	}


	public function ultNotaAssiduidade($id_avaliado){
        $sql = $this->pdo->prepare("SELECT SUM(assiduidade_q1+assiduidade_q2) as totalassiduidade, insercao FROM assiduidade WHERE id_avaliado = :id_avaliado AND id_avaliacao = (select max(id_avaliacao) from assiduidade WHERE id_avaliado = :id_avaliado)");
        $sql ->bindValue(":id_avaliado", $id_avaliado);
        $sql ->execute();
        return $sql = $sql->fetch();
	}
    

}
?>