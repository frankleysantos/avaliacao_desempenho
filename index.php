<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/avaliado.class.php";

$avaliado = new Avaliado($pdo);
$id = $_SESSION['Login'];

if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) {
	/*Retorna os funcionarios que já foram avaliados*/
    $info = $avaliado->respAvaliadoOK($id);
    if (count($info) > 0) {
    ?>
        <h4>Já foram respondidos</h4>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Matricula</th>
                </tr>
            </thead>
            <tbody>
                
    <?php
    	foreach ($info as $dado) {
        ?>
                <tr>
                    <td><?= $dado['nome']?></td>
                    <td><?= $dado['matricula']?></td>
                </tr>
        <?php
    	}
        ?>
          </tbody>
        </table>
        <?php

    }

    /*Retorna os funcionários que ainda serão avaliados*/
    $info = $avaliado->respAvaliadoNO($id);
    if (count($info) > 0) { ?>
    <h4>Ainda não foram avaliados</h4>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Matricula</th>
                    <th colspan="2">Funções</th>
                </tr>
            </thead>
            <tbody>
        <?php
    	foreach ($info as $dado) { ?>
                <tr>
                    <td><?= $dado['nome']?></td>
                    <td><?= $dado['matricula']?></td>
                    <?php if ($dado['status'] == 'avaliador'):?>
                    <td><a href="cad_resposta.php?id=<?=$dado['id']?>">Responder</a></td>
                    <td><a href="edit_resposta.php?id=<?=$dado['id']?>">Editar</a></td>
                    <?php endif?>
                    <?php if ($dado['status'] == 'coordenador'):?>
                    <td><a href="edit_avaliador.php?id=<?=$dado['id']?>">Editar</a></td>
                    <?php endif?>
                </tr>
        <?php 
    	} ?>
            </tbody>
        </table>
        <?php
    }else{
    	echo "nenhum resultado encontrado";
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