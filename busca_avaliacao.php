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

$avaliado          	= new Avaliado($pdo);
$assiduidade       	= new Assiduidade($pdo);
$disciplina        	= new Disciplina($pdo);
$iniciativa        	= new Iniciativa($pdo);
$produtividade     	= new Produtividade($pdo);
$responsabilidade  	= new Responsabilidade($pdo);
$avaliacao         	= new Avaliacao($pdo);
$infoavaliacao		= new Avaliacao($pdo);
$avaliacao         	= $avaliacao->listaAvaliacao();
$dtavaliacao 		= $infoavaliacao->todosAvaliacao();
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
			  <option value="" disabled selected>Escolha a Avaliação...</option>
			<?php  
				$date = date('d/m/Y');
				$data_atual = explode("/", $date);
				$dia_atual = $data_atual[0];
				$mes_atual = $data_atual[1];
				$ano_atual = $data_atual[2];
				foreach ($dtavaliacao as $info_avaliacao) {
				    $data_final = $info_avaliacao['data_final'];
				    $data_fim = explode("/", $data_final);
				    $ano_fim = $data_fim[2];
				    $mes_fim = $data_fim[1];
				    $dia_fim = $data_fim[0];
				    if ($ano_atual == $ano_fim) {
				    	if ($mes_atual <= $mes_fim) {
				    		if ($dia_atual <= $dia_fim) {
				?>
							<option value="<?=$info_avaliacao['id']?>"><?=$info_avaliacao['nome'];?> - <?=$info_avaliacao['data_avaliacao'];?> a <?=$info_avaliacao['data_final'];?></option>	
				<?php	
				    		}
				    	}
				    }
 				   if ($ano_atual < $ano_fim) {
 				?>
 							<option value="<?=$info_avaliacao['id']?>"><?=$info_avaliacao['nome'];?> - <?=$info_avaliacao['data_avaliacao'];?> a <?=$info_avaliacao['data_final'];?></option>	
 				<?php
				    }
				}
			 ?>
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