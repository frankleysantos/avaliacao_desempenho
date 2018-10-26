<?php  
/**
* 
*/
class Avaliado
{
	 private $pdo;

	 public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function respAvaliado($id){
		$sql = $this->pdo->prepare("SELECT a.id, a.nome, a.matricula, a.status, (SELECT perfil FROM gestor WHERE id =:id) as perfil FROM avaliado as a WHERE a.id_gestor = :id ORDER BY status asc");
		$sql ->bindValue(":id", $id);
		$sql ->execute();
		return $sql->fetchAll();
	}

	public function inserirAvaliado($nome, $matricula, $cargo, $secretaria, $data_nomeacao ,$chefe){
		$sql = $this->pdo->prepare("INSERT INTO avaliado (nome, matricula, cargo, secretaria, data_nomeacao, id_gestor, insercao) VALUES (:nome, :matricula, :cargo, :secretaria, :data_nomeacao, :id_gestor, now())");
		$sql ->bindValue(":nome", $nome);
		$sql ->bindValue(":matricula", $matricula);
		$sql ->bindValue(":cargo", $cargo);
		$sql ->bindValue(":secretaria", $secretaria);
		$sql ->bindValue(":data_nomeacao", $data_nomeacao);
		$sql ->bindValue(":id_gestor", $chefe);
		return $sql ->execute();
	}

	public function updateStatus($id_avaliado){
		$sql = $this->pdo->prepare("UPDATE avaliado SET status = '1' WHERE id = :id_avaliado");
		$sql ->bindValue(":id_avaliado", $id_avaliado);
		return $sql ->execute();
	}

	public function verificaAvaliado($matricula){
        $sql = $this->pdo->prepare("SELECT * FROM avaliado WHERE matricula = :matricula");
        $sql ->bindValue(":matricula", $matricula);
        $sql ->execute();
        return $sql = $sql ->fetchAll();
	}
    
    public function listaAvaliado($id){
    	$sql = $this->pdo->prepare("SELECT * FROM avaliado WHERE id = :id");
    	$sql ->bindValue(":id", $id);
    	$sql ->execute();

    	return $sql = $sql->fetchAll();
    }

	public function updateAvaliado($id, $nome, $matricula, $cargo, $secretaria, $data_nomeacao ,$chefe){
        $sql = $this->pdo->prepare("SELECT id, matricula FROM avaliado");
        $sql ->execute();
        $sql = $sql->fetchAll();

        foreach ($sql as $dado) {
        	if($dado['matricula'] == $matricula && $dado['id'] == $id){
        		$sql2 = $this->pdo->prepare("UPDATE avaliado SET nome = :nome, matricula = :matricula, cargo = :cargo, secretaria = :secretaria, data_nomeacao = :data_nomeacao, id_gestor = :chefe WHERE id = :id");
		        $sql2 ->bindValue(":id", $id);
		        $sql2 ->bindValue(":nome", $nome);
		        $sql2 ->bindValue(":matricula", $matricula);
		        $sql2 ->bindValue(":cargo", $cargo);
		        $sql2 ->bindValue(":secretaria", $secretaria);
		        $sql2 ->bindValue(":data_nomeacao", $data_nomeacao);
		        $sql2 ->bindValue(":chefe", $chefe);
		        $sql2 ->execute();
		        header("Location: lista_avaliado.php");  
		        break;
        }
            if($dado['id'] == $id){
            	$sql3 = $this->pdo->prepare("SELECT matricula FROM avaliado WHERE matricula = :matricula");
            	$sql3->bindValue(":matricula", $matricula);
            	$sql3->execute();

            	if ($sql3->rowCount() < 1) {
        	    $sql2 = $this->pdo->prepare("UPDATE avaliado SET nome = :nome, matricula = :matricula, cargo = :cargo, secretaria = :secretaria, data_nomeacao = :data_nomeacao, id_gestor = :chefe WHERE id = :id");
		        $sql2 ->bindValue(":id", $id);
		        $sql2 ->bindValue(":nome", $nome);
		        $sql2 ->bindValue(":matricula", $matricula);
		        $sql2 ->bindValue(":cargo", $cargo);
		        $sql2 ->bindValue(":secretaria", $secretaria);
		        $sql2 ->bindValue(":data_nomeacao", $data_nomeacao);
		        $sql2 ->bindValue(":chefe", $chefe);
		        $sql2 ->execute();
		        header("Location: lista_avaliado.php");
		        break;  
		        }
		        else{
		        header("Location: index.php?msn=1");
		        break;
		        }
            }
	}
	return true;
}

	public function listaAvaliados(){
    	$sql = $this->pdo->prepare("SELECT * FROM avaliado WHERE status = '1'");
    	$sql ->execute();

    	return $sql = $sql->fetchAll();
    }

    public function todosAvaliado(){
    	$sql = $this->pdo->prepare("SELECT * FROM avaliado ORDER BY id DESC");
    	$sql ->execute();

    	return $sql = $sql->fetchAll();
    }

    public function liberarStatus($id_avaliado){
		$sql = $this->pdo->prepare("UPDATE avaliado SET status = '0' WHERE id = :id_avaliado");
		$sql ->bindValue(":id_avaliado", $id_avaliado);
		return $sql ->execute();
	}
	public function excluirAvaliado($id_avaliado){
		$sql = $this->pdo->prepare("DELETE FROM avaliado WHERE id = :id_avaliado AND status = '0'");
		$sql ->bindValue(":id_avaliado", $id_avaliado);
		return $sql ->execute();
	}

	public function listaAvaliadosResp(){
    	$sql = $this->pdo->prepare("SELECT a.id, a.nome, a.matricula, a.status FROM avaliado as a, assiduidade as ass WHERE ass.id_avaliacao > 0 AND a.id = ass.id_avaliado GROUP BY a.matricula");
    	$sql ->execute();

    	return $sql = $sql->fetchAll();
    }

    public function statusAvaliacaoAll(){
    	$sql = $this->pdo->prepare("SELECT count(id) as totalavaliacao FROM avaliacao");
    	$sql->execute();
    	$sql = $sql->fetch();
    	$avaliacao = $sql['totalavaliacao'];
    	$sql2 = $this->pdo->prepare("SELECT id_avaliado, count(id_avaliado) as resposta FROM assiduidade GROUP BY id_avaliado");
    	$sql2->execute();
    	$sql2 = $sql2->fetchAll();
    	foreach ($sql2 as $qntinfo) {
    		if ($qntinfo['resposta'] < $avaliacao) {
    			$id_avaliado = $qntinfo['id_avaliado'];
    			$sql3 = $this->pdo->prepare("UPDATE avaliado SET status = '0' WHERE id = :id_avaliado");
    			$sql3->bindValue(":id_avaliado", $id_avaliado);
		        $sql3 ->execute();
    		}
    	}
    	return true;
	}
}
?>