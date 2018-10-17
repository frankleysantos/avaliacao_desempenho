<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/avaliacao.class.php";
require "classes/gestor.class.php";
require "classes/observacao.class.php";

$avaliacao       = new Avaliacao($pdo);
$gestor = new Gestor($pdo);
$observacao = new Observacao($pdo);
$comissao = $gestor->listarGestor();


if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])):
	//if que verifica as informações vindas do formulário
	if (isset($_POST['obs_comissao']) && !empty($_POST['obs_comissao'])):
		$id_avaliado  = $_GET['id'];
        $id_avaliacao = $_GET['id_avaliacao'];
        $obs_comissao = $_POST['obs_comissao'];
        $presidente   = $_POST['presidente'];
        $membro_um    = $_POST['membro_um'];
        $membro_dois  = $_POST['membro_dois'];
        $observacao ->inserirObservacao($id_avaliado, $id_avaliacao, $obs_comissao, $presidente, $membro_um, $membro_dois);
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert' align='center'>
               <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
               </button>
                <strong>Observação cadastrada com sucesso!</strong>
              </div>";
	endif; // encerra o if do formulário
endif;//encerra o if da sessão
?>

<!--Formulário para cadastro de observação-->
<form action="" method="POST" role="form">
	<legend>Observação comissão avaliadora.</legend>

	<div class="form-group">
            <label><b>Observações</b></label>
            <textarea class="form-control" rows="3" name="obs_comissao"></textarea>
    </div>
    <div class="form-group">
            <label><b>Presidente</b></label>
            <select name="presidente" id="inputPresidente" class="form-control" required="required">
            	<option value="">Escolha o Presidente...</option>
            	<?php foreach ($comissao as $info): ?>
            	<option value="<?=$info['id']?>"><?=$info['nome']?></option>
                <?php endforeach ?>
            </select>
    </div>	
    <div class="form-group">
            <label><b>Membro da comissão 1</b></label>
            <select name="membro_um" class="form-control" required="required">
            	<option value="">Escolha membro da comissão 1...</option>
            	<?php foreach ($comissao as $info): ?>
            	<option value="<?=$info['id']?>"><?=$info['nome']?></option>
                <?php endforeach ?>
            </select>
    </div>
    <div class="form-group">
            <label><b>Membro da comissão 2</b></label>
            <select name="membro_dois" class="form-control" required="required">
            	<option value="">Escolha membro da comissão 2...</option>
            	<?php foreach ($comissao as $info): ?>
            	<option value="<?=$info['id']?>"><?=$info['nome']?></option>
                <?php endforeach ?>
            </select>
    </div>	
	<button type="submit" class="btn btn-primary">Cadastrar</button>
</form>

<?php  
require "inc/rodape.php";
?>