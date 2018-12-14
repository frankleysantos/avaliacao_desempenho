<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/gestor.class.php";
require "classes/avaliado.class.php";
require "classes/secretaria.class.php";
require "classes/cargo.class.php";
require "classes/avaliacao.class.php";

$avaliacao = new Avaliacao($pdo);

$dtavaliacao = $avaliacao->todosAvaliacao();
//date_default_timezone_set('America/Sao_Paulo');
$date = date('d/m/Y');
$data_atual = explode("/", $date);
$dia_atual = $data_atual[0];
$mes_atual = $data_atual[1];
$ano_atual = $data_atual[2];
foreach ($dtavaliacao as $info_avaliacao) {
    $data_final = $info_avaliacao['data_final'];
    $data_fim = explode("/", $data_final);
    $ano_fim = $data_fim[2];
    $mes_fim = $data_fim[1];
    $dia_fim = $data_fim[0];
    if ($ano_atual <= $ano_fim) {
    	if ($mes_atual <= $mes_fim) {
    		if ($dia_atual <= $dia_fim) {
    		echo $dia_fim.$mes_fim."<br>";	
    		}
    	}
    }

    if ($ano_fim > $ano_atual) {
    	echo $dia_fim.$mes_fim."<br>";
    }
}
?>