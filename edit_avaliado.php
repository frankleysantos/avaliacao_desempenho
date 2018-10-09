<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/gestor.class.php";
require "classes/avaliado.class.php";

if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) {
$gestor = new Gestor($pdo);
$avaliado = new Avaliado($pdo);

$chefe = $gestor->listarGestor();
$id = $_GET['id'];

if (isset($_POST['nome']) && !empty($_POST['nome'])) {
	$nome      = addslashes($_POST['nome']);
	$matricula = addslashes($_POST['matricula']);
	$cargo = addslashes($_POST['cargo']);
	$secretaria = addslashes($_POST['secretaria']);
	$data_nomeacao = addslashes($_POST['data_nomeacao']);
	$chefe     = addslashes($_POST['chefe']);

    $avaliado ->updateAvaliado($id, $nome, $matricula, $cargo, $secretaria, $data_nomeacao ,$chefe);
    header("Location: index.php");                                         
}

if (count($avaliado->listaAvaliado($id)) > 0) {
    $aval = $avaliado->listaAvaliado($id);
?>
<form action="" method="POST" role="form">
	<legend>Cadastro do Avaliado</legend>

	<?php foreach ($aval as $info):?>

	<div class="form-group">
		<label for="">Nome</label>
		<input type="text" class="form-control" id="" placeholder="Nome do Gestor" name="nome" required value="<?=$info['nome'];?>">
	</div>

	<div class="form-group">
		<label for="">Matricula</label>
		<input type="text" class="form-control" id="" placeholder="Matricula" name="matricula" required value="<?=$info['matricula'];?>">
	</div>
	<div class="form-group">
		<label for="">Cargo</label>
		<input type="text" class="form-control" id="" placeholder="Cargo" name="cargo" required value="<?=$info['cargo'];?>">
	</div>
	<div class="form-group">
		<label for="">Secretaria</label>
		<input type="text" class="form-control" id="" placeholder="Secretaria" name="secretaria" required value="<?=$info['secretaria'];?>">
	</div>
	<div class="form-group">
		<label for="">Data de Nomeação</label>
		<input type="date" class="form-control" id="" placeholder="Data de Nomeação" name="data_nomeacao" required value="<?=$info['data_nomeacao'];?>">
	</div>


	<div class="form-group">
		<label for="">Chefe</label>
		<select name="chefe" class="form-control" required="required">
			<option value="">Escolha...</option>
			<?php foreach ($chefe as $dado): ?>
			<option value="<?php echo $dado['id']; ?>" <?php if($dado['id'] == $info['id_gestor']) echo 'selected';?>><?php echo $dado['nome']; ?></option>
		    <?php endforeach ?>
		</select>
	</div>
    <?php endforeach ?>
	<button type="submit" class="btn btn-primary">Alterar</button>
</form>

<?php
}
}else{
	header("Location: index.php");
}
require "inc/rodape.php";  

?>