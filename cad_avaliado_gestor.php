<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/gestor.class.php";
require "classes/avaliado.class.php";

if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) {
$gestor = new Gestor($pdo);
$avaliado = new Avaliado($pdo);

$chefe = $gestor->listarGestor();

if (isset($_POST['nome']) && !empty($_POST['nome'])) {
	$nome      = addslashes($_POST['nome']);
	$matricula = addslashes($_POST['matricula']);
	$cargo = addslashes($_POST['cargo']);
	$secretaria = addslashes($_POST['secretaria']);
	$data_nomeacao = addslashes($_POST['data_nomeacao']);
	$chefe     = addslashes($_POST['chefe']);
    

	if (count($avaliado->verificaAvaliado($matricula)) < 1) {
		$avaliado ->inserirAvaliado($nome, $matricula, $cargo, $secretaria, $data_nomeacao ,$chefe);
		header("Location: index.php");
	}else{
		echo "Matricula já cadastrada";
	}
                                            
}
?>
<form action="" method="POST" role="form">
	<legend>Cadastro do Avaliado (Área Gestor)</legend>

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
		<label for="">Secretaria</label>
		<input type="text" class="form-control" id="" placeholder="Secretaria" name="secretaria" required>
	</div>
	<div class="form-group">
		<label for="">Data de Nomeação</label>
		<input type="date" class="form-control" id="" placeholder="Data de Nomeação" name="data_nomeacao" required>
	</div>


	<div class="form-group">
		<input type="hidden" name="chefe" class="form-control" value="<?php echo $chefe = $_SESSION['Login'];?>">
	</div>

	<button type="submit" class="btn btn-primary">Cadastrar</button>
</form>

<?php
}else{
	header("Location: index.php");
}
require "inc/rodape.php";  
?>