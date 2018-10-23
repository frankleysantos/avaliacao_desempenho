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
    
      <table class="table table-bordered table-hover">
      	<legend align="center">Funcionários em estágio Probatório</legend>
      	<thead>
      		<tr class="table-success">
      			<th>Nome</th>
      			<th>Matrícula</th>
      			<th>Data Nomeação</th>
                        <th colspan="2">Ação</th>
                        <th colspan="2">Avaliações</th>
      		</tr>
      	</thead>
      	<tbody>
      	    <?php foreach ($avaliado as $aval): ?>
                  <?php if($aval['status'] == '0'): ?>
      		<tr>
      			<td><?=$aval['nome']?></td>
      			<td><?=$aval['matricula']?></td>
      			<td><?=$aval['data_nomeacao']?></td>
                        <td><a class="btn btn-success" href="edit_avaliado.php?id=<?=$aval['id']?>">Editar</a></td>
                        <?php 
                        $id_avaliado = $aval['id'];
                        $ass = $assiduidade->listaAssiduidade($id_avaliado);
                        if (count($ass) < 1):
                        ?>
                        <td><a class="btn btn-danger" href="excluir_avaliado.php?id=<?=$aval['id']?>">Excluir</a></td>
                        <?php else: ?>
                        <td>Exclusão proibida</td>
                        <?php endif ?>
                        <td><label class="badge badge-warning">Avaliação liberada</label></td>
                        <?php
                        $id_avaliado = $aval['id'];  
                        $assresp = $assiduidade->countAssiduidade($id_avaliado);
                        if (count($assresp) > 0):
                        foreach ($assresp as $resposta):?>
                        <td><?=$resposta['resposta']?>&ensp;Resposta(as)</td>
                        <?php endforeach?>
                        <?php else: ?>
                        <td>Nenhuma resposta</td>
                        <?php endif ?>
      		</tr>
                  <?php else: ?>
                  <tr>
                        <td><?=$aval['nome']?></td>
                        <td><?=$aval['matricula']?></td>
                        <td><?=$aval['data_nomeacao']?></td>
                        <td><a class="btn btn-success" href="edit_avaliado.php?id=<?=$aval['id']?>">Editar</a></td>
                        <!--<td><label class="badge badge-warning">Já respondido</label></td>-->
                        <td>Exclusão proibida</td>
                        <td><a class="btn btn-info" href="liberar_resp_avaliado.php?id=<?=$aval['id']?>">Liberar Proxima Avaliação</a></td>
                        <?php
                        $id_avaliado = $aval['id'];  
                        $assresp = $assiduidade->countAssiduidade($id_avaliado);
                        foreach ($assresp as $resposta):?>
                        <td><?=$resposta['resposta']?>&ensp;Resposta(as)</td>
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