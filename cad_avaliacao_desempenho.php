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

<form action="" method="POST" role="form">
	<legend>Cadastrar Avaliação</legend>

	<div class="form-group">
		<label for="">Nome</label>
		<input type="text" class="form-control" id="" placeholder="Nome" name="nome">
	</div>
	<div class="form-group">
		<label for="">Data da Avaliação</label>
		<input type="text" class="form-control" id="" placeholder="Data" name="data_avaliacao">
	</div>

	<button type="submit" class="btn btn-primary">Cadastrar</button>
</form>
<?php $aval = $avaliacao->listaAvaliacao(); ?>
<br>
   <table class="table table-bordered table-hover">
   	<thead>
   		<legend align="center">Avaliações Cadastradas</legend>
   		<tr>
   			<th>Nome</th>
   			<th>Data avaliação</th>
   		</tr>
   	</thead>
   	<tbody>
         <?php foreach ($aval as $dado):?>
   		<tr>
   			<td><?=$dado['nome'];?></td>
   			<td><?=$dado['data_avaliacao'];?></td>
   		</tr>
         <?php endforeach ?>
   	</tbody>
   </table>
<?php
}
}
require "inc/rodape.php";
?>

