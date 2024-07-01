<?php

require_once __DIR__ . "/./ObterDadosReceita.php";

abstract class EntradaDadosReceita extends ObterDadosReceita
{
    public function EntradaDadosReceita($id_bancoCorretora, $nome, $classificacao, $dataCompraPagamento, $valor, $parcelas)
    {
        $this -> setCodigoMySql("INSERT INTO dbName.receitas VALUES ('0', '$id_bancoCorretora', '". $this -> getSessao() ."', '$nome', '$classificacao', '$valor', '$parcelas','$dataCompraPagamento');");

        return (bool)$this-> ExecutarCodigoMySql();
    }
}