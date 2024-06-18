<?php

require_once __DIR__ . "/../bancoDados/ExecucaoCodigoMySql.php";

final class ExcluirCartaoCredito extends ExecucaoCodigoMySql
{
    public function ExcluirCartaoCredito($nome, $email)
    {

        if (!$this-> VerificarLogin()) return false;

        $this -> setPaginaPai('bancosCorretoras');
        $dbName = $this-> Servidor('DBname');
        $this -> setCodigoMySql("DELETE FROM $dbName.cartoesCredito WHERE nome LIKE '$nome' AND email LIKE '$email';");

        if (!$this -> ExecutarCodigoMySql())
            return false;

        return true;
    }

}