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
	echo "<div class='alert alert-success alert-dismissible fade show' role='alert' align='center'>
               <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
               </button>
                <strong>Gestor cadastrado com sucesso!</strong>
              </div>";
	
}
?>
<form action="" method="POST" role="form">
	<legend align="center">Cadastro do Gestor (Avaliador) </legend>

	<div class="form-group">
		<label class="fas fa-users">Nome</label>
		<input type="text" class="form-control" id="" placeholder="Nome do Gestor" name="nome" required>
	</div>

	<div class="form-group">
		<label class="fas fa-file-signature">Matricula</label>
		<input type="text" class="form-control" id="" placeholder="Matricula" name="matricula" required>
	</div>

	<div class="form-group">
		<label class="fas fa-address-card">Cargo</label>
		<input type="text" class="form-control" id="" placeholder="Cargo" name="cargo" required>
	</div>

	<div class="form-group">
		<label class="fas fa-key">Senha</label>
		<input type="password" class="form-control" id="" placeholder="Cargo" name="senha" required>
	</div>

	<button type="submit" class="btn btn-primary fas fa-edit">Cadastrar</button>
</form>

<?php
require "inc/rodape.php";  
?>