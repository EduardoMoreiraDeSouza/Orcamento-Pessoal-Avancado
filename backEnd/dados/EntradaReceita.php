<?php

require_once __DIR__ . "/./EntradaGastos.php";

class EntradaReceita extends EntradaGastos
{

    public function EntradaReceita($bancoCorretora, $classificacao, $dataEfetivacao, $valor)
    {

        $dbName = $this-> Servidor('DBname');
        $this -> setCodigoMySql("INSERT INTO $dbName.receitas VALUES ('". $this -> getSessao() ."', 'default', '$bancoCorretora', '$classificacao', '$valor', '$dataEfetivacao');");

        if (!$this -> ExecutarCodigoMySql())
            return false;

        return true;
    }

}