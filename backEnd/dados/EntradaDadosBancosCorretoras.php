<?php

require_once __DIR__ . "/./ObterDadosBancosCorretoras.php";

abstract class EntradaDadosBancosCorretoras extends ObterDadosBancosCorretoras
{
	protected function EntradaDadosBancosCorretoras($bancoCorretora)
	{
		$this -> setCodigoMySql("INSERT INTO dbName.bancosCorretoras VALUES ('', '$bancoCorretora', '" . $this -> getSessao() . "', '');");

		return (bool) $this -> ExecutarCodigoMySql();
	}
}