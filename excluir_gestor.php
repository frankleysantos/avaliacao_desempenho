<?php 
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/gestor.class.php";

if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) {
	//verifica se o perfil é coordenador
	if ($sql['perfil'] == 'coordenador') {
$gestor = new Gestor($pdo);
$id_gestor = $_GET['id_gestor'];

$gestor->excluirGestor($id_gestor);
header("Location: lista_avaliador.php");
}
}
?>