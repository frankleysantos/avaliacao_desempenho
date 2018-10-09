<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/avaliado.class.php";
require "classes/disciplina.class.php";
require "classes/iniciativa.class.php";
require "classes/produtividade.class.php";
require "classes/responsabilidade.class.php";
require "classes/assiduidade.class.php";

$id_avaliado = $_GET['id_avaliado'];

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

?>
<table class="table table-hover">
	<thead>
		<tr>
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
			<td>Total</td>
			<td><?php echo $total = $tassiduidade+$tdisciplina+$tiniciativa+$tprodutividade+$tresponsabilidade; ?></td>
		</tr>
	</tbody>
</table>