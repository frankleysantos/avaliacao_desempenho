<?php  
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/avaliado.class.php";
require "classes/disciplina.class.php";
require "classes/iniciativa.class.php";
require "classes/produtividade.class.php";
require "classes/responsabilidade.class.php";
require "classes/assiduidade.class.php";
require "classes/secretaria.class.php";
require "classes/cargo.class.php";
require "classes/avaliacao.class.php";
require "classes/observacao.class.php";
require "classes/gestor.class.php";

if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) {
	//verifica se o perfil é coordenador
	if ($sql['perfil'] == 'coordenador') { 

$id_avaliado = $_GET['id_avaliado'];
$id_avaliacao = $_GET['id_avaliacao'];
$assiduidade = new Assiduidade($pdo);
$obs_assiduidade = $assiduidade->avaliacaoAssiduidade($id_avaliacao, $id_avaliado);
$disciplina = new Disciplina($pdo);
$obs_disciplina = $disciplina->avaliacaoDisciplina($id_avaliacao, $id_avaliado);
$iniciativa = new Iniciativa($pdo);
$obs_iniciativa = $iniciativa->avaliacaoIniciativa($id_avaliacao, $id_avaliado);
$produtividade = new Produtividade($pdo);
$obs_produtividade = $produtividade->avaliacaoProdutividade($id_avaliacao, $id_avaliado);
$responsabilidade = new Responsabilidade($pdo);
$obs_responsabilidade = $responsabilidade->avaliacaoResponsabilidade($id_avaliacao, $id_avaliado);
?>
<div class="container" style="padding-bottom:100px;">
<h4>Assiduidade - Observações:</h4>
<?php
foreach ($obs_assiduidade as $obs):
?>
<div class="row">
	<div class="col-md">
	<div class="form-group">
		<label for="textarea" class="col-sm-2 control-label">Questão 1:</label>
		<div class="col-sm-10">
			<textarea name="" id="textarea" class="form-control" required="required" rows="4" disabled><?=$obs['assiduidade_obs1'];?></textarea>
		</div>
	</div>
	</div>
	<div class="col-md">
	<div class="form-group">
		<label for="textarea" class="col-sm-2 control-label">Questão 2:</label>
		<div class="col-sm-10">
			<textarea name="" id="textarea" class="form-control" required="required" rows="4" disabled><?=$obs['assiduidade_obs2'];?></textarea>
		</div>
	</div>
	</div>
</div>
<?php endforeach;?>

<h4>Disciplina - Observações:</h4>
<?php
foreach ($obs_disciplina as $obs):
?>
<div class="row">
	<div class="col-md">
	<div class="form-group">
		<label for="textarea" class="col-sm-2 control-label">Questão 1:</label>
		<div class="col-sm-10">
			<textarea name="" id="textarea" class="form-control" required="required" rows="4" disabled><?=$obs['disciplina_obs1'];?></textarea>
		</div>
	</div>
	</div>
	<div class="col-md">
	<div class="form-group">
		<label for="textarea" class="col-sm-2 control-label">Questão 2:</label>
		<div class="col-sm-10">
			<textarea name="" id="textarea" class="form-control" required="required" rows="4" disabled><?=$obs['disciplina_obs2'];?></textarea>
		</div>
	</div>
	</div>
</div>
<?php endforeach;?>

<h4>Iniciativa - Observações:</h4>
<?php
foreach ($obs_iniciativa as $obs):
?>
<div class="row">
	<div class="col-md">
	<div class="form-group">
		<label for="textarea" class="col-sm-2 control-label">Questão 1:</label>
		<div class="col-sm-10">
			<textarea name="" id="textarea" class="form-control" required="required" rows="4" disabled><?=$obs['iniciativa_obs1'];?></textarea>
		</div>
	</div>
	</div>
	<div class="col-md">
	<div class="form-group">
		<label for="textarea" class="col-sm-2 control-label">Questão 2:</label>
		<div class="col-sm-10">
			<textarea name="" id="textarea" class="form-control" required="required" rows="4" disabled><?=$obs['iniciativa_obs2'];?></textarea>
		</div>
	</div>
	</div>
</div>
<?php endforeach;?>

<h4>Produtividade - Observações:</h4>
<?php
foreach ($obs_produtividade as $obs):
?>
<div class="row">
	<div class="col-md">
	<div class="form-group">
		<label for="textarea" class="col-sm-2 control-label">Questão 1:</label>
		<div class="col-sm-10">
			<textarea name="" id="textarea" class="form-control" required="required" rows="4" disabled><?=$obs['produtividade_obs1'];?></textarea>
		</div>
	</div>
	</div>
	<div class="col-md">
	<div class="form-group">
		<label for="textarea" class="col-sm-2 control-label">Questão 2:</label>
		<div class="col-sm-10">
			<textarea name="" id="textarea" class="form-control" required="required" rows="4" disabled><?=$obs['produtividade_obs2'];?></textarea>
		</div>
	</div>
	</div>
</div>
<?php endforeach;?>

<h4>Responsabilidade - Observações:</h4>
<?php
foreach ($obs_responsabilidade as $obs):
?>
<div class="row">
	<div class="col-md">
	<div class="form-group">
		<label for="textarea" class="col-sm-2 control-label">Questão 1:</label>
		<div class="col-sm-10">
			<textarea name="" id="textarea" class="form-control" required="required" rows="4" disabled><?=$obs['responsabilidade_obs1'];?></textarea>
		</div>
	</div>
	</div>
	<div class="col-md">
	<div class="form-group">
		<label for="textarea" class="col-sm-2 control-label">Questão 2:</label>
		<div class="col-sm-10">
			<textarea name="" id="textarea" class="form-control" required="required" rows="4" disabled><?=$obs['responsabilidade_obs2'];?></textarea>
		</div>
	</div>
	</div>
</div>
<?php endforeach;?>


<!--Fecha o container-->
</div>
<?php  
    }else{
    header("Location: index.php");
    }
}else{
    header("Location: index.php");
}
?>