<?php

require_once __DIR__ . "/../dados/EntradaDadosBancosCorretoras.php";

class EntradaGastos extends EntradaDadosBancosCorretoras
{

    public function EntradaGastos($bancoCorretora, $tipo, $classificacao, $dataEfetivacao, $valor)
    {

        $this -> setCodigoMySql("INSERT INTO orcamentopessoal.gastos VALUES ('". $this -> getSessao() ."', '0', '$tipo', '$bancoCorretora', '$classificacao', '$valor', '$dataEfetivacao');");

        if (!$this -> ExecutarCodigoMySql())
            return false;

        return true;
    }

}