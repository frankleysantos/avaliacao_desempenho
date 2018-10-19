<?php 
require "inc/cabecalho.php";

if (isset($_POST['relatorio']) && !empty($_POST['relatorio'])) {
	if ($_POST['relatorio'] == 'capa') {
		$id_avaliado = $_GET['id_avaliado'];
	    header("Location: impressao_capa_avaliacao.php?id_avaliado=$id_avaliado");
	}
	if ($_POST['relatorio'] == 'notificacao') {
		$id_avaliado = $_GET['id_avaliado'];
	    header("Location: notificacao_resultado.php?id_avaliado=$id_avaliado");
	}
	if ($_POST['relatorio'] == 'parecer') {
		$id_avaliado = $_GET['id_avaliado'];
	    header("Location: calculo_avaliacao.php?id_avaliado=$id_avaliado");
	}
	if ($_POST['relatorio'] == 'ratificacao') {
		$id_avaliado = $_GET['id_avaliado'];
	    header("Location: calculo_avaliacao.php?id_avaliado=$id_avaliado");
	}
}
?>
<h3>Busque aqui os relatórios cadastrados para: <?=$nome=$_GET['nome']?></h3>
<form action="" method="POST" role="form" style="padding-top: 20px; padding-bottom: 20px;">
	<legend>Escolha o relatório que deseja emitir.</legend>
	<div class="row">
	<div class="col-md-6">
	<select name="relatorio" id="input" class="form-control" required="required">
		<option>Escolha o relatório...</option>
		<option value="capa">Capa Avaliação</option>
		<option value="notificacao">Notificação Resultado da Avaliação</option>
		<option value="parecer">Parecer Final</option>
		<option value="ratificacao">Ratificação do Ato de aprovação</option>
	</select>
    </div>
	<button type="submit" class="btn btn-primary" >Buscar</button>
	</div>
</form>