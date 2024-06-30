<?php

require_once __DIR__ . "/./EntradaDadosGastos.php";

class AlterarDadosGastos extends EntradaDadosGastos
{
    public function AlterarDadosGastos($id_gasto, $id_bancoCorretora,$formaPagamento, $classificacao, $valor, $dataCompraPagamento, $parcelas)
    {
        $this->setCodigoMySql(
            "UPDATE dbName.gastos SET
                id_bancoCorretora = '$id_bancoCorretora',
                formaPagamento = '$formaPagamento',
                classificacao = '$classificacao',
                valor = '$valor',
                parcelas = '$parcelas',
                dataCompraPagamento = '$dataCompraPagamento'
            WHERE id_gasto LIKE '$id_gasto' AND email LIKE '".$this-> getSessao()."';"
        );


        return (bool)$this-> ExecutarCodigoMySql();
    }
}