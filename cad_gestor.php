<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/gestor.class.php";
require "classes/secretaria.class.php";
require "classes/cargo.class.php";

$gestor = new Gestor($pdo);
$secretaria = new Secretaria($pdo);
$cargo = new Cargo($pdo);
$secre = $secretaria->listaSecretaria();
$cargo = $cargo->listaCargo();

if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) {
	//verifica se o perfil é coordenador
	if ($sql['perfil'] == 'coordenador') { 

     if (isset($_POST['nome']) && !empty($_POST['nome'])) {
	    $nome      = addslashes($_POST['nome']);
	    $matricula = addslashes($_POST['matricula']);
	    $cargo     = addslashes($_POST['cargo']);
	    $secretaria= addslashes($_POST['secretaria']);
	    $senha     = addslashes(md5($_POST['senha']));

	    $gestor->inserirGestor($nome, $matricula, $cargo, $secretaria, $senha);
	    echo "<div class='alert alert-success alert-dismissible fade show' role='alert' align='center'>
               <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
               </button>
                <strong>Gestor cadastrado com sucesso!</strong>
              </div>";
	
     }
?>
<h4 align="center">Cadastro do Gestor (Avaliador) </h4>
<form action="" method="POST" role="form" style="padding-bottom: 100px;">
	<div class="form-group">
		<label class="fas fa-users">Nome</label>
		<input type="text" class="form-control" id="" placeholder="Nome Completo" name="nome" required>
	</div>

	<div class="form-group">
		<label class="fas fa-file-signature">Matricula</label>
		<input type="text" class="form-control" id="" placeholder="0000000" name="matricula" required>
	</div>

	<div class="form-group">
		<label class="fas fa-address-card">Cargo</label>
		<select name="cargo" class="form-control" required="required">
			<option value="">Escolha...</option>
			<?php foreach ($cargo as $funcao): ?>
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
		<label class="fas fa-key">Senha</label>
		<input type="password" class="form-control" id="" placeholder="*******" name="senha" required>
	</div>

	<button type="submit" class="btn btn-primary fas fa-edit">Cadastrar</button>
</form>

<?php
    }else{
    	header("Location: index.php");
    }
}else{
	header("Location: index.php");
}
require "inc/rodape.php";  
?>