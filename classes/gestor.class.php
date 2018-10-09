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

 	public function inserirGestor($nome, $matricula, $cargo, $senha){
 		$sql = $this->pdo->prepare("INSERT INTO gestor (nome, matricula, cargo, senha) VALUES (:nome, :matricula, :cargo, :senha)");
 		$sql->bindValue(":nome", $nome);
 		$sql->bindValue(":matricula", $matricula);
 		$sql->bindValue(":cargo", $cargo);
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