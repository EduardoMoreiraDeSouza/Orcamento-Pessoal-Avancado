<?php

require_once __DIR__ . "/../bancoDados/ExecucaoCodigoMySql.php";

class ExcluirBancoCorretora extends ExecucaoCodigoMySql
{
    public function ExcluirBancoCorretora($nome, $cpf)
    {

        $dbName = $this-> Servidor('DBname');
        $this -> setCodigoMySql("DELETE FROM $dbName.bancosCorretoras WHERE nome LIKE '$nome' AND cpf LIKE '$cpf';");

        if (!$this -> ExecutarCodigoMySql())
            return false;

        return true;
    }

}