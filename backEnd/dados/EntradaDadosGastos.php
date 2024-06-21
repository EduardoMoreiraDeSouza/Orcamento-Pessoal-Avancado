<?php

require_once __DIR__ . "/./ObterDadosGastos.php";

abstract class EntradaDadosGastos extends ObterDadosGastos
{
    public function EntradaDadosGastos($fiador, $formaPagamento, $classificacao, $dataEfetivacao, $valor, $parcelas)
    {
        $this -> setCodigoMySql("INSERT INTO dbName.gastos VALUES ('". $this -> getSessao() ."', '0', '$formaPagamento', '$fiador', '$classificacao', '$valor', '$parcelas','$dataEfetivacao');");

        return (bool)$this-> ExecutarCodigoMySql();
    }
}