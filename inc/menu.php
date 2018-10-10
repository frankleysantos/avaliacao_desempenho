<nav class="navbar navbar-expand-lg navbar-dark bg-info navmeu">
  <a class="navbar-brand" href="index.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <?php if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) :?>
        <?php if ($sql['perfil'] == 'coordenador'):?>
      <li class="nav-item active">
        <a class="nav-link" href="cad_gestor.php">Cadastrar Avaliador<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Avaliado
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="cad_avaliado.php">Cadastrar Avaliado</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="lista_avaliado.php">Listar Avaliados</a>
        </div>
      </li>
      <!--
      <li class="nav-item">
        <a class="nav-link" href="cad_avaliado.php">Cadastrar Avaliado</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="lista_avaliado.php">Listar Avaliados</a>
      </li>
    -->
        <?php endif ?>
        <?php if ($sql['perfil'] == 'avaliador'):?>
      <li class="nav-item">
        <a class="nav-link" href="cad_avaliado_gestor.php">Cadastrar Avaliado</a>
      </li>
        <?php endif ?>
      <li class="nav-item">
        <a class="nav-link" href="inc/sair.php">Sair</a>
      </li>
      <?php endif ?>
    </ul>
  </div>
</nav>
<?php if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])): ?>
<h4 align="right"><label>Bem Vindo:&ensp;</label><?php echo $sql['nome']; ?>&ensp;</h4>
<?php endif ?>