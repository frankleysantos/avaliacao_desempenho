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
 		$sql = $this->pdo->prepare("SELECT * FROM gestor");
 		$sql ->execute();
 		return $sql->fetchAll();
 	}

 	public function listaStatus($id){
 		$sql = $this->pdo->prepare("SELECT nome, perfil FROM gestor WHERE id = :id");
 		$sql ->bindValue(":id", $id);
 		$sql ->execute();
 		return $sql = $sql->fetch();
 	}
 } 


?>