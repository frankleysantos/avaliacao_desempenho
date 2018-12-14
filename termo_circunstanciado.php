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
$assiduidade = new Assiduidade($pdo);         
$disciplina = new Disciplina($pdo);          
$iniciativa = new Iniciativa($pdo);          
$produtividade = new Produtividade($pdo);          
$responsabilidade = new Responsabilidade($pdo);  
$secretaria    = new Secretaria($pdo);
$avaliacao     = new Avaliacao($pdo);
$id_avaliado = $_GET['id_avaliado'];
$avaliacao = $avaliacao->todosAvaliacao();

?>
<div class="container">
<h4 align="center" style="padding-top: 50px;padding-bottom: 30px;">TERMO CIRCUNSTANCIADO</h4>
<p align="justify">&ensp;&ensp;&ensp;&ensp;&ensp;Considerando o que dispõe o artigo 41 § 4º	 da Constituição Federal, com as alterações introduzidas pela Emenda Constitucional nº 19/98 que determina a realização de Avaliação de Desempenho durante o período do Estágio  Probatório para cada um dos servidores que ingressaram no serviço público por meio de Concurso Público;</p>
<p align="justify">&ensp;&ensp;&ensp;&ensp;&ensp;Respeitando os termos do Decreto Municipal nº 6811, de  21 de junho de 2012, que regulamenta a Lei Complementar Municipal nº 88 de 16 de junho de 2011;</p>
<p align="justify">&ensp;&ensp;&ensp;&ensp;&ensp;Observando que a normatização municipal e respectiva regulamentação ocorreram em data posterior aos interstícios necessários para implementação da Avaliação de Desempenho;</p>
<p align="justify">&ensp;&ensp;&ensp;&ensp;&ensp;Analisando que não tendo sido realizadas as avaliações ______________ do Estágio Probatório , a Administração Municipal deve legitimar a referida estabilidade , por meio da concessão de pontuação mínima que permita legal, correspondente a 60% ( sessenta por cento) dos pontos relativos a cada um dos itens constantes no Formulário de Avaliação Especial de Desempenho para fins de Estágio Probatório, previstona mencionada Lei Municipal.</p>

	<p><label><b>Servidor:</b></label>
		<?php foreach ($aval as $avalnome) {
		echo $nome = $avalnome['nome'];	
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
        echo utf8_encode($secre['nome']);
		} ?>
	</p>
    
	<?php
	
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
    <?php
    $count =0;
    $soma = 0;
    foreach ($avaliacao as $avaliacao):
    $count = $count+1;
	$id_avaliacao = $avaliacao['id'];
	$ass = $assiduidade->calculoAssiduidade($id_avaliado, $id_avaliacao);
	$dis = $disciplina->calculoDisciplina($id_avaliado, $id_avaliacao);
    $ini = $iniciativa->calculoIniciativa($id_avaliado, $id_avaliacao);
    $pro = $produtividade->calculoProdutividade($id_avaliado, $id_avaliacao);
    $resp = $responsabilidade->calculoResponsabilidade($id_avaliado, $id_avaliacao);
    $_SESSION['valor'][$id_avaliacao] = $ass['totalassiduidade']+ $dis['totaldisciplina'] + $ini['totaliniciativa'] + $pro['totalprodutividade'] + $resp['totalresponsabilidade'];
    $_SESSION['data'][$id_avaliacao] = $ass['insercao'];
    $soma = $_SESSION['valor'][$id_avaliacao] + $soma;
    ?>
    
    <tr>
    	<td><?php
    	$data = date('d/m/Y', strtotime($_SESSION['data'][$id_avaliacao]));
    	if ($data == '31/12/1969') {
    		echo "";
    	}else{
    		echo $data;
    	}
    	?>	
    	</td>
    	<?php if ($_SESSION['valor'][$id_avaliacao] > 5): ?>
		<td><label>Realizado</label></td>
	    <?php else: ?>
		<td><label>Não Realizado</label></td>
		<?php endif ?>
    	<td>
    	<?php 
    	if ($_SESSION['valor'][$id_avaliacao] > 0) {
    		echo $_SESSION['valor'][$id_avaliacao];
    	}else{
    		echo "";
    	}
    	?>
    			
    	</td>
    	<?php if ($_SESSION['valor'][$id_avaliacao] > 0):?>
		<?php if ($_SESSION['valor'][$id_avaliacao] >= 60): ?>  
		<td>Aprovado</td>
		<?php else: ?>
	    <td>Reprovado</td>
		<?php endif ?>
		<?php else: ?>
		<td></td>
		<?php endif ?>    
	</tr>
    <?php 
    endforeach;
    $calculo = round(($soma * 100) / ($calc = $count * 100), 2);
    ?>
      <tr class="hidden-print">
      	<td></td>
      	<td><b>Média Pontuação - Total:</b></td>
      	<td><b><?=$calculo?>%</b></td>
      	<td>
      		<?php if ($calculo >= 60) {
      			echo "Aprovado";
      		}else{
      			echo "<b>Reprovado</b>";
      		} ?>
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
        <div class="row">
          <div class="col-md"><a href="relatorios.php?id_avaliado=<?=$_GET['id_avaliado']?>&nome=<?=$nome?>" class="btn btn-danger fas fa-file-pdf">Relatórios</a></div>
          <div class="col-md" align="right"><a href="#" onclick="window.print()" class="btn btn-warning fas fa-print">Imprimir</a></div>
        </div>
</div>

<?php
require "inc/rodape.php";  
?>
