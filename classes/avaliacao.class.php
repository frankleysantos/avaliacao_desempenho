<?php 
/**
* 
*/
class Avaliacao
{
	
	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function listaAvaliacao(){
		$sql = $this->pdo->prepare("SELECT * FROM avaliacao WHERE liberacao = '1'");
		$sql -> execute();
		return $sql->fetchAll();
	}

	public function listaAvaliacaoID($id_avaliacao){
		$sql = $this->pdo->prepare("SELECT * FROM avaliacao WHERE id = :id_avaliacao");
		$sql ->bindValue(":id_avaliacao", $id_avaliacao);
		$sql -> execute();
		return $sql->fetch();
	}

	public function inserirAvaliacao($nome, $data_avaliacao){
		$sql = $this->pdo->prepare("INSERT INTO avaliacao (nome, data_avaliacao, liberacao, insercao) VALUES (:nome, :data_avaliacao, '1', now())");
		$sql ->bindValue(":nome", $nome);
		$sql ->bindValue(":data_avaliacao", $data_avaliacao);
		$sql -> execute();
	}

	public function todosAvaliacao(){
		$sql = $this->pdo->prepare("SELECT * FROM avaliacao");
		$sql -> execute();
		return $sql->fetchAll();
	}

	public function updateAvaliacao($id_avaliacao, $nome, $data_avaliacao){
		$sql = $this->pdo->prepare("UPDATE avaliacao SET nome = :nome, data_avaliacao = :data_avaliacao WHERE id = :id_avaliacao");
		$sql->bindValue(":nome", $nome);
		$sql->bindValue(":data_avaliacao", $data_avaliacao);
		$sql->bindValue(":id_avaliacao", $id_avaliacao);
		return $sql->execute();
	}
}

?>