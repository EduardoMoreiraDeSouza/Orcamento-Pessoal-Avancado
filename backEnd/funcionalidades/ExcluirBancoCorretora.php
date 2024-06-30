<?php

require_once __DIR__ . "/../bancoDados/ExecucaoCodigoMySql.php";

final class ExcluirBancoCorretora extends ExecucaoCodigoMySql
{
	public function ExcluirBancoCorretora($id_bancoCorretora)
	{
		if (!$this -> VerificarLogin()) return false;

		$this -> setPaginaPai('bancosCorretoras');
		$this -> setCodigoMySql("DELETE FROM dbName.bancosCorretoras WHERE id LIKE '$id_bancoCorretora' AND email LIKE '" . $this -> getSessao() . "';");


		return (bool) $this -> ExecutarCodigoMySql();
	}

}