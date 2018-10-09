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
<form action="" method="POST" role="form">
	<legend>Login do Usuário</legend>

	<div class="form-group">
		<label for="">Matricula</label>
		<input type="text" class="form-control" id="" placeholder="Matricula" name="matricula">
	</div>

	<div class="form-group">
		<label for="">Senha</label>
		<input type="password" class="form-control" id="" placeholder="Senha" name="senha">
	</div>

	

	<button type="submit" class="btn btn-primary">Logar</button>
</form>
<?php
require "inc/rodape.php";  
?>