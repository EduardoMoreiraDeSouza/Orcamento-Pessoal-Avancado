<?php

require_once __DIR__ . "/../bancoDados/ExecucaoCodigoMySql.php";

class ExcluirGasto extends ExecucaoCodigoMySql
{
	public function ExcluirGasto($id_gasto)
	{

		if (!$this -> VerificarLogin()) return false;

		$this -> setPaginaPai($_SESSION['pagina_pai']);
		$this -> setCodigoMySql("DELETE FROM dbName.gastos WHERE id_gasto LIKE '$id_gasto' AND email LIKE '" . $this -> getSessao() . "';");

		return (bool) $this -> ExecutarCodigoMySql();
	}

}