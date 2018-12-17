<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/avaliacao.class.php";
require "classes/historico_avaliacao.class.php";

$avaliacao       = new Avaliacao($pdo);
$historico 		 = new HistoricoAvaliacao($pdo);

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
			if (isset($_POST['hist_nome']) && !empty($_POST['hist_nome'])) {
				$hist_nome 			= $_POST['hist_nome'];
				$hist_data_inicio	= $_POST['hist_data_inicio'];
				$hist_data_fim		= $_POST['hist_data_fim'];
				$hist_atualizado_por= $_SESSION['Login'];
				$historico->inserirHistorico($id_avaliacao, $hist_nome, $hist_data_inicio, $hist_data_fim, $hist_atualizado_por, $nome, $data_avaliacao, $data_final);
			}
			header("Location: cad_avaliacao_desempenho.php");
			}
		}
		$aval = $avaliacao->listaAvaliacaoID($id_avaliacao);	
?>
<h4 align="center">Editar Avaliação</h4>
<form action="" method="POST" role="form">
	<div class="form-group">
		<label class="fas fa-users">Nome</label>
		<input type="text" class="form-control" id="" placeholder="Ex: primeira avaliação" name="nome" value="<?=utf8_encode($aval['nome'])?>">
		<input type="hidden" name="hist_nome" value="<?=utf8_encode($aval['nome'])?>">
	</div>
	<div class="form-group">
		<label class="fas fa-calendar-alt">Data Inicial da Avaliação</label>
		<input type="text" class="form-control" id="" placeholder="Ex: 00/00/0000" name="data_avaliacao" onkeypress="dataConta(this)" minlength="10" maxlength="10" value="<?=$aval['data_avaliacao']?>" required>
		<input type="hidden" name="hist_data_inicio" value="<?=$aval['data_avaliacao']?>">
	</div>
	<div class="form-group">
		<label class="fas fa-calendar-alt">Data Final da Avaliação</label>
		<input type="text" class="form-control" id="" placeholder="Ex: 00/00/0000" name="data_final" onkeypress="dataConta(this)" minlength="10" maxlength="10" value="<?=$aval['data_final']?>" required>
		<input type="hidden" name="hist_data_fim" value="<?=$aval['data_final']?>">
	</div>

	<button type="submit" class="btn btn-primary fas fa-edit">Salvar</button>
</form>
<?php
	endif;
endif;
require "inc/rodape.php";
