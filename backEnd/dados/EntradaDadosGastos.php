<?php

require_once __DIR__ . "/./ObterDadosGastos.php";

abstract class EntradaDadosGastos extends ObterDadosGastos
{
	public function EntradaDadosGastos($id_bancoCorretora, $nome,$formaPagamento, $classificacao, $dataCompraPagamento, $valor, $parcelas)
	{
		$this -> setCodigoMySql("INSERT INTO dbName.gastos VALUES ('0', '$id_bancoCorretora', '" . $this -> getSessao() . "', '$nome','$formaPagamento', '$classificacao', '$valor', '$parcelas','$dataCompraPagamento');");

		return (bool) $this -> ExecutarCodigoMySql();
	}
}