<?php

require_once __DIR__ . "/./EditarDadosCartoesCredito.php";

abstract class EntradaDadosGastos extends EditarDadosCartoesCredito
{

    public function EntradaDadosGastos($fiador, $tipo, $classificacao, $dataEfetivacao, $valor)
    {

        $dbName = $this-> Servidor('DBname');
        $this -> setCodigoMySql("INSERT INTO $dbName.gastos VALUES ('". $this -> getSessao() ."', '0', '$tipo', '$fiador', '$classificacao', '$valor', '$dataEfetivacao');");

        if (!$this -> ExecutarCodigoMySql())
            return false;

        return true;
    }

}