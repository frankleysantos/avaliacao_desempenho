<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/avaliado.class.php";
require "classes/gestor.class.php";
$avaliado = new Avaliado($pdo);
$gestor   = new Gestor($pdo);
$id = $_SESSION['Login'];
?>
<div class="jumbotron">
  <h1 class="display-4">Bem Vindo</h1>
  <p class="lead">Avaliação de Desempenho Prefeitura Municipal de Teófilo otoni</p>
</div>
<?php
if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) {
    $perfil = $gestor->listaStatus($id);
    /*Verifica o tipo de perfil, para cada tipo de permissão*/
    if ($perfil['perfil'] == 'avaliador'){
	/*Retorna os funcionarios por login*/
      $info = $avaliado->respAvaliado($id);
        if (count($info) > 0) {
?>
         <h4>Avaliação de Desempenho</h4>
          <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Matricula</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>              
<?php    foreach ($info as $dado):?>
                <tr>
                    <td><?= $dado['nome']?></td>
                    <td><?= $dado['matricula']?></td>
                    <?php if ($dado['status'] == '0' && $dado['perfil'] == 'avaliador'):?>
                    <td><a class="btn btn-success" href="busca_avaliacao.php?id=<?=$dado['id']?>">Avaliar Funcionário</a>
                        <a class="btn btn-info" href="edit_avaliado.php?id=<?=$dado['id']?>">Editar</a>
                    </td>
                    <?php endif?>
                    <?php if ($dado['status'] == '1'):?>
                    <td><label class="badge badge-warning">Já respondido todas as avaliações</label></td>
                    <?php endif?>
                </tr>
<?php    endforeach ?>
            </tbody>
          </table>
<?php
        }
    }else{
    $info = $avaliado->listaAvaliadosResp();
        if (count($info) > 0) {
?>
         <h4>Avaliação de Desempenho</h4>
          <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Matricula</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>            
<?php   foreach ($info as $dado):?>
                <tr>
                    <td><?= $dado['nome']?></td>
                    <td><?= $dado['matricula']?></td>
                    <?php if ($dado['status'] == '1' || $dado['status'] == '0'):?>
                    <td>
                        <a class="btn btn-info" href="calculo_avaliacao.php?id_avaliado=<?=$dado['id']?>">Ver resultados</a>
                        <a class="btn btn-danger" href="relatorios.php?id_avaliado=<?=$dado['id']?>&nome=<?= $dado['nome']?>">Relatórios</a>
                    </td>
                    <?php endif?>
                </tr>
<?php   endforeach?>
            </tbody>
          </table>
<?php
    }
}
    
}else{
    header("Location: login.php");
}

?>
<?php
require "inc/rodape.php";  
?>