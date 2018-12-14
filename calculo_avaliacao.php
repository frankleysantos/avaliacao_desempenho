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

$avaliacao  = new Avaliacao($pdo);
$observacao = new observacao($pdo);
// faz a verificação se o usuário está logado
if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) {
	//verifica se o perfil é coordenador
	if ($sql['perfil'] == 'coordenador') { 
    $avaliacao  = $avaliacao->listaAvaliacao();
?>

<form action="" method="POST" role="form" class="hidden-print">
	<legend align="center">Avaliação de Desempenho</legend>

	<div class="form-group">
		<label class="fas fa-book-open">Avaliações Cadastradas</label>
		<select name="id_avaliacao" id="inputNome" class="form-control" required="required">
			  <option value="">Escolha...</option>
			<?php foreach ($avaliacao as $info): ?>
			  <option value="<?=$info['id']?>"><?=$info['nome'];?>-<?=$info['data_avaliacao']?></option>	
			<?php endforeach ?>
		</select>
	</div>
	<button type="submit" class="btn btn-primary fas fa-search">Buscar</button>
</form>
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
<div class="hidden-print" style="padding-top: 20px;">
   <div class="row">
   	<div class="col-md">
    <p><a href="#" onclick="window.print()" class="btn btn-warning fas fa-print">Imprimir</a></p>
    <p><a href="lista_obs_avaliador?id_avaliado=<?=$id_avaliado?>&id_avaliacao=<?=$id_avaliacao?>" class="btn btn-info fas fa-users">Observações Avaliador</a></p>
    </div>
    <!--
    <div class="col-md" align="center">
       <a class="btn btn-info" href="parecer_final.php?id_avaliado=<?=$id_avaliado?>&id_avaliacao=<?=$id_avaliacao?>">Parecer final</a>
    </div>
    <div class="col-md" align="right">
    	<a class="btn btn-danger" href="resumo_avaliacao.php?id_avaliado=<?=$id_avaliado?>&id_avaliacao=<?=$id_avaliacao?>">Resumo das Avaliações</a>
    </div>
    -->
   </div>
</div>
            <h4 align="center" class="hidden-print"><?=$id_avaliacao?>ª Avaliação</h4>
            <h4 style="padding-top: 50px;" align="center">Anexo VII</h4>
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
            			<?php $id_cargo = $dado['cargo']; ?>
            			<?php $cargo = $cargo->listaCargoID($id_cargo); ?>
            			<td><b>Cargo:</b>&ensp;<?php  echo $cargo['nome'];?></td>
            		</tr>
            		<tr>
            			<th>Unidade Administrativa:</th>
            			<?php $id_secretaria = $dado['secretaria']; ?>
            			<?php $secre = $secretaria->listaSecretariaID($id_secretaria); ?>
            			<td colspan="2"><?php echo utf8_encode($secre['nome']); ?></td>
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
			   <td>De 25 a 59</td>
			   <td>De 60 a 84</td>
			   <td>De 85 a 100</td>
		     </tr>
		     <tr align="center">
		     <?php if ($total < 25):?>
               <td colspan="4"><h4>Resultado da Avaliação: <label class="btn btn-danger">Insatisfatório</label><p>Desempenho ruim, desta forma exonera.</p></h4></td>
		     <?php endif ?>

		     <?php if ($total >= 25 && $total < 60):?>
               <td colspan="4"><h4>Resultado da Avaliação: <label class="btn btn-warning">Regular</label><p>Desempenho satisfaz, em parte, e assim com dois conceito de REGULAR, exonera</p></h4></td>
		     <?php endif ?>

		     <?php if ($total >= 60 && $total < 85):?>
               <td colspan="4"><h4>Resultado da Avaliação: <label class="btn btn-success">Bom</label><p>Desempenho satisfaz, efetiva  (média de 60 % )</p></h4></td>
		     <?php endif ?>

		     <?php if ($total >= 85 && $total <= 100):?>
               <td colspan="4"><h4>Resultado da Avaliação: <label class="btn btn-primary">Excelente</label><p>Desempenho  ultrapassa , efetiva</p></h4></td>
		     <?php endif ?>
		     </tr>
		     <tr align="center">
			   <td colspan="4"><b>Observações</b></td>
		     </tr>

		     <?php foreach ($observacao as $obs): ?>
		     <tr>
		       <td colspan="4">
		       <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" readonly><?=$obs['obs_comissao'];?></textarea>
		       </td>
		     </tr>
		     <?php endforeach ?>

		     <?php if ($total > 1): ?>
		     <tr class="hidden-print">
		       <td colspan="4">
               <a class="btn btn-success fas fa-edit" href="cad_observacao.php?id=<?=$id_avaliado?>&id_avaliacao=<?=$id_avaliacao?>">Cadastrar Observações</a>
           </td>
		     </tr>
		     <?php endif ?>
	        </tbody>
          </table>
<div class="hidden-print" style="padding-top: 20px; padding-bottom: 50px;">
   <div class="row">
    <?php if ($total >= 60): ?>
      <?php $_SESSION['parecer']['resultado'] = "aprovado" ?>
    <div class="col-md">
       <a class="btn btn-info fas fa-file-signature" href="parecer_final.php?id_avaliado=<?=$id_avaliado?>&id_avaliacao=<?=$id_avaliacao?>">Parecer final</a>
    </div>
    <?php else: ?>
      <?php $_SESSION['parecer']['resultado'] = "reprovado" ?>
    <div class="col-md">
       <a class="btn btn-info fas fa-file-signature" href="parecer_final.php?id_avaliado=<?=$id_avaliado?>&id_avaliacao=<?=$id_avaliacao?>">Parecer final</a>
    </div>
    <?php endif ?>
    <div class="col-md" align="right">
      <a class="btn btn-danger fas fa-file-signature" href="resumo_avaliacao.php?id_avaliado=<?=$id_avaliado?>&id_avaliacao=<?=$id_avaliacao?>">Resumo das Avaliações</a>
    </div>
   </div>
</div>

<?php
          if ($total < 1):
	       echo "<div class='alert alert-danger alert-dismissible fade show' role='alert' align='center'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                  </button>
                  <strong>Ainda não foi avaliado!</strong>
                 </div>";
           endif;
        } //aqui fecha o formulário de busca. 
      } // aqui termina o codigo de perfil coordenador, se o perfil for diferente direciona para o index.php
      else{
 	   header("Location: index.php");
      }
} // se o usuário não estiver logado redireciona para o index.php
else{
	header("Location: index.php");
}
require "inc/rodape.php";  
?>