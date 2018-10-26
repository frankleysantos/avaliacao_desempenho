<?php
/**
 * 
 */
 class Gestor
 {
 	private $pdo;

 	public function __construct($pdo)
 	{
 		$this->pdo = $pdo;
 	}

 	public function inserirGestor($nome, $matricula, $cargo, $secretaria, $perfil, $senha){
 		$sql = $this->pdo->prepare("INSERT INTO gestor (nome, matricula, cargo, secretaria, perfil, senha, insercao) VALUES (:nome, :matricula, :cargo, :secretaria, :perfil, :senha, now())");
 		$sql->bindValue(":nome", $nome);
 		$sql->bindValue(":matricula", $matricula);
 		$sql->bindValue(":cargo", $cargo);
 		$sql->bindValue(":secretaria", $secretaria);
 		$sql->bindValue(":perfil", $perfil);
 		$sql->bindValue(":senha", $senha);
 		return $sql->execute();
 	}

 	public function loginGestor($matricula, $senha){
 		$sql = $this->pdo->prepare("SELECT * FROM gestor WHERE matricula = :matricula AND senha = md5(:senha)");
 		$sql->bindValue(":matricula", $matricula);
 		$sql->bindValue(":senha", $senha);
 		$sql->execute();
 		return $sql->fetchAll();
 	}

 	public function listarGestor(){
 		$sql = $this->pdo->prepare("SELECT * FROM gestor WHERE perfil = 'coordenador'");
 		$sql ->execute();
 		return $sql->fetchAll();
 	}

 	public function listarGestorAll(){
 		$sql = $this->pdo->prepare("SELECT * FROM gestor ORDER BY nome");
 		$sql ->execute();
 		return $sql->fetchAll();
 	}

 	public function listaStatus($id){
 		$sql = $this->pdo->prepare("SELECT nome, perfil FROM gestor WHERE id = :id");
 		$sql ->bindValue(":id", $id);
 		$sql ->execute();
 		return $sql = $sql->fetch();
 	}

 	public function listaGestorID($id_gestor){
 		$sql = $this->pdo->prepare("SELECT * FROM gestor WHERE id = :id_gestor");
 		$sql ->bindValue(":id_gestor", $id_gestor);
 		$sql ->execute();
 		return $sql = $sql->fetch();
 	}

 	public function updateGestor($id_gestor, $nome, $matricula, $cargo, $secretaria, $perfil){
 		$sql = $this->pdo->prepare("UPDATE gestor SET nome = :nome, matricula = :matricula, cargo = :cargo, secretaria = :secretaria, perfil = :perfil WHERE id = :id_gestor");
 		$sql->bindValue(":nome", $nome);
 		$sql->bindValue(":matricula", $matricula);
 		$sql->bindValue(":cargo", $cargo);
 		$sql->bindValue(":secretaria", $secretaria);
 		$sql->bindValue(":perfil", $perfil);
 		$sql->bindValue(":id_gestor", $id_gestor);
 		return $sql->execute();
 	}
 } 


?>