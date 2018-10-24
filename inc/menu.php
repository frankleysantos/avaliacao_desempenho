<nav class="navbar navbar-expand-lg navbar-dark bg-info navmeu">
  <a class="navbar-brand" href="index.php"><label class="fas fa-home">Home</label></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <?php if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) :?>
        <?php if ($sql['perfil'] == 'coordenador'):?>
      <li class="nav-item active">
        <a class="nav-link" href="cad_gestor.php"><label class="fas fa-edit">Cadastrar Avaliador</label><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <label class="fas fa-users">Avaliado</label>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="cad_avaliado.php">Cadastrar Avaliado</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="lista_avaliado.php">Listar Avaliados</a>
        </div>
      </li>
      <!--
      <li class="nav-item">
        <a class="nav-link" href="cad_avaliacao_desempenho.php">Cadastrar Avaliacão<span class="sr-only">(current)</span></a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="cad_avaliado.php">Cadastrar Avaliado</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="lista_avaliado.php">Listar Avaliados</a>
      </li>
      -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <label class="fas fa-file-signature">Avaliacão</label>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="cad_avaliacao_desempenho.php">Cadastrar Avaliacão</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="liberar_avaliacao_all.php">Liberar Avaliação</a>
        </div>
      </li>
        <?php endif ?>
        <?php if ($sql['perfil'] == 'avaliador'):?>
      <li class="nav-item active">
        <a class="nav-link" href="cad_avaliado_gestor.php"><label class="fas fa-edit">Cadastrar Avaliado</label></a>
      </li>
        <?php endif ?>
      <li class="nav-item active">
        <a class="nav-link" href="inc/sair.php"><label class="fas fa-sign-out-alt">Sair</label></a>
      </li>
      <?php endif ?>
    </ul>
  </div>
</nav>
<?php if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])): ?>
<div class="hidden-print">
<h4 align="right"><label>Usuário:&ensp;</label><?php echo $sql['nome']; ?>&ensp;</h4>
</div>
<?php endif ?>