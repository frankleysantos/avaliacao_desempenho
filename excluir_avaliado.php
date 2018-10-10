<?php 
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/avaliado.class.php";
require "classes/gestor.class.php"; 

$avaliado = new Avaliado($pdo);
$id_avaliado = $_GET['id'];

$avaliado->excluirAvaliado($id_avaliado);
header("Location: lista_avaliado.php");

?>