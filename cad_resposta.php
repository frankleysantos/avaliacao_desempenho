<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/avaliado.class.php";
require "classes/assiduidade.class.php";

$assiduidade = new Assiduidade($pdo);
$avaliado    = new Avaliado($pdo);

if (isset($_POST['assiduidade_q1']) && !empty($_POST['assiduidade_q1'])) {
	$id_gestor      = $_SESSION['Login'];
	$id_avaliado    = $_GET['id'];
	$assiduidade_q1 = $_POST['assiduidade_q1'];
	$assiduidade_q2 = $_POST['assiduidade_q2'];
    
    $assiduidade->inserirAssiduidade($id_gestor, $id_avaliado, $assiduidade_q1, $assiduidade_q2);
    $avaliado->updateStatus($id_avaliado);
    header("Location: index.php");

}
?>

<form action="" method="POST" role="form">
	<hr>
    <h4>Assiduidade</h4>
	<div class="form-group">
		<label for=""><b>II/A- ASSIDUIDADE: Considere como assiduidade a regularidade do colaborador ao local de trabalho,ausentando apenas por motivos justos e com anuência dos superiores:</b></label>
		<div class="radio">
			<label>
				<input type="radio" name="assiduidade_q1" value="10.0" required>
				10.0 – É sempre pontual no cumprimento dos horários de entrada e saída das escalas normais e extraordinárias.
			</label>
			<label>
				<input type="radio" name="assiduidade_q1" value="7.5">
				7.5 - Quando faltou,teve justificativa compatível,procurando avisar a chefia antecipadamente, evitando o comprometimento do trabalho.
			</label>
			<label>
				<input type="radio" name="assiduidade_q1" value="5.0">
				5.0 – As vezes atrasa nos horários de entrada e de saída das escalas normais, apesar de não comprometer o trabalho. 
			</label>
			<label>
				<input type="radio" name="assiduidade_q1" value="2.5">
				2.5 - Falta constantemente, atrasa com frequência sem dar justificativas, comprometendo o planejamento da equipe .
			</label>
		</div>
	</div>
	<div class="form-group">
		<label for=""><b>II/B- ASSIDUIDADE: Considere como assiduidade, a participação do colaborador em cursos de aprimoramento promovidos pela Prefeitura:</b></label>
		<div class="radio">
			<label>
				<input type="radio" name="assiduidade_q2" value="10.0" required>
				10.0 – Participa,  recomenda, pede ou sugere cursos para melhorar seus conhecimentos na área.
			</label>
			<label>
				<input type="radio" name="assiduidade_q2" value="7.5">
				7.5 - Participa sempre de cursos de aperfeiçoamento, reuniões de orientação.
			</label>
			<label>
				<input type="radio" name="assiduidade_q2" value="5.0">
				5.0 – Participa as vezes de algumas reuniões ou cursos de orientação profissional. 
			</label>
			<label>
				<input type="radio" name="assiduidade_q2" value="2.5">
				2.5 - Não demonstra interesse em participar de cursos de aperfeiçoamento ou reuniões que objetivam transmitir novos conhecimentos técnicos.
			</label>
		</div>
	</div>
	<hr>

	<button type="submit" class="btn btn-primary">Cadastrar</button>
</form>