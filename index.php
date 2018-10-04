<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/avaliado.class.php";

$avaliado = new Avaliado($pdo);

if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) {
    $info = $avaliado->listarAvaliado();
    if (count($info) > 0) {

    	foreach ($info as $dado) {
    		echo $dado['nome']."&ensp;".$dado['matricula']."<br>";
    	}

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