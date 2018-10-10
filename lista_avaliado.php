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
      		</tr>
      	</thead>
      	<tbody>
      	    <?php foreach ($avaliado as $aval): ?>
      		<tr>
      			<td><?=$aval['nome']?></td>
      			<td><?=$aval['matricula']?></td>
      			<td><?=$aval['data_nomeacao']?></td>
      		</tr>
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