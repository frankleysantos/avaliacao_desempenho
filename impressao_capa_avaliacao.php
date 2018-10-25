  <!--link rel="icon" href="resources/img/debian.svg" /-->
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
require "classes/gestor.class.php";

$avaliacao  = new Avaliacao($pdo);
$observacao = new observacao($pdo);
$gestor     = new Gestor($pdo);
// faz a verificação se o usuário está logado
if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) {
	//verifica se o perfil é coordenador
	if ($sql['perfil'] == 'coordenador') { 
    $avaliacao  = $avaliacao->listaAvaliacao();
?>
<div class="hidden-print">
<h3 align="center">Avaliação de Desempenho</h3>
<form action="" method="POST" role="form">
	<div class="form-group">
		<h3 align="center">Capa Avaliação de Desempenho</h3>
		<select name="id_avaliacao" id="inputNome" class="form-control" required="required">
			  <option value="">Escolha a Avaliação...</option>
			<?php foreach ($avaliacao as $info): ?>
			  <option value="<?=$info['id']?>"><?=$info['nome'];?>-<?=$info['data_avaliacao']?></option>	
			<?php endforeach ?>
		</select>
	</div>
	<button type="submit" class="btn btn-primary fas fa-search">Buscar</button>
</form>
</div>
    <?php  if (!isset($_POST['id_avaliacao']) && empty($_POST['id_avaliacao'])):
     $id = $_GET['id_avaliado']; 
     $avaliado = new Avaliado($pdo);
     $avaliado = $avaliado->listaAvaliado($id);
    ?>
     <div class="jumbotron">
     <?php foreach ($avaliado as $funcionario): ?>
      <h1 class="display-4"><?=$funcionario['nome'];?></h1>
      <?php endforeach ?>
      <p class="lead">Escolha a avaliação desejada para este funcionário!</p>
     </div>
    <?php endif?>

<?php     
         //verifica se o id_avaliacao foi enviado, pelo formulario de pesquisa.
         if (isset($_POST['id_avaliacao']) && !empty($_POST['id_avaliacao'])) {
           $id_avaliacao = $_POST['id_avaliacao'];
           $secretaria = new Secretaria($pdo);
           $cargo = new Cargo($pdo);
           $id_avaliado = $_GET['id_avaliado'];
           $avaliado = new Avaliado($pdo);
           $assiduidade = new Assiduidade($pdo);
           $ass = $assiduidade->calculoAssiduidade($id_avaliado, $id_avaliacao);
           $disciplina = new Disciplina($pdo);
           $dis = $disciplina->calculoDisciplina($id_avaliado, $id_avaliacao);
           $iniciativa = new Iniciativa($pdo);
           $ini = $iniciativa->calculoIniciativa($id_avaliado, $id_avaliacao);
           $produtividade = new Produtividade($pdo);
           $pro = $produtividade->calculoProdutividade($id_avaliado, $id_avaliacao);
           $responsabilidade = new Responsabilidade($pdo);
           $resp = $responsabilidade->calculoResponsabilidade($id_avaliado, $id_avaliacao);
           $aval = $avaliado->listaAvaliado($id_avaliado);
           $observacao = $observacao->listaObservacao($id_avaliado, $id_avaliacao);
           foreach ($aval as $dado):
?>
            <div class="hidden-print">
            <p align="center"></p>
            <h4 align="center"><?=$id_avaliacao?>º Avaliação</h4>
            </div>
            <div class="row" align="center">
            <img src="resources/images/brasao.png" class="img-thumbnail">
            <h4 align="center"><p>PREFEITURA MUNICIPAL DE TEÓFILO OTONI</p>
                <p>SECRETARIA MUNICIPAL DE ADMINISTRAÇÃO</p>
                <p>COMISSÃO DE AVALIAÇÃO DE DSEMPENHO DO ESTÁGIO PROBATÓRIO</p>
            </h4>
            </div>
            <h1 align="center"><p>AVALIAÇÃO</p>
                <p>DE</p>
                <p>DESEMPENHO</p>
            </h1>
            <h1 align="center"><p>ESTÁGIO</p>
                <p>PROBATÓRIO</p>
            </h1>
            <?php $processo = $assiduidade->avaliacaoAssiduidade($id_avaliacao, $id_avaliado) ?>
            <?php foreach ($processo as $proc): ?>
            <p>Processo nº: <?=$_SESSION['avaliado']['processo']=$proc['id']?></p>
            <?php endforeach ?>
            <p>Avaliado: <?php echo $_SESSION['avaliado']['nome']  = $dado['nome']; ?></p>
            <p>Matricula: <?php echo $_SESSION['avaliado']['matricula'] = $dado['matricula']; ?></p>
            <?php $id_cargo = $dado['cargo']; ?>
            <?php $cargo = $cargo->listaCargoID($id_cargo); ?>
            <p>Cargo: <?php  echo $_SESSION['avaliado']['cargo'] = $cargo['nome'];?></p>
            <p>Comissão Avaliação:</p>
            <div class="container row">
            <div class="col-md">
               <?php if (count($observacao) > 0): ?>
               <?php foreach ($observacao as $obs): 
               $id = $obs['presidente'];
               $presidente = $gestor->listaStatus($id);
               echo $presidente['nome'];
               endforeach; ?>
               <?php endif ?>
            </div>
            <div class="w-100"></div>
            <div class="col-md">
               <?php if (count($observacao) > 0): ?>
               <?php foreach ($observacao as $obs): 
               $id = $obs['membro_um'];
               $membro_um = $gestor->listaStatus($id);
               echo $membro_um['nome'];
               endforeach; ?>
               <?php endif ?>
            </div>
            <div class="w-100"></div>
            <div class="col-md">
               <?php if (count($observacao) > 0): ?>
               <?php foreach ($observacao as $obs): 
               $id = $obs['membro_dois'];
               $membro_dois = $gestor->listaStatus($id);
               echo $membro_dois['nome'];
               endforeach; ?>
               <?php endif ?>
            </div>
            </div>
            <legend align="center">AVALIAÇÃO DE DESEMPENHO EM ESTÁGIO PROBATÓRIO</legend>
            <table class="table table-striped table-hover">
            	<thead>
            		<tr>
            			<th>Nome do Avaliado:</th>
            			<td colspan="2"><?php echo $dado['nome']; ?></td>
            		</tr>
            	</thead>
            	<tbody>
            		<tr>
            			<th>Data da nomeação:</th>
            			<td><?php echo $_SESSION['avaliado']['data_nomeacao'] = $dado['data_nomeacao']; ?></td>
            			<?php $id_cargo = $dado['cargo']; ?>
            			<td><b>Cargo:</b>&ensp;<?php  echo $cargo['nome'];?></td>
            		</tr>
            		<tr>
            			<th>Unidade Administrativa:</th>
            			<?php $id_secretaria = $dado['secretaria']; ?>
            			<?php $secre = $secretaria->listaSecretariaID($id_secretaria); ?>
            			<td colspan="2"><?php echo $_SESSION['avaliado']['secretaria'] = utf8_encode($secre['nome']); ?></td>
            		</tr>
            		<tr>
            			<th>Matrícula:</th>
            			<td colspan="2"><?php echo $dado['matricula']; ?></td>
            		</tr>
            	</tbody>
            </table>
           <?php endforeach ?>
          <table class="table table-hover">
	        <legend align="center">RESULTADO GERAL DA AVALIAÇÃO</legend>
	        <p>A saber, os pontos atribuídos aos quesitos abaixo foram os constantes do presente processo de avaliação:</p>
	        <tbody>
		      <tr>
			   <td><b>Assiduidade:</b></td>
			   <td><?php echo $tassiduidade = $ass['totalassiduidade'];?> <b>Pontos</b></td>
         <?php $_SESSION['avaliado']['tassiduidade'] = $tassiduidade; ?>
		      </tr>
		      <tr>
			   <td><b>Disciplina:</b></td>
			   <td><?php echo $tdisciplina = $dis['totaldisciplina']; ?> <b>Pontos</b></td>
         <?php $_SESSION['avaliado']['tdisciplina'] = $tdisciplina; ?>
		      </tr>
		      <tr>
			   <td><b>Capac. Iniciativa:</b></td>
			   <td><?php echo $tiniciativa = $ini['totaliniciativa']; ?> <b>Pontos</b></td>
         <?php $_SESSION['avaliado']['tiniciativa'] = $tiniciativa; ?>
		      </tr>
		      <tr>
			   <td><b>Produtividade:</b></td>
			   <td><?php echo $tprodutividade = $pro['totalprodutividade']; ?> <b>Pontos</b></td>
         <?php $_SESSION['avaliado']['tprodutividade'] = $tprodutividade; ?>
		      </tr>
		      <tr>
			   <td><b>Responsabilidade:</b></td>
			   <td><?php echo $tresponsabilidade = $resp['totalresponsabilidade']; ?> <b>Pontos</b></td>
         <?php $_SESSION['avaliado']['tresponsabilidade'] = $tresponsabilidade; ?>
		      </tr>
		      <tr>
			   <td><b>Total:</b></td>
			   <td><b><label><?php echo $total = $tassiduidade+$tdisciplina+$tiniciativa+$tprodutividade+$tresponsabilidade; ?></label> Pontos</b></td>
         <?php $_SESSION['avaliado']['total'] = $total; ?>
		      </tr>
	        </tbody>
          </table>
          <p>Visto que o colaborador obteve na Avaliação Especial de Desempenho o total de <b><?=$total?></b> pontos, nos termos do Artigo 4º do Decreto nº 6.811/2012 que regulamenta a Lei Complementar nº 88/2011, foi considerado:</p>

		     <?php if ($total >= 55):?>
               <p><b>(X)Aprovado</b>  (&ensp;)Reprovado</p>
               <?php $_SESSION['avaliado']['desempenho'] = 'Aprovado'; ?>
		     <?php endif ?>

		     <?php if ($total < 55):?>
               <p>(&ensp;)Aprovado  <b>(X)Reprovado</b></p>
               <?php $_SESSION['avaliado']['desempenho'] = 'Reprovado'; ?>
		     <?php endif ?>
		       <?php setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
           date_default_timezone_set('America/Sao_Paulo');
           ?>
           <p align="center">Teófilo Otoni <?php echo strftime('%d de %B de %Y', strtotime('today'));?></p>
           <?php if (count($observacao) > 0): ?>
           <?php foreach ($observacao as $obs): 
           $id = $obs['presidente'];
           $presidente = $gestor->listaStatus($id);
           endforeach; ?> 
           <p align="center" style="padding-top: 80px;"><?=$_SESSION['avaliado']['presidente'] = $presidente['nome']?><br>Presidente da Comissão de Avaliação</p>
           <?php  else: ?>
            <p align="center" style="padding-top: 80px;"><?=$_SESSION['avaliado']['presidente'] = ''?><br>Presidente da Comissão de Avaliação</p>
            <?php endif ?>

           <div class="row" style="padding-top: 80px;">
            <div class="col-md">
            <?php if (count($observacao) > 0): ?>
             <?php foreach ($observacao as $obs): 
             $id = $obs['membro_um'];
             $membro_um = $gestor->listaStatus($id);
             endforeach; ?> 
             <p align="center"><?=$_SESSION['avaliado']['membro_um'] = $membro_um['nome']?><br>Membro da Comissão</p>
             <?php  else: ?>
              <p align="center"><?=$_SESSION['avaliado']['membro_um'] = ''?><br>Membro da Comissão</p>
            <?php endif ?>
            </div>

            <div class="col-md">
            <?php if (count($observacao) > 0): ?>
             <?php foreach ($observacao as $obs): 
             $id = $obs['membro_dois'];
             $membro_dois = $gestor->listaStatus($id);
             endforeach; ?> 
             <p align="center"><?=$_SESSION['avaliado']['membro_dois'] = $membro_dois['nome']?><br>Membro da Comissão</p>
             <?php  else: ?>
             <p align="center"><?=$_SESSION['avaliado']['membro_dois'] = ''?><br>Membro da Comissão</p>
            <?php endif ?>
            </div>
           </div>

           <div class="hidden-print container">
            <p>
             <!--<a href="#" onclick="window.print()" class="btn btn-warning">Imprimir</a>-->
             <a href="capa_avaliacao.php"  class="btn btn-danger fas fa-print" target="_blank">Gerar PDF e Imprimir</a>
            </p>
           </div>
<?php
        } //aqui fecha o formulário de busca. 
      } // aqui termina o codigo de perfil coordenador, se o perfil for diferente direciona para o index.php
      else{
 	   header("Location: index.php");
      }
} // se o usuário não estiver logado redireciona para o index.php
else{
	header("Location: index.php");
}
?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<?php
require "inc/rodape.php";  
?>