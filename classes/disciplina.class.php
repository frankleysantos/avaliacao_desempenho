<?php  
/**
* 
*/
class Disciplina
{
	private $pdo;

	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function inserirDisciplina($id_avaliacao, $id_avaliado, $id_gestor,	$disciplina_q1, $disciplina_obs1, $disciplina_q2, $disciplina_obs2){
        $sql = $this->pdo->prepare("INSERT INTO disciplina (id_avaliacao, id_avaliado, id_gestor, disciplina_q1, disciplina_obs1, disciplina_q2, disciplina_obs2, insercao) VALUES (:id_avaliacao, :id_avaliado, :id_gestor, :disciplina_q1, :disciplina_obs1, :disciplina_q2, :disciplina_obs2, now())");
		$sql ->bindValue(":id_avaliacao", $id_avaliacao);
		$sql ->bindValue(":id_gestor", $id_gestor);
		$sql ->bindValue(":id_avaliado", $id_avaliado);
		$sql ->bindValue(":disciplina_q1", $disciplina_q1);
		$sql ->bindValue(":disciplina_obs1", $disciplina_obs1);
		$sql ->bindValue(":disciplina_q2", $disciplina_q2);
		$sql ->bindValue(":disciplina_obs2", $disciplina_obs2);
		return $sql->execute();
	}

	public function calculoDisciplina($id_avaliado, $id_avaliacao){
        $sql = $this->pdo->prepare("SELECT SUM(disciplina_q1+disciplina_q2) as totaldisciplina FROM disciplina WHERE id_avaliado = :id_avaliado AND id_avaliacao = :id_avaliacao");
        $sql ->bindValue(":id_avaliado", $id_avaliado);
        $sql ->bindValue(":id_avaliacao", $id_avaliacao);
        $sql ->execute();
        return $sql = $sql->fetch();
	}

	public function avaliacaoDisciplina($id_avaliacao, $id_avaliado){
        $sql = $this->pdo->prepare("SELECT * FROM disciplina WHERE id_avaliacao = :id_avaliacao AND id_avaliado = :id_avaliado");
        $sql ->bindValue(":id_avaliacao", $id_avaliacao);
        $sql ->bindValue(":id_avaliado", $id_avaliado);
        $sql ->execute();
        return $sql = $sql->fetchAll();
	}
}
?>