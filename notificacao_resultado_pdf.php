 <?php session_start();
 setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
 date_default_timezone_set('America/Sao_Paulo');
  
 ob_start();
 ?>
 <div class="container">
<h4 align="center"><img src="resources/images/brasao.png" width="50px">NOTIFICAÇÃO AO SERVIDOR DO RESULTADO DA AVALIAÇÃO DE DESEMPENHO DO ESTÁGIO PROBATÓRIO</h4>
<br>
<br>
<label><b>SERVIDOR:</b>&ensp;<?=$_SESSION['notificacao']['nome'];?></label>
<br>
<br>
<p align="justify">&ensp;&ensp;&ensp;&ensp;CIENTIFICAMOS que, conforme Avaliação de Desempenho realizada no dia <b><?=$_SESSION['notificacao']['data_avaliacao']?></b>, V.Sª. atingiu a pontuação necessária à aprovação durante o Estágio Probatório, referente a este período  avaliatório, obtenção <b><?=$_SESSION['notificacao']['total']?></b> pontos no processo realizado.
</p>
<p align="justify">&ensp;&ensp;&ensp;&ensp;O Processo Administrativo instruído com todos os documentos necessários à ratificação deste resultado será arquivado na sua pasta funcional e estará à disposição para retirada de cópia caso do interesse de V.Sª.</p>
<br>
<br>
<p align="center">Atenciosamente</p>
<br>
<br>
<p align="center">Secretaria Municipal de Administração</p>
<br>
<br>
<br>
<br>
<br>
<br>
<p>Ciente em ____/____/_____</p>
<br>
<br>
<br>
<br>
<br>
<p align="center">_____________________________________________________________</p>
<p align="center">Assinatura do Servidor: <b><?=$_SESSION['notificacao']['nome'];?></b></p>
<p align="center">Téofilo Otoni <?php echo strftime('%d de %B de %Y', strtotime('today'));?>
</div>
<?php
$html = ob_get_contents();
ob_end_clean();
require 'vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf(); 
$stylesheet = file_get_contents('bootstrap.css');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html);

$mpdf->Output("notificacao resultado.pdf", "I");

?>