<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/avaliacao.class.php";
require "classes/disciplina.class.php";
require "classes/iniciativa.class.php";
require "classes/produtividade.class.php";
require "classes/responsabilidade.class.php";
require "classes/assiduidade.class.php";
require "classes/avaliado.class.php";

$avaliado          = new Avaliado($pdo);
$assiduidade       = new Assiduidade($pdo);
$disciplina        = new Disciplina($pdo);
$iniciativa        = new Iniciativa($pdo);
$produtividade     = new Produtividade($pdo);
$responsabilidade  = new Responsabilidade($pdo);
$avaliacao         = new Avaliacao($pdo);
$avaliacao         = $avaliacao->listaAvaliacao();
$id = $_GET['id'];


if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])):
	$id_avaliado = $_GET['id'];
    $avaliado = $avaliado->listaAvaliado($id);
	if (isset($_POST['id_avaliacao']) && !empty($_POST['id_avaliacao'])) {
		$id_avaliacao = $_POST['id_avaliacao'];
		$ass = $assiduidade->avaliacaoAssiduidade($id_avaliacao, $id_avaliado);
		if (count($ass) > 0) {
			echo "<div class='alert alert-danger alert-dismissible fade show' role='alert' align='center'>
               <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
               </button>
                <strong>Esta avaliação já foi realizada para este funcionário.</strong>
              </div>";
		}else{
			header("Location: cad_resposta.php?id=$id_avaliado&id_avaliacao=$id_avaliacao");
		}
	}
?>
<form action="" method="POST" role="form">
	<legend>Avaliação</legend>

	<div class="form-group">
		<label for="">Avaliações Cadastradas</label>
		<select name="id_avaliacao" id="inputNome" class="form-control" required="required">
			  <option value="">Escolha...</option>
			<?php foreach ($avaliacao as $info): ?>
			  <option value="<?=$info['id']?>"><?=$info['nome'];?></option>	
			<?php endforeach ?>
		</select>
	</div>
	<button type="submit" class="btn btn-primary">Buscar</button>
</form>
<?php endif ?>
<?php foreach ($avaliado as $aval): ?>
	<div class="jumbotron jumbotron-fluid">
     <div class="container">
     <h1 class="display-4"><?=$aval['nome'];?></h1>
     <p class="lead">Escolha a avaliação que deseja responder do funcionário.</p>
     </div>
    </div>
<?php endforeach ?>
<?php 
require "inc/rodape.php";
 ?>