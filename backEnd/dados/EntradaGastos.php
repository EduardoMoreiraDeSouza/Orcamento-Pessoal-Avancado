<?php

require_once __DIR__ . "/./EditarBancosCorretoras.php";

class EntradaGastos extends EditarBancosCorretoras
{

    public function EntradaGastos($bancoCorretora, $tipo, $classificacao, $dataEfetivacao, $valor)
    {

        $dbName = $this-> Servidor('DBname');
        $this -> setCodigoMySql("INSERT INTO $dbName.gastos VALUES ('". $this -> getSessao() ."', 'default', '$tipo', '$bancoCorretora', '$classificacao', '$valor', '$dataEfetivacao');");

        if (!$this -> ExecutarCodigoMySql())
            return false;

        return true;
    }

}