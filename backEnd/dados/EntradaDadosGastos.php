<?php

require_once __DIR__ . "/./EditarDadosCartoesCredito.php";

abstract class EntradaDadosGastos extends EditarDadosCartoesCredito
{

    public function EntradaDadosGastos($bancoCorretora, $tipo, $classificacao, $dataEfetivacao, $valor)
    {

        $dbName = $this-> Servidor('DBname');
        $this -> setCodigoMySql("INSERT INTO $dbName.gastos VALUES ('". $this -> getSessao() ."', '0', '$tipo', '$bancoCorretora', '$classificacao', '$valor', '$dataEfetivacao');");

        if (!$this -> ExecutarCodigoMySql())
            return false;

        return true;
    }

}