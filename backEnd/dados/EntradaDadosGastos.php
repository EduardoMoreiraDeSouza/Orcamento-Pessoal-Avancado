<?php

require_once __DIR__ . "/./SaidaDadosGastos.php";

abstract class EntradaDadosGastos extends SaidaDadosGastos
{
    public function EntradaDadosGastos($fiador, $formaPagamento, $classificacao, $dataEfetivacao, $valor, $parcelas)
    {
        $this -> setCodigoMySql("INSERT INTO dbName.gastos VALUES ('". $this -> getSessao() ."', '0', '$formaPagamento', '$fiador', '$classificacao', '$valor', '$parcelas','$dataEfetivacao');");

        if (!$this -> ExecutarCodigoMySql()) {
            $this -> Comunicar('erroSql');
            return false;
        }

        return true;
    }

}