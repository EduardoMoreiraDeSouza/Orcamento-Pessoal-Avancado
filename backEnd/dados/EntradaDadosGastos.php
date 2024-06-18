<?php

require_once __DIR__ . "/./EditarDadosCartoesCredito.php";

abstract class EntradaDadosGastos extends EditarDadosCartoesCredito
{
    public function EntradaDadosGastos($fiador, $tipo, $classificacao, $dataEfetivacao, $valor, $parcelas)
    {
        $this -> setCodigoMySql("INSERT INTO dbName.gastos VALUES ('". $this -> getSessao() ."', '0', '$tipo', '$fiador', '$classificacao', '$valor', '$parcelas','$dataEfetivacao');");

        if (!$this -> ExecutarCodigoMySql()) {
            $this -> Comunicar('erroSql');
            return false;
        }

        return true;
    }

}