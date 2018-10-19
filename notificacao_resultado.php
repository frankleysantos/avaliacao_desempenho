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
$id_avaliado   = $_GET['id_avaliado'];
$avaliado      = new Avaliado($pdo);
$aval          = $avaliado->listaAvaliado($id);
$avaliacao     = new Avaliacao($pdo);
$avaliacao     = $avaliacao->listaAvaliacao();
$assiduidade   = new Assiduidade($pdo);
$avaliado = new Avaliado($pdo);
$assiduidade = new Assiduidade($pdo);         
$disciplina = new Disciplina($pdo);          
$iniciativa = new Iniciativa($pdo);          
$produtividade = new Produtividade($pdo);          
$responsabilidade = new Responsabilidade($pdo);
           
//$assiduidade   = $assiduidade->avaliacaoAssiduidade($id_avaliacao, $id_avaliado); 
?>
<div class="hidden-print" style="padding-top: 50px; padding-bottom: 50px">
<h4 align="center" style="padding-bottom: 50px">NOTIFICAÇÃO AO SERVIDOR DO RESULTADO DA AVALIAÇÃO DE DESEMPENHO</h4>
<form action="" method="POST" role="form">
	<label><b>Busque pela Avaliação:</b></label>
	<div class="row">
		<div class="col-md-4">
	      <select name="avaliacao" id="input" class="form-control" required="required">
		   <option value="">Escolha a avaliação...</option>
		    <?php foreach ($avaliacao as $avaliacao): ?>
		   <option value="<?=$avaliacao['id'];?>"><?=$avaliacao['nome'];?></option>	
		    <?php endforeach ?>
	      </select>
    </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
	</div>
</form>
</div>

<?php  if (isset($_POST['avaliacao']) && !empty($_POST['avaliacao'])):?>
<?php

$id_avaliacao = $_POST['avaliacao'];
$ass = $assiduidade->calculoAssiduidade($id_avaliado, $id_avaliacao);
$dis = $disciplina->calculoDisciplina($id_avaliado, $id_avaliacao);
$ini = $iniciativa->calculoIniciativa($id_avaliado, $id_avaliacao);
$pro = $produtividade->calculoProdutividade($id_avaliado, $id_avaliacao);
$resp = $responsabilidade->calculoResponsabilidade($id_avaliado, $id_avaliacao);
$assiduidade   = $assiduidade->avaliacaoAssiduidade($id_avaliacao, $id_avaliado);

$total = $ass['totalassiduidade'] + $dis['totaldisciplina'] + $ini['totaliniciativa'] + $pro['totalprodutividade'] + $resp['totalresponsabilidade'];
    foreach ($assiduidade as $ass) {
	  $data= date('d/m/Y', strtotime($ass['insercao']));
	  $_SESSION['notificacao']['data_avaliacao']=$data;
    }
 ?>
    <hr>
 <div class="container">
 	 <div class="row">
      <h4 align="center"><img src="resources/images/brasao.png" width="50px">NOTIFICAÇÃO AO SERVIDOR DO RESULTADO DA AVALIAÇÃO DE DESEMPENHO DO ESTÁGIO PROBATÓRIO</h4>
       <?php foreach ($aval as $info):?>
       <label><b>SERVIDOR:</b>&ensp;<?=$_SESSION['notificacao']['nome']=$info['nome'];?></label>
       <?php endforeach ?>
      </div>

      <div class="row" style="padding-top: 50px">
       <p align="justify">&ensp;&ensp;&ensp;&ensp;CIENTIFICAMOS que, conforme Avaliação de Desempenho realizada no dia <b><?=$_SESSION['notificacao']['data_avaliacao'];?></b>, V.Sª. atingiu a pontuação necessária à aprovação durante o Estágio Probatório, referente a este período  avaliatório, obtenção <b><?=$_SESSION['notificacao']['total']=$total?></b> pontos no processo realizado.
       </p>
      </div>
      
      <div class="row">
      <p align="justify">&ensp;&ensp;&ensp;&ensp;O Processo Administrativo instruído com todos os documentos necessários à ratificação deste resultado será arquivado na sua pasta funcional e estará à disposição para retirada de cópia caso do interesse de V.Sª.</p>
      </div>
                                                    
      <p align="center" style="padding-top: 50px; padding-bottom: 50px">Atenciosamente</p>
      <p align="center">Secretaria Municipal de Administração</p>
      <p style="padding-top: 50px; padding-bottom: 50px">Ciente em ____/____/_____</p>
      <p align="center">_____________________________________________________________</p>
      <p align="center">Assinatura do Servidor: <b><?=$_SESSION['notificacao']['nome'];?></b></p>
      <p align="center">Teófilo Otoni <?php echo strftime('%d de %B de %Y', strtotime('today'));?>

       <div class="hidden-print">
        <p>
         <a href="#" onclick="window.print()" class="btn btn-warning">Imprimir</a>
         <a href="notificacao_resultado_pdf.php" class="btn btn-danger" target="_blank">Gerar PDF</a>
        </p>
       </div>
 </div>
<?php endif ?>

</div>
<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="functions.js"></script>
		<script src="resources/js/bootstrap.min.js"></script>
		<script src="resources/js/bootstrap.bundle.js"></script>
	</body>
</html>