<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/avaliado.class.php";

$avaliado = new Avaliado($pdo);
$id = $_SESSION['Login'];

if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) {
	/*Retorna o funcionarios que já responderam*/
    $info = $avaliado->respAvaliadoOK($id);
    if (count($info) > 0) {
        echo "Respostas já realizadas<br>";
    	foreach ($info as $dado) {
    		echo $dado['nome']."&ensp;".$dado['matricula']."<br>";
    	}

    }else{
    	echo "nenhum resultado encontrado";
    }

    $info = $avaliado->respAvaliadoNO($id);
    if (count($info) > 0) {
        echo "Os que ainda não foram respondidos<br>";
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