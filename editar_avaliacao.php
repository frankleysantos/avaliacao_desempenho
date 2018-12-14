<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/avaliacao.class.php";

$avaliacao       = new Avaliacao($pdo);

if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])):
	if ($sql['perfil'] == 'coordenador'):
		if (isset($_GET['id_avaliacao']) && !empty($_GET['id_avaliacao'])) {
			$id_avaliacao   = $_GET['id_avaliacao'];
			if (isset($_POST['nome']) && !empty($_POST['nome'])) {
			$id_atualizado_por  = $_SESSION['Login'];
			$nome           = $_POST['nome'];
			$data_avaliacao = $_POST['data_avaliacao'];
			$data_final		= $_POST['data_final'];
			$avaliacao->updateAvaliacao($id_avaliacao, $nome, $data_avaliacao, $data_final, $id_atualizado_por);
			header("Location: cad_avaliacao_desempenho.php");
			}
		}
		$aval = $avaliacao->listaAvaliacaoID($id_avaliacao);	
?>
<h4 align="center">Editar Avaliação</h4>
<form action="" method="POST" role="form">
	<div class="form-group">
		<label class="fas fa-users">Nome</label>
		<input type="text" class="form-control" id="" placeholder="Ex: primeira avaliação" name="nome" value="<?=$aval['nome']?>">
	</div>
	<div class="form-group">
		<label class="fas fa-calendar-alt">Data Inicial da Avaliação</label>
		<input type="text" class="form-control" id="" placeholder="Ex: 00/00/0000" name="data_avaliacao" onkeypress="dataConta(this)" minlength="10" maxlength="10" value="<?=$aval['data_avaliacao']?>" required>
	</div>
	<div class="form-group">
		<label class="fas fa-calendar-alt">Data Final da Avaliação</label>
		<input type="text" class="form-control" id="" placeholder="Ex: 00/00/0000" name="data_final" onkeypress="dataConta(this)" minlength="10" maxlength="10" value="<?=$aval['data_final']?>" required>
	</div>

	<button type="submit" class="btn btn-primary fas fa-edit">Salvar</button>
</form>
<?php
	endif;
endif;
require "inc/rodape.php";
