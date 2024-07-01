<?php

require_once __DIR__ . "/./EntradaDadosReceita.php";

class AlterarDadosReceita extends EntradaDadosReceita
{
    public function AlterarDadosReceita($id_receita, $id_bancoCorretora, $nome, $classificacao, $valor, $parcelas, $dataCompraPagamento)
    {
        $this->setCodigoMySql(
            "UPDATE dbName.receitas SET
                id_bancoCorretora = '$id_bancoCorretora',
                nome = '$nome',
                classificacao = '$classificacao',
                valor = '$valor',
                parcelas = '$parcelas',
                dataCompraPagamento = '$dataCompraPagamento'
            WHERE id_receita LIKE '$id_receita' AND email LIKE '".$this-> getSessao()."';"
        );

        return (bool)$this-> ExecutarCodigoMySql();
    }
}