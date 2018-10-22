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

$avaliado = new Avaliado($pdo);
 setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
 date_default_timezone_set('America/Sao_Paulo');

if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) {
	//verifica se o perfil é coordenador
	if ($sql['perfil'] == 'coordenador') {
	$id = $_GET['id_avaliado'];
    $avaliado = $avaliado->listaAvaliado($id);
	foreach ($avaliado as $aval) {
	    	$nome =  $aval['nome'];
	    }    
 ?>

<div class="container" style="padding-top: 50px; padding-bottom: 50px">
<h4 style="padding-bottom: 50px">RATIFICAÇÃO DO ATO DE APROVAÇÃO  FINAL  NO ESTÁGIO  PROBATÓRIO DE SERVIDOR APROVADO EM TODOS OS PERÍODOS AVALIATÓRIOS</h4>
<div class="row">
	<div class="col-md"><p>&ensp;&ensp;&ensp;&ensp;&ensp;Recebo,nesta data, os autos do Processo Administração  nº_____________________realizado em ______/______/_______, que definiu pela aprovação do servidor <b><?=$nome;?></b>, no Estágio Probatório em todos os períodos avaliatórios a que foi submetido.</p></div>
</div>
<div class="row">
	<div class="col-md"><p>&ensp;&ensp;&ensp;&ensp;&ensp;Determino a expedição de Portaria de Ratificação da Estabilidade do referido servidor e sua averbação na pasta funcional, para todos os fins de direito.	</p></div>
</div>
<div class="row">
	<div class="col-md"><p>&ensp;&ensp;&ensp;&ensp;&ensp;Na oportunidade, saliento que os trabalhos da Comissão Especial de Avaliação de Desempenho foram executados com lisura e transparência, demonstrando a capacidade de isençãode cada um de seus membros na condução dos realizados.</p></div>
</div>
<div class="row">
	<div class="col-md"><p>&ensp;&ensp;&ensp;&ensp;&ensp;Autue-se e arquive-se esta ratificação nos termos da legislação vigente.</p></div>
</div>
<p align="center" style="padding-top: 80px;">Prefeitura Municipal de Teófilo Otoni <?php echo strftime('%d de %B de %Y', strtotime('today'));?>
<p align="center" style="padding-top: 80px">__________________________________________________________<br>Prefeito Municipal</p>
  <div class="hidden-print">
    <p>
    <a href="#" onclick="window.print()" class="btn btn-warning">Imprimir</a>
    </p>
  </div>
</div>

<?php
    }
}
require "inc/rodape.php";
?>