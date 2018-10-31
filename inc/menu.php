<nav class="navbar navbar-expand-lg navbar-dark bg-info navmeu">
  <a class="navbar-brand" href="index.php"><label class="fas fa-home">Home</label></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <?php if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) :?>
        <?php if ($sql['perfil'] == 'coordenador'):?>
      <li class="nav-item active dropdown">
        <a class="nav-link dropdown-toggle active" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><label class="fas fa-edit">Avaliador / Comissão</label><span class="sr-only">(current)</span></a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="cad_gestor.php">Cadastrar</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="lista_avaliador.php">Listar / Editar / Excluir</a>
        </div>
      </li>
      <li class="nav-item active dropdown">
        <a class="nav-link dropdown-toggle active" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <label class="fas fa-users">Avaliado</label>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="cad_avaliado.php">Cadastrar</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="lista_avaliado.php">Listar / Editar / Excluir</a>
        </div>
      </li>
      <li class="nav-item active dropdown">
        <a class="nav-link dropdown-toggle active" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <label class="fas fa-file-signature">Avaliacão</label>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="cad_avaliacao_desempenho.php">Cadastrar / Listar</a>
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
        <a class="nav-link" href="alterar_senha.php"><label class="fas fa-sign-out-alt">Alterar Senha</label></a>
      </li>
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