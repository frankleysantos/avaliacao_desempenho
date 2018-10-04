<?php
try {
	$pdo = new PDO("mysql:dbname=avaliacao_desempenho; host=localhost", "root", "");
} catch (Exception $e) {
	echo "Erro".$e->getMessage();
}
?>