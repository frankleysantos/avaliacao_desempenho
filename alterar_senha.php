<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/gestor.class.php";

$gestor = new Gestor($pdo);

if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])):
	if ($sql['perfil'] == 'coordenador' || $sql['perfil'] == 'avaliador') { 
		if (isset($_GET['id_gestor']) && !empty($_GET['id_gestor'])):
			$id_gestor = $_GET['id_gestor'];
		$chefe = $gestor->listaGestorID($id_gestor);
		else:;
			$id_gestor = $_SESSION['Login'];
			$chefe = $gestor->listaGestorID($id_gestor);
		endif;
		if (isset($_POST['senha']) && !empty($_POST['senha'])) {
			$senha = $_POST['senha'];
			$gestor->updateSenha($id_gestor, $senha);
			echo "<div class='alert alert-info alert-dismissible fade show' role='alert' align='center'>
			       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			        <span aria-hidden='true'>&times;</span>
			       </button>
			       <strong>Senha do Usuário:&ensp;".$chefe['nome']."&ensp;alterado com sucesso</strong>
			      </div>";	
		}
		?>
		<div class="d-flex justify-content-center">
			<img src="resources/images/logo.png">
		</div>
		<h4 align="center" style="padding-top: 30px; padding-bottom: 30px">Altere a senha do Usuário:<?=$chefe['nome']?></h4>
		<div class="container col-md-4">
			<form action="" method="POST" role="form">
				<div class="form-group">
					<label class="fas fa-key">Nova Senha</label>
					<input type="password" class="form-control" id="Senha" placeholder="*******" name="senha">
				</div>
				<div class="form-group">
					<label class="fas fa-key">Confirmar senha</label>
					<input type="password" class="form-control" id="Confirmar" placeholder="*******" id="Confirmar" onblur="return validasenha(this.value)" name="confirmar">
				</div>

				<div class="form-group" align="right">
					<button type="submit" class="btn btn-primary fas fa-key">Alterar</button>
				</div>
			</form>
		</div>
		<?php
	}	
endif;
require "inc/rodape.php";
?>