<?php

require_once __DIR__ . "/../bancoDados/ExecucaoCodigoMySql.php";

class ExcluirGasto extends ExecucaoCodigoMySql
{
    public function ExcluirGasto($id, $email)
    {

        if (!$this-> VerificarLogin()) return false;

        $this -> setPaginaPai('gastos');
        $this -> setCodigoMySql("DELETE FROM dbName.gastos WHERE id LIKE '$id' AND email LIKE '$email';");

        return (bool)$this-> ExecutarCodigoMySql();
    }

}