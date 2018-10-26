<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/gestor.class.php";
require "classes/secretaria.class.php";
require "classes/cargo.class.php";

$gestor = new Gestor($pdo);
$secretaria = new Secretaria($pdo);
$cargo = new Cargo($pdo);
$secre = $secretaria->listaSecretaria();
$carg = $cargo->listaCargo();
$id_gestor = $_GET['id_gestor'];

if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) {
    //verifica se o perfil é coordenador
    if ($sql['perfil'] == 'coordenador') { 

     if (isset($_POST['nome']) && !empty($_POST['nome'])) {
        $nome      = addslashes($_POST['nome']);
        $matricula = addslashes($_POST['matricula']);
        $cargo     = addslashes($_POST['cargo']);
        $secretaria= addslashes($_POST['secretaria']);
        $perfil    = addslashes($_POST['perfil']);

        $gestor->updateGestor($id_gestor, $nome, $matricula, $cargo, $secretaria, $perfil);
        header("Location: lista_avaliador.php");
    
     }
     $gestor = $gestor->listaGestorID($id_gestor);
?>
<h4 align="center">Edição do Gestor (Avaliador / Comissão) </h4>
<form action="" method="POST" role="form" style="padding-bottom: 100px;">
    <div class="form-group">
        <label class="fas fa-users">Nome</label>
        <input type="text" class="form-control" id="" placeholder="Nome Completo" name="nome" required value="<?=$gestor['nome'];?>">
    </div>

    <div class="form-group">
        <label class="fas fa-file-signature">Matricula</label>
        <input type="text" class="form-control" id="" placeholder="0000000" name="matricula" value="<?=$gestor['matricula'];?>" required>
    </div>

    <div class="form-group">
        <label class="fas fa-address-card">Cargo</label>
        <select name="cargo" class="form-control" required="required">
            <option value="">Escolha...</option>
            <?php foreach ($carg as $funcao): ?>
            <option value="<?=$funcao['id']?>"<?php if($funcao['id'] == $gestor['cargo']) echo "selected"?>><?=utf8_encode($funcao['nome'])?></option>   
            <?php endforeach ?>
        </select>
    </div>

    <div class="form-group">
        <label class="fas fa-arrow-circle-right">Secretaria</label>
        <select name="secretaria" class="form-control" required="required">
            <option value="">Escolha...</option>
            <?php foreach ($secre as $dado): ?>
            <option value="<?=$dado['id']?>"<?php if($dado['id'] == $gestor['secretaria']) echo "selected"?>><?=utf8_encode($dado['nome'])?></option>       
            <?php endforeach ?>
        </select>
    </div>

    <div class="form-group">
        <label class="fas fa-users">Perfil</label>
        <select name="perfil" class="form-control" required="required">
            <option>Escolha o Perfil...</option>
            <option value="avaliador"<?php if ($gestor['perfil'] = 'avaliador') echo 'selected';?>>Avaliador (Gestor)</option>
            <option value="coordenador"<?php if ($gestor['perfil'] = 'coordenador') echo 'selected';?>>Membro Comissão</option>

        </select>
    </div>
    <button type="submit" class="btn btn-primary fas fa-edit">Alterar</button>
</form>

<?php
    }else{
        header("Location: index.php");
    }
}else{
    header("Location: index.php");
}
require "inc/rodape.php";  
?>