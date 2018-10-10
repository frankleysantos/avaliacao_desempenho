<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/avaliado.class.php";
require "classes/gestor.class.php";

$avaliado = new Avaliado($pdo);
$gestor   = new Gestor($pdo);
$id = $_SESSION['Login'];

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
                
    <?php
    	foreach ($info as $dado) {
        ?>
                <tr>
                    <td><?= $dado['nome']?></td>
                    <td><?= $dado['matricula']?></td>
                    <?php if ($dado['status'] == '0' && $dado['perfil'] == 'avaliador'):?>
                    <td><a class="btn btn-success" href="cad_resposta.php?id=<?=$dado['id']?>">Responder</a>
                        <a class="btn btn-info" href="edit_avaliado.php?id=<?=$dado['id']?>">Editar</a>
                    </td>
                    <?php endif?>
                    <?php if ($dado['status'] == '1'):?>
                    <td><label class="badge badge-warning">Já respondido</label></td>
                    <?php endif?>
                </tr>
        <?php
    	}
        ?>
          </tbody>
        </table>
        <?php

    }
}else{

  $info = $avaliado->listaAvaliados();
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
                
    <?php
        foreach ($info as $dado) {
        ?>
                <tr>
                    <td><?= $dado['nome']?></td>
                    <td><?= $dado['matricula']?></td>
                    <?php if ($dado['status'] == '1'):?>
                    <td>
                        <a class="btn btn-info" href="calculo_avaliacao.php?id_avaliado=<?=$dado['id']?>">Ver resultados</a>
                    </td>
                    <?php endif?>
                </tr>
        <?php
        }
        ?>
          </tbody>
        </table>
        <?php

    }else{
        ?>
        <div class="jumbotron">
          <h1 class="display-4">Bem Vindo!</h1>
          <p class="lead">Sistema de Avaliação de Desempenho.</p>
          <hr class="my-4">
          <p>Nenhum funcionário avaliado até o momento.</p>
        </div>
        <?php
    }
}
    
}else{
    header("Location: login.php");
}

?>
<!--
1 - lista os funcionarios vinculados a cada gestor
2 - Seleciona o funcionario que o gestor irá responder
3 - Se o funcionario ja tiver sido avaliado, o botao de avaliar é desativado. (Ideia - listar os ativos e os não ativos separados)                                                  
-->
<?php
require "inc/rodape.php";  
?>