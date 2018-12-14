<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/avaliado.class.php";
require "classes/gestor.class.php";
require "classes/disciplina.class.php";
require "classes/iniciativa.class.php";
require "classes/produtividade.class.php";
require "classes/responsabilidade.class.php";
require "classes/assiduidade.class.php";
$avaliado     = new Avaliado($pdo);
$gestor       = new Gestor($pdo);
$assiduidade  = new Assiduidade($pdo);
$disciplina        = new Disciplina($pdo);
$iniciativa        = new Iniciativa($pdo);
$produtividade     = new Produtividade($pdo);
$responsabilidade  = new Responsabilidade($pdo);
$id = $_SESSION['Login'];
if (isset($_GET['msn']) && !empty($_GET['msn'])) {
  echo "<div class='alert alert-danger alert-dismissible fade show' role='alert' align='center'>
         <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
         </button>
         <strong>A matricula inserida já existe!</strong>
       </div>";
}
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
    if (isset($_GET['cad']) && !empty($_GET['cad'])) {
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert' align='center'>
             <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
             </button>
             <strong>Funcionário cadastrado com sucesso!</strong>
            </div>";
    }
    /*Retorna os funcionarios por login*/
    $info = $avaliado->respAvaliado($id);
    if (count($info) > 0) {
      ?>
      <h4>Avaliação de Desempenho</h4>
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th><label class="fas fa-users">Nome</label></th>
            <th><label class="fas fa-file-alt">Matricula</label></th>
            <th colspan="2"><label class="fas fa-user-edit">Ações</label></th>
          </tr>
        </thead>
        <tbody>              
          <?php    foreach ($info as $dado):?>
            <?php
                $id_avaliado = $dado['id']; 
                $nota_assiduidade       = $assiduidade->ultNotaAssiduidade($id_avaliado);
                $nota_disciplina        = $disciplina->ultNotaDisciplina($id_avaliado);
                $nota_iniciativa        = $iniciativa->ultNotaIniciativa($id_avaliado);
                $nota_produtividade  = $produtividade->ultNotaProdutividade($id_avaliado);
                $nota_responsabilidade  = $responsabilidade->ultNotaResponsabilidade($id_avaliado);  

              ?>
            <tr>
              <td><?= $dado['nome']?></td>
              <td><?= $dado['matricula']?></td>
              <?php if ($dado['status'] == '0' && $dado['perfil'] == 'avaliador'):?>
                <td><a class="btn btn-success" href="busca_avaliacao.php?id=<?=$dado['id']?>"><label class="fas fa-search">Avaliar Funcionário</label></a>
                  <a class="btn btn-info" href="edit_avaliado.php?id=<?=$dado['id']?>"><label class="fas fa-user-edit">Editar</label></a>
                </td>
                <?php if ($nota_assiduidade['totalassiduidade'] > 0): ?>
                  <td><b>Ultima Nota:</b><label class="badge badge-danger"><?=$nota_assiduidade['totalassiduidade']+$nota_disciplina['totaldisciplina']+$nota_iniciativa['totaliniciativa']+$nota_produtividade['totalprodutividade']+$nota_responsabilidade['totalresponsabilidade'];?></label></td>
                <?php else: ?>
                <td><b>Nenhuma avaliação respondida</b></td>
              <?php endif; ?>
              <?php endif?>
              <?php if ($dado['status'] == '1'):?>
                <td><label class="badge badge-warning">Avaliação respondida</label></td>
              
                <td><b>Ultima Nota:</b><label class="badge badge-danger"><?=$nota_assiduidade['totalassiduidade']+$nota_disciplina['totaldisciplina']+$nota_iniciativa['totaliniciativa']+$nota_produtividade['totalprodutividade']+$nota_responsabilidade['totalresponsabilidade'];?></label></td>
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
            <th><label class="fas fa-users">Nome</label></th>
            <th><label class="fas fa-file-alt">Matricula</label></th>
            <th><label class="fas fa-user-edit">Ações</label></th>
          </tr>
        </thead>
        <tbody>            
          <?php   foreach ($info as $dado):?>
            <tr>
              <td><?= $dado['nome']?></td>
              <td><?= $dado['matricula']?></td>
              <?php if ($dado['status'] == '1' || $dado['status'] == '0'):?>
                <td>
                  <a class="btn btn-info" href="calculo_avaliacao.php?id_avaliado=<?=$dado['id']?>"><label class="fas fa-search">&ensp;Ver resultados</label></a>
                  <a class="btn btn-danger" href="relatorios.php?id_avaliado=<?=$dado['id']?>&nome=<?= $dado['nome']?>"><label i class="fas fa-file-pdf">&ensp;Relatórios</label></a>
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