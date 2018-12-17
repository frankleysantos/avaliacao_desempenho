<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/avaliado.class.php";
require "classes/gestor.class.php";
require "classes/assiduidade.class.php";

$avaliado = new Avaliado($pdo);
$assiduidade= new Assiduidade($pdo);
$id = $_SESSION['Login'];

$avaliado = $avaliado->todosAvaliado();

if ($sql['perfil'] == 'coordenador'){

if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) { ?>
    <h4 align="center">Funcionários em estágio Probatório</h4>
      <table class="table table-bordered table-hover">
      	<thead>
      		<tr class="table-success">
      			<th><label class="fas fa-users">Nome</label></th>
      			<th><label class="fas fa-file-signature">Matrícula</label></th>
      			<th><label class="fas fa-calendar-alt">Nomeação</label></th>
                        <th colspan="2"><label class="fas fa-edit">Ação</label></th>
                        <th colspan="2"><label class="fas fa-file-signature">Avaliações</label></th>
      		</tr>
      	</thead>
      	<tbody>
      	    <?php foreach ($avaliado as $aval): ?>
                  <?php if($aval['status'] == '0'): ?>
      		<tr>
      			<td><?=utf8_encode($aval['nome'])?></td>
      			<td><?=$aval['matricula']?></td>
      			<td><?=$aval['data_nomeacao']?></td>
                        <td><a class="btn btn-success fas fa-edit" href="edit_avaliado.php?id=<?=$aval['id']?>">Editar</a></td>
                        <?php 
                        $id_avaliado = $aval['id'];
                        $ass = $assiduidade->listaAssiduidade($id_avaliado);
                        if (count($ass) < 1):
                        ?>
                        <td><a class="btn btn-danger fas fa-trash-alt" href="excluir_avaliado.php?id=<?=$aval['id']?>">Excluir</a></td>
                        <?php else: ?>
                        <td><label class="badge badge-pill badge-dark">Exclusão proibida</label></td>
                        <?php endif ?>
                        <td><label class="badge badge-pill badge-warning">Avaliação liberada</label></td>
                        <?php
                        $id_avaliado = $aval['id'];  
                        $assresp = $assiduidade->countAssiduidade($id_avaliado);
                        if (count($assresp) > 0):
                        foreach ($assresp as $resposta):?>
                        <td><label class="badge badge-pill badge-secondary"><?=$resposta['resposta']?>&ensp;Resposta(as)</label></td>
                        <?php endforeach?>
                        <?php else: ?>
                        <td><label class="badge badge-pill badge-danger">Nenhuma resposta</label></td>
                        <?php endif ?>
      		</tr>
                  <?php else: ?>
                  <tr>
                        <td><?=$aval['nome']?></td>
                        <td><?=$aval['matricula']?></td>
                        <td><?=$aval['data_nomeacao']?></td>
                        <td><a class="btn btn-success fas fa-edit" href="edit_avaliado.php?id=<?=$aval['id']?>">Editar</a></td>
                        <!--<td><label class="badge badge-warning">Já respondido</label></td>-->
                        <td><label class="badge badge-pill badge-dark">Exclusão proibida</label></td>
                        <td><a class="btn btn-info fas fa-file-signature" href="liberar_resp_avaliado.php?id=<?=$aval['id']?>">Liberar Avaliação</a></td>
                        <?php
                        $id_avaliado = $aval['id'];  
                        $assresp = $assiduidade->countAssiduidade($id_avaliado);
                        foreach ($assresp as $resposta):?>
                        <td><label class="badge badge-pill badge-secondary"><?=$resposta['resposta']?>&ensp;Resposta(as)</label></td>
                        <?php endforeach?>
                  </tr>
                  <?php endif ?>
      		<?php endforeach ?>
      	</tbody>
      </table>
    <?php 
}else{
	header("Location: index.php");
}
}else{
      header("Location: index.php");
}
require "inc/rodape.php";
?>