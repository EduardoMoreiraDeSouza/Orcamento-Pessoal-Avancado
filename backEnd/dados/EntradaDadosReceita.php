<?php

require_once __DIR__ . "/./EntradaDadosGastos.php";

abstract class EntradaDadosReceita extends EntradaDadosGastos
{
    public function EntradaDadosReceita($bancoCorretora, $classificacao, $dataEfetivacao, $valor)
    {
        $this -> setCodigoMySql("INSERT INTO dbName.receitas VALUES ('". $this -> getSessao() ."', '0', '$bancoCorretora', '$classificacao', '$valor', '$dataEfetivacao');");

        if (!$this -> ExecutarCodigoMySql()) {
            $this -> Comunicar('erroSql');
            return false;
        }

        return true;
    }

}