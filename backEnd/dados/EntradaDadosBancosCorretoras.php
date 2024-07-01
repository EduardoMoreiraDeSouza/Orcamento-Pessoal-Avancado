<?php

require_once __DIR__ . "/./ObterDadosBancosCorretoras.php";

abstract class EntradaDadosBancosCorretoras extends ObterDadosBancosCorretoras
{
	protected function EntradaDadosBancosCorretoras($bancoCorretora)
	{
		$this -> setCodigoMySql("INSERT INTO dbName.bancosCorretoras VALUES ('0', '$bancoCorretora', '" . $this -> getSessao() . "', '0');");

		return (bool) $this -> ExecutarCodigoMySql();
	}
}