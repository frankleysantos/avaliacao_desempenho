<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/avaliado.class.php";
require "classes/gestor.class.php";

$avaliado = new Avaliado($pdo);
$id = $_SESSION['Login'];

$avaliado = $avaliado->todosAvaliado($pdo);

if ($sql['perfil'] == 'coordenador'){

if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) { ?>
    
      <table class="table table-bordered table-hover">
      	<legend align="center">Funcionários em estágio Probatório</legend>
      	<thead>
      		<tr class="table-success">
      			<th>Nome</th>
      			<th>Matrícula</th>
      			<th>Data Nomeação</th>
                        <th colspan="3">Ação</th>
      		</tr>
      	</thead>
      	<tbody>
      	    <?php foreach ($avaliado as $aval): ?>
                  <?php if($aval['status'] == '0'): ?>
      		<tr>
      			<td><?=$aval['nome']?></td>
      			<td><?=$aval['matricula']?></td>
      			<td><?=$aval['data_nomeacao']?></td>
                        <td><?=$aval['status']?></td>
                        <td><a class="btn btn-success" href="edit_avaliado.php?id=<?=$aval['id']?>">Editar</a></td>
                        <td><a class="btn btn-danger" href="excluir_avaliado.php?id=<?=$aval['id']?>">Excluir</a></td>
                        <!--<td><a href="liberar_resp_avaliado.php?id=<?=$aval['id']?>">Nova Resposta</a></td>-->
      		</tr>
                  <?php else: ?>
                  <tr>
                        <td><?=$aval['nome']?></td>
                        <td><?=$aval['matricula']?></td>
                        <td><?=$aval['data_nomeacao']?></td>
                        <td><?=$aval['status']?></td>
                        <td><a class="btn btn-success" href="edit_avaliado.php?id=<?=$aval['id']?>">Editar</a></td>
                        <td><label class="badge badge-warning">Já respondido</label></td>
                        <!--<td><a href="liberar_resp_avaliado.php?id=<?=$aval['id']?>">Nova Resposta</a></td>-->
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