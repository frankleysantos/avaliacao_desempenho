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

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

$avaliado = new Avaliado($pdo);
$observacao     = new Observacao($pdo);
$gestor = new Gestor($pdo);

$id           = $_GET['id_avaliado'];
$id_avaliado  = $_GET['id_avaliado']; 
$id_avaliacao = $_GET['id_avaliacao'];  
$aval = $avaliado->listaAvaliado($id);

$observacao = $observacao->listaObservacao($id_avaliado, $id_avaliacao);

// faz a verificação se o usuário está logado
if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) {
	//verifica se o perfil é coordenador
	if ($sql['perfil'] == 'coordenador') {        
           foreach ($aval as $dado):
?>
            <div class="row">
            	<legend align="center" style="padding-top:50px; padding-bottom: 20px"><img src="resources/images/brasao.png" width="50px">PARECER FINAL E ENCAMINHAMENTO AO PREFEITO MUNICIPAL</legend>
            			<div class="col-md" style="padding-bottom: 30px;"><b>AVALIADO:</b> <?php echo $_SESSION['resumo']['nome'] = $dado['nome']; ?>               
                              </div>

                              <div class="w-100"></div>
                              
                              <div class="col-md" style="padding-bottom: 100px;">
                                    <p align="justify">&ensp;&ensp;&ensp;&ensp;&ensp;De acordo com as normas estabelecidas na Lei Complementar Municipal nº88/2011 e em Atendimento ao disposto no paragrafo 4º do art.41 da Constituição Federal, estamos encaminhando o Processo Administrativo de Avaliação Especial de Desempenho em Estágio Probatório, devidamente instruído e aprovado pela Comissão de Avaliação, informando que o servidor acima mencionado, está devidamente aprovado, neste período avaliatório, incubido a V.Exª. ratificar o resultado para todos os fins de direito.</p>
                              </div>

                              <div class="w-100"></div>
                    <?php if (count($observacao) > 0): ?>
            		    <?php foreach ($observacao as $obs): 
            		     $id = $obs['presidente'];
            		     $presidente = $gestor->listaStatus($id);
            		     endforeach; ?>
                     <div class="w-100"></div>
            		     <div class="col-md" align="center" style="padding-bottom: 100px;">Presidente <br><?=$_SESSION['resumo']['presidente'] = $presidente['nome']?></div>
                             <div class="w-100"></div>
                      <?php  else: ?>
                      <div class="w-100"></div>
                      <div class="col-md" align="center" style="padding-bottom: 100px;">Presidente<br><?=$_SESSION['resumo']['presidente'] = ''?></div>
                    <?php endif ?>

                    <?php if (count($observacao) > 0): ?> 
            		    <?php foreach ($observacao as $obs_membro_um): 
            		     $id = $obs_membro_um['membro_um'];
            		     $membro_um = $gestor->listaStatus($id);
            		     endforeach; ?>	
            		     <div class="col-md" align="center">Membro<br><?=$_SESSION['resumo']['membro_um'] = $membro_um['nome']?></div>
                     <?php  else: ?>
                      <div class="col-md" align="center">Membro<br><?=$_SESSION['resumo']['membro_um'] = ''?></div>
                    <?php endif ?>

                    <?php if (count($observacao) > 0): ?>
            		    <?php foreach ($observacao as $obs_membro_dois): 
            		     $id = $obs_membro_dois['membro_dois'];
            		     $membro_dois = $gestor->listaStatus($id);
            		     endforeach; ?>
            		     <div class="col-md" align="center" style="padding-bottom: 100px;">Membro <br><?=$_SESSION['resumo']['membro_dois'] = $membro_dois['nome']?></div>
                     <?php  else: ?>
                      <div class="col-md" align="center" style="padding-bottom: 100px;">Membro <br><?=$_SESSION['resumo']['membro_dois'] = ''?></div>
                    <?php endif ?>

                    <div class="w-100"></div>

                    <div class="col-md" align="center" style="padding-bottom: 100px;"><b>Secretário Municipal de Administração</b></div>
            </div>
            <p style="padding-bottom: 50px">Ciente em ____/____/_____</p>
            <p align="center" style="padding-bottom: 30px">Assinatura do Servidor <br> <b><?=$_SESSION['notificacao']['nome'];?></b></p>
      <p align="center">Teófilo Otoni <?php echo strftime('%d de %B de %Y', strtotime('today'));?>
            <div class="hidden-print">
            	<div class="row">
                   <div class="col-md"> <a href="#" onclick="window.print()" class="btn btn-warning">Imprimir</a></div>
                   <!--<div class="col-md"><a href="resumo_avaliacao_pdf.php" class="btn btn-danger" target="_blank">Gerar PDF</a></div>-->
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