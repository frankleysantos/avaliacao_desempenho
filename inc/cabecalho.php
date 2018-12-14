<!DOCTYPE html>
<?php 
session_start();
?>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Prefeitura Municipal de Teófilo Otoni</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="resources/css/bootstrap.min.css">
		<link href="resources/css/fontawesome.css" rel="stylesheet">
        <link href="resources/css/brands.css" rel="stylesheet">
        <link href="resources/css/solid.css" rel="stylesheet">
        <link href="resources/css/all.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		
           
            <?php
             if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) {
             require "inc/config.php";
             $id  = $_SESSION['Login'];
             $sql = $pdo->prepare("SELECT substring_index(nome, ' ', 1) as nome, perfil FROM gestor WHERE id = :id");
 		     $sql ->bindValue(":id", $id);
 		     $sql ->execute();
 		     $sql = $sql->fetch();
 		     //echo "<h4 align='right'>Bem Vindo:<label>&ensp;".$sql['nome']."</label></h4>";
 		     }
 		     //SELECT substring_index(nome, ' ', 1) as primeironome FROM login WHERE id = :id
            ?>

            <?php require "inc/menu.php"; ?>
		    <div class="container" style="padding-bottom: 80px;">
			