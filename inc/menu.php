<nav class="navbar navbar-expand-lg navbar-dark bg-info navmeu">
  <a class="navbar-brand" href="http://teofilootoni.mg.gov.br">Prefeitura de Teófilo Otoni</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <?php if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])):?>
      <li class="nav-item active">
        <a class="nav-link" href="#">Cadastrar Avaliador<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Cadastrar Avaliado</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="inc/sair.php">Sair</a>
      </li>
      <?php endif ?>
    </ul>
  </div>
</nav>