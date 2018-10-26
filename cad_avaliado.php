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

$carg = $cargo->listaCargo();

$chefe = $gestor->listarGestorAll();

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

		$avaliado_id = $avaliado->verificaAvaliado($matricula);

		foreach ($avaliado_id as $gestorid) {
			$id = $gestorid['id_gestor'];
		}
		$chefe_nome = $gestor->listaStatus($id);
		echo "<div class='alert alert-danger alert-dismissible fade show' role='alert' align='center'>
               <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
               </button>
                <strong>Matricula do Servidor já cadastrada para o Chefe:&ensp;".$chefe_nome['nome']."</strong>
              </div>";
              $chefe = $gestor->listarGestorAll();
	}
                                            
}
?>
<h4 align="center">Cadastro do Avaliado (Comissão)</h4>
<form action="" method="POST" role="form" style="padding-bottom: 50px;">
	<div class="form-group">
		<label class="fas fa-users">Nome</label>
		<input type="text" class="form-control" id="" placeholder="Nome do Gestor" name="nome" required>
	</div>

	<div class="form-group">
		<label class="fas fa-file-signature">Matricula</label>
		<input type="text" class="form-control" id="" placeholder="Matricula" name="matricula" required onkeyup="numero(this);">
	</div>
	<div class="form-group">
		<label class="fas fa-address-card">Cargo</label>
		<select name="cargo" class="form-control" required="required">
			<option value="">Escolha...</option>
			<?php foreach ($carg as $funcao): ?>
			<option value="<?=$funcao['id']?>"><?=utf8_encode($funcao['nome'])?></option>	
		    <?php endforeach ?>
		</select>
	</div>
	<div class="form-group">
		<label class="fas fa-arrow-circle-right">Secretaria</label>
		<select name="secretaria" class="form-control" required="required">
			<option value="">Escolha...</option>
			<?php foreach ($secre as $dado): ?>
			<option value="<?=$dado['id']?>"><?=utf8_encode($dado['nome'])?></option>		
		    <?php endforeach ?>
		</select>
	</div>
	<div class="form-group">
		<label class="fas fa-calendar-alt">Data de Nomeação</label>
		<input type="text" class="form-control" id="" placeholder="Data de Nomeação" name="data_nomeacao" required onkeypress="dataConta(this)" minlength="10" maxlength="10">
	</div>


	<div class="form-group">
		<label class="fas fa-arrow-circle-right">Chefe</label>
		<select name="chefe" class="form-control" required="required">
			<option value="">Escolha...</option>
			<?php foreach ($chefe as $info): ?>
			<option value="<?php echo $info['id']; ?>"><?php echo $info['nome']; ?></option>
		    <?php endforeach ?>
		</select>
	</div>

	<button type="submit" class="btn btn-primary fas fa-edit">Cadastrar</button>
</form>

<?php
}else{
	header("Location: index.php");
}
require "inc/rodape.php";  
?>