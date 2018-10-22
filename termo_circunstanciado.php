<link href="resources/css/print.css" rel="stylesheet" media="print">
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

 setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
 date_default_timezone_set('America/Sao_Paulo');
$id            = $_GET['id_avaliado'];
//$id_avaliado   = $_GET['id_avaliado'];
$avaliado      = new Avaliado($pdo);
$aval          = $avaliado->listaAvaliado($id);
$assiduidade   = new Assiduidade($pdo);
$avaliado = new Avaliado($pdo);
$assiduidade = new Assiduidade($pdo);         
$disciplina = new Disciplina($pdo);          
$iniciativa = new Iniciativa($pdo);          
$produtividade = new Produtividade($pdo);          
$responsabilidade = new Responsabilidade($pdo);  
$secretaria    = new Secretaria($pdo);
$avaliacao     = new Avaliacao($pdo);

?>
<div class="container">
<h4 align="center" style="padding-top: 50px;padding-bottom: 30px;">TERMO CIRCUNSTANCIADO</h4>
<p align="justify">&ensp;&ensp;&ensp;&ensp;&ensp;Considerando o que dispõe o artigo 41 § 4º	 da Constituição Federal, com as alterações introduzidas pela Emenda Constitucional nº 19/98 que determina a realização de Avaliação de Desempenho durante o período do Estágio  Probatório para cada um dos servidores que ingressaram no serviço público por meio de Concurso Público;</p>
<p align="justify">&ensp;&ensp;&ensp;&ensp;&ensp;Respeitando os termos do Decreto Municipal nº 6811, de  21 de junho de 2012, que regulamenta a Lei Complementar Municipal nº 88 de 16 de junho de 2011;</p>
<p align="justify">&ensp;&ensp;&ensp;&ensp;&ensp;Observando que a normatização municipal e respectiva regulamentação ocorreram em data posterior aos interstícios necessários para implementação da Avaliação de Desempenho;</p>
<p align="justify">&ensp;&ensp;&ensp;&ensp;&ensp;Analisando que não tendo sido realizadas as avaliações ______________ do Estágio Probatório , a Administração Municipal deve legitimar a referida estabilidade , por meio da concessão de pontuação mínima que permita legal, correspondente a 60% ( sessenta por cento) dos pontos relativos a cada um dos itens constantes no Formulário de Avaliaçãi Especial de Desempenho para fins de Estágio Probatório, previstona mencionada Lei Municipal.</p>

	<p><label><b>Servidor:</b></label>
		<?php foreach ($aval as $avalnome) {
		echo $avalnome['nome'];	
		} ?>
	</p>
	<p><label><b>Matricula:</b></label>
        <?php foreach ($aval as $avalnome) {
		echo $avalnome['matricula'];	
		} ?>
	</p>
	<p><label><b>Unidade Administrativa:</b></label>
        <?php foreach ($aval as $avalnome) {
		$id_secretaria = $avalnome['secretaria'];
		$secre = $secretaria->listaSecretariaID($id_secretaria);
        echo $secre['nome'];
		} ?>
	</p>

	<?php 
	$id_avaliado = $_GET['id_avaliado'];    
    $ass = $assiduidade->calculoAssiduidade($id_avaliado, '1');
    $dis = $disciplina->calculoDisciplina($id_avaliado, '1');
    $ini = $iniciativa->calculoIniciativa($id_avaliado, '1');
    $pro = $produtividade->calculoProdutividade($id_avaliado, '1');
    $resp = $responsabilidade->calculoResponsabilidade($id_avaliado, '1');
    $primeira_etapa = $ass['totalassiduidade']+ $dis['totaldisciplina'] + $ini['totaliniciativa'] + $pro['totalprodutividade'] + $resp['totalresponsabilidade'];
    $primeira_data = $ass['insercao'];


    $ass = $assiduidade->calculoAssiduidade($id_avaliado, '2');
    $dis = $disciplina->calculoDisciplina($id_avaliado, '2');
    $ini = $iniciativa->calculoIniciativa($id_avaliado, '2');
    $pro = $produtividade->calculoProdutividade($id_avaliado, '2');
    $resp = $responsabilidade->calculoResponsabilidade($id_avaliado, '2');
    $segunda_etapa = $ass['totalassiduidade']+ $dis['totaldisciplina'] + $ini['totaliniciativa'] + $pro['totalprodutividade'] + $resp['totalresponsabilidade'];
    $segunda_data = $ass['insercao'];

    $ass = $assiduidade->calculoAssiduidade($id_avaliado, '3');
    $dis = $disciplina->calculoDisciplina($id_avaliado, '3');
    $ini = $iniciativa->calculoIniciativa($id_avaliado, '3');
    $pro = $produtividade->calculoProdutividade($id_avaliado, '3');
    $resp = $responsabilidade->calculoResponsabilidade($id_avaliado, '3');
    $terceira_etapa = $ass['totalassiduidade']+ $dis['totaldisciplina'] + $ini['totaliniciativa'] + $pro['totalprodutividade'] + $resp['totalresponsabilidade'];
    $terceira_data = $ass['insercao'];

    $ass = $assiduidade->calculoAssiduidade($id_avaliado, '4');
    $dis = $disciplina->calculoDisciplina($id_avaliado, '4');
    $ini = $iniciativa->calculoIniciativa($id_avaliado, '4');
    $pro = $produtividade->calculoProdutividade($id_avaliado, '4');
    $resp = $responsabilidade->calculoResponsabilidade($id_avaliado, '4');
    $quarta_etapa = $ass['totalassiduidade']+ $dis['totaldisciplina'] + $ini['totaliniciativa'] + $pro['totalprodutividade'] + $resp['totalresponsabilidade'];
    $quarta_data = $ass['insercao'];

    $ass = $assiduidade->calculoAssiduidade($id_avaliado, '5');
    $dis = $disciplina->calculoDisciplina($id_avaliado, '5');
    $ini = $iniciativa->calculoIniciativa($id_avaliado, '5');
    $pro = $produtividade->calculoProdutividade($id_avaliado, '5');
    $resp = $responsabilidade->calculoResponsabilidade($id_avaliado, '5');
    $quinta_etapa = $ass['totalassiduidade']+ $dis['totaldisciplina'] + $ini['totaliniciativa'] + $pro['totalprodutividade'] + $resp['totalresponsabilidade'];
    $quinta_data = $ass['insercao'];

    $ass = $assiduidade->calculoAssiduidade($id_avaliado, '6');
    $dis = $disciplina->calculoDisciplina($id_avaliado, '6');
    $ini = $iniciativa->calculoIniciativa($id_avaliado, '6');
    $pro = $produtividade->calculoProdutividade($id_avaliado, '6');
    $resp = $responsabilidade->calculoResponsabilidade($id_avaliado, '6');
    $sexta_etapa = $ass['totalassiduidade']+ $dis['totaldisciplina'] + $ini['totaliniciativa'] + $pro['totalprodutividade'] + $resp['totalresponsabilidade'];
    $sexta_data = $ass['insercao'];

	 ?>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Data avaliação</th>
				<th>Status</th>
				<th>Pontuação</th>
				<th>Resultado</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?php
				$data = date('d/m/Y', strtotime($primeira_data));
				if ($data == '31/12/1969') {
					echo "";
				}else{
					echo $data;
				}
				?></td>
				<td>
					<?php if ($primeira_etapa > 5): ?>
						<label>Realizado</label>
					<?php else: ?>
						<label>Não Realizado</label>
					<?php endif ?>
				</td>
				<td>
					<?php if ($primeira_etapa > 5): ?>
					<?=$primeira_etapa?></td>
					<?php endif ?>
				<td>
					<?php if ($primeira_etapa > 0):?>
					<?php if ($primeira_etapa >= 60): ?>
						<label>Aprovado</label>
					<?php else: ?>
						<label>Reprovado</label>
					<?php endif ?>
					<?php endif ?>
				</td>
			</tr>

			<tr>
				<td><?php
				$data = date('d/m/Y', strtotime($segunda_data));
				if ($data == '31/12/1969') {
					echo "";
				}else{
					echo $data;
				}?></td>
				<td>
					<?php if ($segunda_etapa > 5): ?>
						<label>Realizado</label>
					<?php else: ?>
						<label>Não Realizado</label>
					<?php endif ?>
				</td>
				<td>
					<?php if ($segunda_etapa > 0): ?>
					<?=$segunda_etapa?>
					<?php endif ?>	
				</td>
				<td>
					<?php if ($segunda_etapa > 0): ?>
					<?php if ($segunda_etapa >= 60): ?>
						<label>Aprovado</label>
					<?php else: ?>
						<label>Reprovado</label>
					<?php endif ?>
					<?php endif ?>
				</td>
			</tr>

			<tr>
				<td><?php
				$data = date('d/m/Y', strtotime($terceira_data));
				if ($data == '31/12/1969') {
					echo "";
				}else{
					echo $data;
				}?></td>
				<td><?php if ($terceira_etapa > 5): ?>
						<label>Realizado</label>
					<?php else: ?>
						<label>Não Realizado</label>
					<?php endif ?></td>
				<td>
					<?php if ($terceira_etapa > 0): ?>
					<?=$terceira_etapa?>
					<?php endif ?>		
				</td>
				<td>
					<?php if ($terceira_etapa > 0): ?>
					<?php if ($terceira_etapa >= 60): ?>
						<label>Aprovado</label>
					<?php else: ?>
						<label>Reprovado</label>
					<?php endif ?>
					<?php endif ?>
				</td>
			</tr>

			<tr>
				<td><?php
				$data = date('d/m/Y', strtotime($quarta_data));
				if ($data == '31/12/1969') {
					echo "";
				}else{
					echo $data;
				}?></td>
				<td>
					<?php if ($quarta_etapa > 5): ?>
						<label>Realizado</label>
					<?php else: ?>
						<label>Não Realizado</label>
					<?php endif ?>
				</td>
				<td>
					<?php if ($quarta_etapa > 0): ?>
					<?=$quarta_etapa?>
					<?php endif ?>
				</td>
				<td><?php if ($quarta_etapa > 0): ?>
					<?php if ($quarta_etapa >= 60): ?>
						<label>Aprovado</label>
					<?php else: ?>
						<label>Reprovado</label>
					<?php endif ?>
					<?php endif ?>
				</td>
			</tr>

			<tr>
				<td><?php
				$data = date('d/m/Y', strtotime($quinta_data));
				if ($data == '31/12/1969') {
					echo "";
				}else{
					echo $data;
				}?></td>
				<td>
					<?php if ($quinta_etapa > 5): ?>
						<label>Realizado</label>
					<?php else: ?>
						<label>Não Realizado</label>
					<?php endif ?>
				</td>
				<td>
					<?php if ($quinta_etapa > 0):?>
					<?=$quinta_etapa?>
					<?php endif ?>
				</td>
				<td><?php if ($quinta_etapa > 0):?>
					<?php if ($quinta_etapa >= 60): ?>
						<label>Aprovado</label>
					<?php else: ?>
						<label>Reprovado</label>
					<?php endif ?>
					<?php endif ?>
				</td>
			</tr>

			<tr>
				<td><?php
				$data = date('d/m/Y', strtotime($sexta_data));
				if ($data == '31/12/1969') {
					echo "";
				}else{
					echo $data;
				}
				?></td>
				<td>
					<?php if ($sexta_etapa > 5): ?>
						<label>Realizado</label>
					<?php else: ?>
						<label>Não Realizado</label>
					<?php endif ?>
				</td>
				<td>
					<?php if ($sexta_etapa > 0):?>
					<?=$sexta_etapa?>
					<?php endif ?>		
				</td>
				<td><?php if ($sexta_etapa > 0):?>
					<?php if ($sexta_etapa >= 60): ?>
						<label>Aprovado</label>
					<?php else: ?>
						<label>Reprovado</label>
					<?php endif ?>
					<?php endif ?>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="row">
	<div class="col-md"><p>Ciente em ____/____/_____ </p></div>
	<div class="col-md" align="center">_________________________________________________________<br>Assinatura do Avaliado</div>
</div>
<p>Secretária Municipal de Administração:_______________________________________________________________________________________________________</p>
<div class="row">
	<div class="col-md-12">
	<p>Comissão de Avaliação:_______________________________________________________________________________________________________________________</p>
	<p>________________________________________________________________________________________________________________________________________________</p>
	<p>________________________________________________________________________________________________________________________________________________</p>
	<p>________________________________________________________________________________________________________________________________________________</p>
	</div>
</div>
<div class="hidden-print">
        <p>
         <a href="#" onclick="window.print()" class="btn btn-warning">Imprimir</a>
         <a href="notificacao_resultado_pdf.php" class="btn btn-danger" target="_blank">Gerar PDF</a>
        </p>
</div>

<?php
require "inc/rodape.php";  
?>
