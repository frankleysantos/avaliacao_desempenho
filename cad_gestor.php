<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/gestor.class.php";

$gestor = new Gestor($pdo);

if (isset($_POST['nome']) && !empty($_POST['nome'])) {
	$nome      = addslashes($_POST['nome']);
	$matricula = addslashes($_POST['matricula']);
	$cargo     = addslashes($_POST['cargo']);
	$senha     = addslashes(md5($_POST['senha']));

	$gestor->inserirGestor($nome, $matricula, $cargo, $senha);
	
}
?>
<form action="" method="POST" role="form">
	<legend>Cadastro do Gestor (Avaliador) </legend>

	<div class="form-group">
		<label for="">Nome</label>
		<input type="text" class="form-control" id="" placeholder="Nome do Gestor" name="nome" required>
	</div>

	<div class="form-group">
		<label for="">Matricula</label>
		<input type="text" class="form-control" id="" placeholder="Matricula" name="matricula" required>
	</div>

	<div class="form-group">
		<label for="">Cargo</label>
		<input type="text" class="form-control" id="" placeholder="Cargo" name="cargo" required>
	</div>

	<div class="form-group">
		<label for="">Senha</label>
		<input type="password" class="form-control" id="" placeholder="Cargo" name="senha" required>
	</div>

	<button type="submit" class="btn btn-primary">Cadastrar</button>
</form>

<?php
require "inc/rodape.php";  
?>