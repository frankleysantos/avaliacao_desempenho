<?php
session_start();
ob_start();
?>
<h4 align="center">PREFEITURA MUNICIPAL DE TEÓFILO OTONI</h4>
<p align="center">SECRETARIA MUNICIPAL DE ADMINISTRAÇÃO</p>
<p align="center">COMISSÃO DE AVALIAÇÃO DE DSEMPENHO DO ESTÁGIO PROBATÓRIO</p>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
<h1 align="center">AVALIAÇÃO</h1>
<h1 align="center">DE</h1>
<h1 align="center">DESEMPENHO</h1>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
<h1 align="center">ESTÁGIO</h1>
<h1 align="center">PROBATÓRIO</h1>
            <br>
            <br>
            <br>
            <br> 
            <br>
            <br>
            <br>
            <br>
            <p>Processo nº: <?=$_SESSION['avaliado']['processo']?></p>
            <p>Avaliado: <?=$_SESSION['avaliado']['nome']?></p>
            <p>Matricula: <?=$_SESSION['avaliado']['matricula']?></p>
            <p>Cargo: <?=$_SESSION['avaliado']['cargo']?></p>
            <p>Comissão Avaliação:</p>

<h4 align="center">AVALIAÇÃO DE DESEMPENHO EM ESTÁGIO PROBATÓRIO</h4>
<br>
<br>
<br>
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>Nome do Avaliado:</th>
                  <td colspan="2"><?=$_SESSION['avaliado']['nome']?></td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>Data da nomeação:</th>
                  <td><?=$_SESSION['avaliado']['data_nomeacao']; ?></td>
                </tr>
                <tr>
                  <th>Cargo:</th>
                  <td><?=$_SESSION['avaliado']['cargo'];?></td>
                </tr>
                <tr>
                  <th>Unidade Administrativa:</th>
                  <td colspan="2"><?=$_SESSION['avaliado']['secretaria'];?></td>
                </tr>
                <tr>
                  <th>Matrícula:</th>
                  <td colspan="2"><?=$_SESSION['avaliado']['matricula']; ?></td>
                </tr>
              </tbody>
            </table>
<br>
<br>
<h4 align="center">RESULTADO GERAL DA AVALIAÇÃO</h4>
<table class="table table-hover">
  <thead>
    <tr>
      <th>ASSIDUIDADE:</th>
      <td><?=$_SESSION['avaliado']['tassiduidade'];?>&ensp;</td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th>DISCIPLINA</th>
      <td><?=$_SESSION['avaliado']['tdisciplina'];?>&ensp;Pontos</td>
    </tr>
    <tr>
      <th>CAPAC. INICIATIVA</th>
      <td><?=$_SESSION['avaliado']['tiniciativa'];?>&ensp;Pontos</td>
    </tr>
    <tr>
      <th>PRODUTIVIDADE</th>
      <td><?=$_SESSION['avaliado']['tprodutividade'];?>&ensp;Pontos</td>
    </tr>
    <tr>
      <th>RESPONSABILIDADE</th>
      <td><?=$_SESSION['avaliado']['tresponsabilidade'];?>&ensp;Pontos</td>
    </tr>
    <tr>
      <th>TOTAL</th>
      <td><b><?=$_SESSION['avaliado']['total'];?></b>&ensp;Pontos</td>
    </tr>
  </tbody>
</table>
<br>
<br>
<p>A saber, os pontos atribuídos aos quesitos abaixo foram os constantes do presente processo de avaliação:</p>
          <p>Visto que o colaborador obteve na Avaliação Especial de Desempenho o total de <b><?=$_SESSION['avaliado']['total'];?></b> pontos, nos termos do Artigo 4º do Decreto nº 6.811/2012 que regulamenta a Lei Complementar nº 88/2011, foi considerado:</p>
<b><?php echo $_SESSION['avaliado']['desempenho']; ?></b>
           <br>
           <br>
           <br>
<?php setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
           date_default_timezone_set('America/Sao_Paulo');
           ?>
           <br>
           <br>
           <br>
           <br>
           <p align="center">Téofilo Otoni <?php echo strftime('%d de %B de %Y', strtotime('today'));?></p>
           <br>
           <br>
           <br>
           <p align="center">Presidente da Comissão de Avaliação</p>
           <br>
           <br>
           <br>
           <br>
<table class="table table-hover">
  <thead>
    <tr>
      <th>Membro da comissão</th>
      <th align="right">Membro da comissão</th>
    </tr>
  </thead>
</table>
<?php
$html = ob_get_contents();
ob_end_clean();
require 'vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf(); 
$stylesheet = file_get_contents('bootstrap.css');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html);

$mpdf->Output("arquivo.pdf", "I");

?>