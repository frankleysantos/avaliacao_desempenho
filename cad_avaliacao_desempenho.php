<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/avaliacao.class.php";

$avaliacao       = new Avaliacao($pdo);

if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])){
        if ($sql['perfil'] == 'coordenador'){
         
         if (isset($_POST['nome']) && !empty($_POST['nome'])) {
         $nome = $_POST['nome'];
         $data_avaliacao = $_POST['data_avaliacao'];
         $avaliacao->inserirAvaliacao($nome, $data_avaliacao);
         }
        ?>
<h4 align="center">Cadastrar Avaliação</h4>
<form action="" method="POST" role="form">
	<div class="form-group">
		<label class="fas fa-users">Nome</label>
		<input type="text" class="form-control" id="" placeholder="Ex: primeira avaliação" name="nome">
	</div>
	<div class="form-group">
		<label class="fas fa-calendar-alt">Data da Avaliação</label>
		<input type="text" class="form-control" id="" placeholder="Ex: 00/00/0000" name="data_avaliacao" onkeypress="dataConta(this)" minlength="10" maxlength="10">
	</div>

	<button type="submit" class="btn btn-primary fas fa-edit">Cadastrar</button>
</form>
<?php $aval = $avaliacao->listaAvaliacao(); ?>
<br>
<h4 align="center">Avaliações Cadastradas</h4>
   <table class="table table-bordered table-hover">
   	<thead>
   		<tr>
   			<th>Nome</th>
   			<th>Data avaliação</th>
            <th>Ações</th>
   		</tr>
   	</thead>
   	<tbody>
         <?php foreach ($aval as $dado):?>
   		<tr>
   			<td><?=$dado['nome'];?></td>
   			<td><?=$dado['data_avaliacao'];?></td>
            <td><a class="btn btn-info fas fa-edit" href="editar_avaliacao.php?id_avaliacao=<?=$dado['id'];?>">Editar</a></td>
   		</tr>
         <?php endforeach ?>
   	</tbody>
   </table>
<?php
}
}
require "inc/rodape.php";
?>

