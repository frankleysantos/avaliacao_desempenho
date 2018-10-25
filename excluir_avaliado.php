<?php 
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/avaliado.class.php";
require "classes/gestor.class.php"; 

if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) {
	//verifica se o perfil é coordenador
	if ($sql['perfil'] == 'coordenador') {
     $avaliado = new Avaliado($pdo);
     $id_avaliado = $_GET['id'];

     $avaliado->excluirAvaliado($id_avaliado);
     header("Location: lista_avaliado.php");
    }
}

?>