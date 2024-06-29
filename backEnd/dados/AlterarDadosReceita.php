<?php

require_once __DIR__ . "/./EntradaDadosReceita.php";

class AlterarDadosReceita extends EntradaDadosReceita
{
    public function AlterarDadosReceita($id, $bancoCorretora, $classificacao, $valor, $parcelas, $dataCompraPagamento)
    {
        $this->setCodigoMySql(
            "UPDATE dbName.receitas SET
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