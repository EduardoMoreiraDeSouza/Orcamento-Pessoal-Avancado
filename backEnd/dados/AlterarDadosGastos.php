<?php

require_once __DIR__ . "/./EntradaDadosGastos.php";

class AlterarDadosGastos extends EntradaDadosGastos
{
    public function AlterarDadosGastos($id, $formaPagamento, $bancoCorretora, $classificacao, $valor, $dataCompraPagamento, $parcelas)
    {
        $this->setCodigoMySql(
            "UPDATE dbName.gastos SET
                formaPagamento = '$formaPagamento',
                bancoCorretora = '$bancoCorretora',
                classificacao = '$classificacao',
                valor = '$valor',
                parcelas = '$parcelas',
                dataCompraPagamento = '$dataCompraPagamento'
            WHERE id LIKE '$id' AND email LIKE '".$this-> getSessao()."';"
        );


        return (bool)$this-> ExecutarCodigoMySql();
    }
}