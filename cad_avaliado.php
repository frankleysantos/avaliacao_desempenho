<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/gestor.class.php";
require "classes/avaliado.class.php";

$gestor = new Gestor($pdo);
$avaliado = new Avaliado($pdo);

$chefe = $gestor->listarGestor();

if (isset($_POST['nome']) && !empty($_POST['nome'])) {
	$nome      = addslashes($_POST['nome']);
	$matricula = addslashes($_POST['matricula']);
	$chefe     = addslashes($_POST['chefe']);

	$avaliado ->inserirAvaliado($nome, $matricula, $chefe);                                            
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
require "inc/rodape.php";  
?>