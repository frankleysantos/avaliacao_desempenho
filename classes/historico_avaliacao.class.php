<?php 
/**
 * 
 */
class HistoricoAvaliacao 
{
	private $pdo;
	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function inserirHistorico($id_avaliacao, $hist_nome, $hist_data_inicio, $hist_data_fim, $hist_atualizado_por, $nome, $data_avaliacao, $data_final){
		$sql = $this->pdo->prepare("INSERT INTO historico_avaliacao(id_avaliacao, hist_nome, hist_data_inicio, hist_data_fim, hist_data_atualizacao, hist_atualizado_por, hist_new_nome, hist_new_dt_ini, hist_new_dt_fim) VALUES (:id_avaliacao, :hist_nome, :hist_data_inicio, :hist_data_fim, now(), :hist_atualizado_por, :hist_new_nome, :hist_new_dt_ini, :hist_new_dt_fim)");
		$sql ->bindValue(":id_avaliacao", $id_avaliacao);
		$sql ->bindValue(":hist_nome", utf8_decode($hist_nome));
		$sql ->bindValue(":hist_data_inicio", $hist_data_inicio);
		$sql ->bindValue(":hist_data_fim", $hist_data_fim);
		$sql ->bindValue(":hist_atualizado_por", $hist_atualizado_por);
		$sql ->bindValue(":hist_new_nome", utf8_decode($nome));
		$sql ->bindValue(":hist_new_dt_ini", $data_avaliacao);
		$sql ->bindValue(":hist_new_dt_fim", $data_final);
		return $sql->execute();
	}
}
 ?>