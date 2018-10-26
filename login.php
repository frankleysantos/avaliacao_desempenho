<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/gestor.class.php";

$gestor = new Gestor($pdo);

/*Função verifica se o Chefe já esta cadastrado, se estiver cria a session login e direciona para o index.php*/

if (isset($_POST['matricula']) && !empty($_POST['matricula']) && isset($_POST['senha']) && !empty($_POST['senha'])) {
	$matricula = addslashes($_POST['matricula']);
	$senha     = $_POST['senha'];
	$chefe = $gestor->loginGestor($matricula, $senha);
	   
	if (count($chefe) > 0) {
		foreach ($chefe as $dado) {
			$_SESSION['Login'] = $dado['id'];
			if (!empty($_SESSION['Login'])) {
				header("Location: index.php");
			}
		}
	}
}
?>
<div class="container" align="center">
<div class="d-flex justify-content-center">
    <img src="resources/images/logo.png">
</div>
<div class="d-flex justify-content-center">
	<h4 align="center">Digite sua matricula e senha.</h4>
</div>


<form action="" method="POST" role="form">
	<div class="form-group col-md-4">
		<label class="fas fa-user-lock">Matricula</label>
		<input type="text" class="form-control" id="" placeholder="000000" name="matricula" required autofocus>
	</div>

	<div class="form-group col-md-4">
		<label class="fas fa-key">Senha</label>
		<input type="password" class="form-control" id="" placeholder="********" name="senha" required autofocus>
	</div>

	<div class="form-group col-md-4" align="right">
	<button type="submit" class="btn btn-primary fas fa-sign-in-alt">&ensp;Logar</button>
	</div>
</form>
</div>
<?php
require "inc/rodape.php";  
?>