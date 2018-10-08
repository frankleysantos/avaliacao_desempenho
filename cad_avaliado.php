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

	$avaliado ->inserirAvaliado($nome, $matricula, $cargo, $secretaria, $data_nomeacao ,$chefe);                                            
}
?>
<form action="" method="POST" role="form">
	<legend>Cadastro do Avaliado</legend>

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
		<label for="">Chefe</label>
		<select name="chefe" class="form-control" required="required">
			<option value="">Escolha...</option>
			<?php foreach ($chefe as $info): ?>
			<option value="<?php echo $info['id']; ?>"><?php echo $info['nome']; ?></option>
		    <?php endforeach ?>
		</select>
	</div>

	<button type="submit" class="btn btn-primary">Cadastrar</button>
</form>

<?php
}else{
	header("Location: index.php");
}
require "inc/rodape.php";  
?>