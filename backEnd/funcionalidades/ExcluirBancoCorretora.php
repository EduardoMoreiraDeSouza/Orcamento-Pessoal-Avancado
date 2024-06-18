<?php

require_once __DIR__ . "/../bancoDados/ExecucaoCodigoMySql.php";

final class ExcluirBancoCorretora extends ExecucaoCodigoMySql
{
    public function ExcluirBancoCorretora($nome, $email)
    {

        if (!$this-> VerificarLogin()) return false;

        $this -> setPaginaPai('bancosCorretoras');
        $this -> setCodigoMySql("DELETE FROM dbName.bancosCorretoras WHERE nome LIKE '$nome' AND email LIKE '$email';");

        if (!$this -> ExecutarCodigoMySql())
            return false;

        return true;
    }

}