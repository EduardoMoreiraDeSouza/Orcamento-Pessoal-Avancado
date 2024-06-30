<?php

require_once __DIR__ . "/./EntradaDadosCartoesCredito.php";

abstract class AlterarDadosCartoesCredito extends EntradaDadosCartoesCredito
{
	public function AlterarDadosCartoesCredito($id_bancoCorretora, $limite, $fechamento, $vencimento)
	{
		$this -> setCodigoMySql(
			"UPDATE dbName.cartoesCredito SET
                limite = '$limite',
                fechamento = '$fechamento',
                vencimento = '$vencimento'                
            WHERE id_bancoCorretora LIKE '$id_bancoCorretora' AND email LIKE '" . $this -> getSessao() . "';"
		);

		return (bool) $this -> ExecutarCodigoMySql();
	}
}