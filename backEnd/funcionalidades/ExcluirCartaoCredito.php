<?php

require_once __DIR__ . "/../bancoDados/ExecucaoCodigoMySql.php";

final class ExcluirCartaoCredito extends ExecucaoCodigoMySql
{
    public function ExcluirCartaoCredito($nome, $cpf)
    {

        if (!$this-> VerificarLogin()) return false;

        $this -> setPaginaPai('bancosCorretoras');
        $dbName = $this-> Servidor('DBname');
        $this -> setCodigoMySql("DELETE FROM $dbName.cartoesCredito WHERE nome LIKE '$nome' AND cpf LIKE '$cpf';");

        if (!$this -> ExecutarCodigoMySql())
            return false;

        return true;
    }

}