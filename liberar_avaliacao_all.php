<?php  
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/avaliacao.class.php";
require "classes/avaliado.class.php";

$avaliado = new Avaliado($pdo);

if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) {
	//verifica se o perfil é coordenador
	if ($sql['perfil'] == 'coordenador') {  
    $avaliado->statusAvaliacaoAll();
    header("Location: index.php");
    }else{
    	header("Location: index.php");
    }
}else{
	header("Location: index.php");
}

?>