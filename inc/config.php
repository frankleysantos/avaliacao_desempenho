<?php
try {
	$pdo = new PDO("mysql:dbname=pesquisa; host=localhost", "root", "");
} catch (Exception $e) {
	echo "Erro".$e->getMessage();
}
?>