<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/gestor.class.php";
require "classes/avaliado.class.php";
require "classes/secretaria.class.php";
require "classes/cargo.class.php";

if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) {
$gestor = new Gestor($pdo);
$avaliado = new Avaliado($pdo);
$secretaria = new Secretaria($pdo);

$cargo = new Cargo($pdo);

$secre = $secretaria->listaSecretaria();

$cargo = $cargo->listaCargo();

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
    header("Location: lista_avaliado.php");                                         
}

if (count($avaliado->listaAvaliado($id)) > 0) {
    $aval = $avaliado->listaAvaliado($id);
?>
<form action="" method="POST" role="form">
	<legend>Edição dados do Avaliado</legend>

	<?php foreach ($aval as $info):?>

	<div class="form-group">
		<label for="">Nome</label>
		<input type="text" class="form-control" id="" placeholder="Nome do Gestor" name="nome" required value="<?=$info['nome'];?>">
	</div>

	<div class="form-group">
		<label for="">Matricula</label>
		<input type="text" class="form-control" id="" placeholder="Matricula" name="matricula" required value="<?=$info['matricula'];?>" onkeyup="numero(this);">
	</div>
	<div class="form-group">
		<label for="">Cargo</label>
		<select name="cargo" class="form-control" required="required">
			<option value="">Escolha...</option>
			<?php foreach ($cargo as $funcao): ?>
			<option value="<?=$funcao['id']?>"<?php if($funcao['id'] == $info['cargo']) echo "selected"?>><?=utf8_encode($funcao['nome'])?></option>	
		    <?php endforeach ?>
		</select>
	</div>
	<div class="form-group">
		<label for="">Secretaria</label>
		<select name="secretaria" class="form-control" required="required">
			<option value="">Escolha...</option>
			<?php foreach ($secre as $dado): ?>
			<option value="<?=$dado['id']?>"<?php if($dado['id'] == $info['secretaria']) echo "selected"?>><?=utf8_encode($dado['nome'])?></option>		
		    <?php endforeach ?>
		</select>
	</div>
	<div class="form-group">
		<label for="">Data de Nomeação</label>
		<input type="text" class="form-control" id="" placeholder="Data de Nomeação" name="data_nomeacao" required value="<?=$info['data_nomeacao'];?>" onkeypress="dataConta(this)" minlength="10" maxlength="10">
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