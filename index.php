<?php
require "inc/cabecalho.php";

if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) {
    echo "Logado";
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