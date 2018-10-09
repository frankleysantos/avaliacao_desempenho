<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/avaliado.class.php";
require "classes/disciplina.class.php";
require "classes/iniciativa.class.php";
require "classes/produtividade.class.php";
require "classes/responsabilidade.class.php";
require "classes/assiduidade.class.php";

if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) {
	if ($sql['perfil'] == 'coordenador') {

$id_avaliado = $_GET['id_avaliado'];

$avaliado = new Avaliado($pdo);

$assiduidade = new Assiduidade($pdo);

$ass = $assiduidade->calculoAssiduidade($id_avaliado);

$disciplina = new Disciplina($pdo);

$dis = $disciplina->calculoDisciplina($id_avaliado);

$iniciativa = new Iniciativa($pdo);

$ini = $iniciativa->calculoIniciativa($id_avaliado);

$produtividade = new Produtividade($pdo);

$pro = $produtividade->calculoProdutividade($id_avaliado);

$responsabilidade = new Responsabilidade($pdo);

$resp = $responsabilidade->calculoResponsabilidade($id_avaliado);


$aval = $avaliado->listaAvaliado($id_avaliado);
foreach ($aval as $dado):
?>
<table class="table table-striped table-hover">
	<legend align="center" class="table-success">Avaliação Especial de Desempenho em Estágio Probatório</legend>
	<thead>
		<tr>
			<th>Nome do Avaliado:</th>
			<td colspan="2"><?php echo $dado['nome']; ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th>Data da nomeação:</th>
			<td><?php echo $dado['data_nomeacao']; ?></td>
			<td><b>Cargo:</b>&ensp;<?php  echo $dado['cargo'];?></td>
		</tr>
		<tr>
			<th>Unidade Administrativa:</th>
			<td colspan="2"><?php echo $dado['secretaria']; ?></td>
		</tr>
		<tr>
			<th>Matrícula:</th>
			<td colspan="2"><?php echo $dado['matricula']; ?></td>
		</tr>
	</tbody>
</table>
<?php endforeach ?>
<table class="table table-hover">
	<legend align="center" class="table-success">Resultados da Análise de Desempenho</legend>
	<thead>
		<tr class="table-success">
			<th>Fatores</th>
			<th>Pontos</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Assiduidade</td>
			<td><?php echo $tassiduidade = $ass['totalassiduidade']; ?></td>
		</tr>
		<tr>
			<td>Disciplina</td>
			<td><?php echo $tdisciplina = $dis['totaldisciplina']; ?></td>
		</tr>
		<tr>
			<td>Capac. Iniciativa</td>
			<td><?php echo $tiniciativa = $ini['totaliniciativa']; ?></td>
		</tr>
		<tr>
			<td>Produtividade</td>
			<td><?php echo $tprodutividade = $pro['totalprodutividade']; ?></td>
		</tr>
		<tr>
			<td>Responsabilidade</td>
			<td><?php echo $tresponsabilidade = $resp['totalresponsabilidade']; ?></td>
		</tr>
		<tr>
			<td><b>Total</b></td>
			<td><b><label class="btn btn-info"><?php echo $total = $tassiduidade+$tdisciplina+$tiniciativa+$tprodutividade+$tresponsabilidade; ?></label></b></td>
		</tr>
	</tbody>
</table>
<table class="table table-striped table-hover">
	<legend align="center" class="table-dark">Conceitos:</legend>
	<thead>
		<tr class="table-success">
			<th>Insatisfatório</th>
			<th>Regular</th>
			<th>Bom</th>
			<th>Excelente</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>De 10 a 24</td>
			<td>De 25 a 54</td>
			<td>De 55 a 84</td>
			<td>De 85 a 100</td>
		</tr>
		<tr align="center">
		<?php if ($total < 25):?>
            <td colspan="4"><h4>Resultado da Avaliação: <label class="btn btn-danger">Insatisfatório</label><p>Desempenho ruim, desta forma exonera.</p></h4></td>
		<?php endif ?>
		<?php if ($total >= 25 && $total < 55):?>
            <td colspan="4"><h4>Resultado da Avaliação: <label class="btn btn-warning">Regular</label><p>Desempenho satisfaz, em parte, e assim com dois conceito de REGULAR, exonera</p></h4></td>
		<?php endif ?>
		<?php if ($total >= 55 && $total < 85):?>
            <td colspan="4"><h4>Resultado da Avaliação: <label class="btn btn-success">Bom</label><p>Desempenho satisfaz, efetiva  (média de 60 % )</p></h4></td>
		<?php endif ?>
		<?php if ($total >= 85 && $total <= 100):?>
            <td colspan="4"><h4>Resultado da Avaliação: <label class="btn btn-primary">Excelente</label><p>Desempenho  ultrapassa , efetiva</p></h4></td>
		<?php endif ?>
		</tr>
	</tbody>
</table>

<?php
 }else{
 	header("Location: index.php");
 }
}else{
	header("Location: index.php");
}
require "inc/rodape.php";  
?>