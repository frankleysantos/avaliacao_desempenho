<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/avaliacao.class.php";

$avaliacao       = new Avaliacao($pdo);

if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])){
        if ($sql['perfil'] == 'coordenador'){
         
         if (isset($_POST['nome']) && !empty($_POST['nome'])) {
         $id_inserido_por  = $_SESSION['Login'];
         $nome             = $_POST['nome'];
         $data_avaliacao   = $_POST['data_avaliacao'];
         $data_final       = $_POST['data_final'];
         $avaliacao->inserirAvaliacao($nome, $data_avaliacao, $data_final, $id_inserido_por);
         }
        ?>
<h4 align="center">Cadastrar Avaliação</h4>
<form action="" method="POST" role="form">
	<div class="form-group">
		<label class="fas fa-users">Nome</label>
		<input type="text" class="form-control" id="" placeholder="Ex: primeira avaliação" name="nome" required>
	</div>
	<div class="form-group">
		<label class="fas fa-calendar-alt">Data da Avaliação</label>
		<input type="text" class="form-control" id="" placeholder="Ex: 00/00/0000" name="data_avaliacao" onkeypress="dataConta(this)" minlength="10" maxlength="10" required>
	</div>
   <div class="form-group">
      <label class="fas fa-calendar-alt">Data Final</label>
      <input type="text" class="form-control" id="" placeholder="Ex: 00/00/0000" name="data_final" onkeypress="dataConta(this)" minlength="10" maxlength="10" required>
   </div>
   <div class="row">
      <div class="col-md"><a href="index.php" class="btn btn-danger fas fa-home">Home</a></div>
      <div class="col-md" align="right"><button type="submit" class="btn btn-primary fas fa-edit">Cadastrar</button></div>
   </div>
</form>
<?php $aval = $avaliacao->listaAvaliacao(); ?>
<br>
<h4 align="center">Avaliações Cadastradas</h4>
   <table class="table table-bordered table-hover">
   	<thead>
   		<tr>
   			<th>Nome</th>
   			<th>Data Inicio</th>
            <th>Data Final</th>
            <th>Ações</th>
   		</tr>
   	</thead>
   	<tbody>
         <?php foreach ($aval as $dado):?>
   		<tr>
   			<td><?=$dado['nome'];?></td>
   			<td><?=$dado['data_avaliacao'];?></td>
            <td><?=$dado['data_final'];?></td>
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

