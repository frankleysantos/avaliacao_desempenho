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
$secretaria = new Secretaria($pdo);
$cargo = new Cargo($pdo);
$avaliado = new Avaliado($pdo);
$assiduidade = new Assiduidade($pdo);
$disciplina = new Disciplina($pdo);
$iniciativa = new Iniciativa($pdo);
$produtividade = new Produtividade($pdo);
$responsabilidade = new Responsabilidade($pdo);
$observacao     = new Observacao($pdo);
$gestor = new Gestor($pdo);

$id           = $_GET['id_avaliado'];
$id_avaliado  = $_GET['id_avaliado']; 
$id_avaliacao = $_GET['id_avaliacao'];  
$aval = $avaliado->listaAvaliado($id);
$avaliacao  = $avaliacao->listaAvaliacao();
$ass = $assiduidade->calculoAssiduidade($id_avaliado, $id_avaliacao);
$dis = $disciplina->calculoDisciplina($id_avaliado, $id_avaliacao);
$ini = $iniciativa->calculoIniciativa($id_avaliado, $id_avaliacao);
$pro = $produtividade->calculoProdutividade($id_avaliado, $id_avaliacao);
$resp = $responsabilidade->calculoResponsabilidade($id_avaliado, $id_avaliacao);
$assiduidade   = $assiduidade->avaliacaoAssiduidade($id_avaliacao, $id_avaliado);
$total = $ass['totalassiduidade'] + $dis['totaldisciplina'] + $ini['totaliniciativa'] + $pro['totalprodutividade'] + $resp['totalresponsabilidade'];

$observacao = $observacao->listaObservacao($id_avaliado, $id_avaliacao);

// faz a verificação se o usuário está logado
if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) {
	//verifica se o perfil é coordenador
	if ($sql['perfil'] == 'coordenador') {        
           foreach ($aval as $dado):
?>
            <table class="table table-striped table-hover">
            	<legend align="center" style="padding-top:50px; padding-bottom: 20px">RESUMO DO CONJUNTO DAS AVALIAÇÕES DO ESTÁGIO PROBATÓRIO</legend>
            	<tbody>
            		<tr>
            			<?php $id_cargo = $dado['cargo']; ?>
            			<?php $cargo = $cargo->listaCargoID($id_cargo); ?>
            			<th>Cargo:</th>
            			<td><?php  echo $_SESSION['resumo']['cargo'] = $cargo['nome'];?></td>
            		</tr>
            		<tr>
            			<th>Nº de Matrícula:</th>
            			<td colspan="2"><?php echo $_SESSION['resumo']['matricula'] = $dado['matricula']; ?></td>
            		</tr>
            		<tr>
            			<th>Nome do Servidor:</th>
            			<td colspan="2"><?php echo $_SESSION['resumo']['nome'] = $dado['nome']; ?></td>
            		</tr>
            		<tr>
            			<th>Secretaria / Setor:</th>
            			<?php $id_secretaria = $dado['secretaria']; ?>
            			<?php $secre = $secretaria->listaSecretariaID($id_secretaria); ?>
            			<td colspan="2"><?php echo $_SESSION['resumo']['secretaria'] = utf8_encode($secre['nome']); ?></td>
            		</tr>
            		<tr>
            			<th>O Servidor foi:</th>
            			<?php if ($total >= 60):?>
            			<td><?php echo $_SESSION['resumo']['total'] = "<b>Aprovado(X)</b> Reprovado(&ensp;)";?></td>
            			<?php else: ?>
            		    <td><?php echo $_SESSION['resumo']['total'] = "Aprovado(&ensp;) <b>Reprovado(X)";?></b></td>
            		    <?php endif ?>
            		</tr>
            		<?php foreach ($observacao as $obs): ?>
            		<tr>
            			<td colspan="2">
            			<div class="form-group">
            				<label for="textarea"><b>Observações da Comissão de Avaliação:</b></label>
            				<div class="col-md">
            					<textarea name="" id="textarea" class="form-control" rows="5" disabled><?=$_SESSION['resumo']['obs_comissao'] = $obs['obs_comissao'];?></textarea>
            				</div>
            			</div>
            			</td>	
            		</tr>
            		<?php endforeach ?>
            		<tr>
            			<th colspan="2">Homologado em:____/____/____</th>
            		</tr>
            		<tr>
            			<th colspan="2">Visto do servidor em:____/____/____</th>
            		</tr>
            		<tr>
            			<th>Servidor: Concorda com resultado:</th>
            			<td>(&ensp;)Sim (&ensp;)Não</td>
            		</tr>
            		<tr>
            			<td colspan="2">Segue em anexo, o pedido de reconsideração contendo ____fls.</td>
            		</tr>
            		<tr>
            			<th>Por: Presidente de Comissão 1:</th>
                             <?php if (count($observacao) > 0): ?> 
            		      <?php foreach ($observacao as $obs): 
            		      $id = $obs['presidente'];
            		      $presidente = $gestor->listaStatus($id);
            		      endforeach; ?>	
            		      <td><?=$_SESSION['resumo']['presidente'] = $presidente['nome']?></td>
                             <?php  else: ?>
                              <td><?=$_SESSION['resumo']['presidente'] = ''?></td>
                             <?php endif ?>
            		</tr>
            		<tr>
                             
            			<th>Membro de Comissão 1:</th>
                             <?php if (count($observacao) > 0): ?>
            		      <?php foreach ($observacao as $obs_membro_um): 
            		      $id = $obs_membro_um['membro_um'];
            		      $membro_um = $gestor->listaStatus($id);
            		      endforeach; ?>	
            		      <td><?=$_SESSION['resumo']['membro_um'] = $membro_um['nome']?></td>
                             <?php  else: ?>
                              <td><?=$_SESSION['resumo']['membro_um'] = ''?></td>
                             <?php endif ?>
            		</tr>
            		<tr>
            			<th>Membro de Comissão 2:</th>
                             <?php if (count($observacao) > 0): ?>
            		      <?php foreach ($observacao as $obs_membro_dois): 
            		      $id = $obs_membro_dois['membro_dois'];
            		      $membro_dois = $gestor->listaStatus($id);
            		      endforeach; ?>	
            		      <td><?=$_SESSION['resumo']['membro_dois'] = $membro_dois['nome']?></td>
                             <?php  else: ?>
                              <td><?=$_SESSION['resumo']['membro_dois'] = ''?></td>
                             <?php endif ?>
            		</tr>
            	</tbody>
            </table>
            <div class="hidden-print">
            	<div class="row">
                   <div class="col-md"> <a href="#" onclick="window.print()" class="btn btn-warning">Imprimir</a></div>
                   <!--<div class="col-md"><a href="resumo_avaliacao_pdf.php" class="btn btn-danger" target="_blank">Gerar PDF</a></div>-->
                   <div class="col-md" align="right"><a href="calculo_avaliacao.php?id_avaliado=<?=$id_avaliado?>" class="btn btn-success">Voltar</a></div>
                </div>
            </div>

           <?php endforeach ?>
<?php
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