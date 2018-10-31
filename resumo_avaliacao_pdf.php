 <?php session_start();
 ob_start();
 ?>
 <h4 align="center" style="padding-top: 20px; padding-bottom: 20px">RESUMO DO CONJUNTO DAS AVALIAÇÕES DO ESTÁGIO PROBATÓRIO</h4>
            <table class="table table-striped table-hover">
            		<tr>
            			<th>Cargo / Emprego:</th>
            			<td style="padding-bottom: 10px"><?=$_SESSION['resumo']['cargo'];?></td>
            		</tr>
            		<tr>
            			<th>Nº de Matrícula:</th>
            			<td colspan="2" style="padding-bottom: 10px"><?=$_SESSION['resumo']['matricula']?></td>
            		</tr>
            		<tr>
            			<th>Nome do Servidor:</th>
            			<td colspan="2" style="padding-bottom: 10px"><?=$_SESSION['resumo']['nome']?></td>
            		</tr>
            		<tr>
            			<th>Secretaria / Setor:</th>
            			<td colspan="2" style="padding-bottom: 10px"><?=$_SESSION['resumo']['secretaria']?></td>
            		</tr>
                        <tr>
                              <th>O Servidor foi:</th>                            
                              <td style="padding-bottom: 10px"><?=$_SESSION['resumo']['total'];?></td>
                        </tr>
                        <tr>
                              <td style="padding-bottom: 10px"><label><b>Observações:</b></label>
                               <label><?=$_SESSION['resumo']['obs_comissao'];?></label>
                              </td>
                        </tr>
                        <tr>
                              <th colspan="2" style="padding-bottom: 10px">Homologado em:____/____/____</th>
                        </tr>
                        <tr>
                              <th colspan="2" style="padding-bottom: 10px">Visto do servidor em:____/____/____</th>
                        </tr>
                        <tr>
                              <th>Servidor: Concorda com resultado:</th>
                              <td style="padding-bottom: 10px">(&ensp;)Sim (&ensp;)Não</td>
                        </tr>
                        <tr>
                              <td colspan="2" style="padding-bottom: 10px">Segue em anexo, o pedido de reconsideração contendo ____fls.</td>
                        </tr>
                        <tr>
                             <th>Por: Presidente de Comissão 1:</th>   
                             <td style="padding-bottom: 10px"><?=$_SESSION['resumo']['presidente'];?></td>
                        </tr>
                        <tr>
                             <th>Membro de Comissão 1:</th>   
                             <td style="padding-bottom: 10px"><?=$_SESSION['resumo']['membro_um'];?></td>
                        </tr>
                        <tr>
                             <th>Membro de Comissão 1:</th>   
                             <td style="padding-bottom: 10px"><?=$_SESSION['resumo']['membro_dois'];?></td>
                        </tr>
            </table>
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