<?php  
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/avaliacao.class.php";
require "classes/avaliado.class.php";

$avaliado = new Avaliado($pdo);

$avaliado->statusAvaliacaoAll();
header("Location: index.php");
?>