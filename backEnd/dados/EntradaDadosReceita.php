<?php

require_once __DIR__ . "/./ObterDadosReceita.php";

abstract class EntradaDadosReceita extends ObterDadosReceita
{
    public function EntradaDadosReceita($bancoCorretora, $classificacao, $dataCompraPagamento, $valor, $parcelas)
    {
        $this -> setCodigoMySql("INSERT INTO dbName.receitas VALUES ('". $this -> getSessao() ."', '0', '$bancoCorretora', '$classificacao', '$valor', '$parcelas','$dataCompraPagamento');");

        return (bool)$this-> ExecutarCodigoMySql();
    }
}