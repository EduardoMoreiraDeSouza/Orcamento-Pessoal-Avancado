<?php

require_once __DIR__ . "/../bancoDados/ExecucaoCodigoMySql.php";

class ExcluirCartaoCredito extends ExecucaoCodigoMySql
{
    public function ExcluirCartaoCredito($id, $email)
    {

        if (!$this-> VerificarLogin()) return false;

        $this -> setPaginaPai('credito');
        $this -> setCodigoMySql("DELETE FROM dbName.cartoesCredito WHERE id LIKE '$id' AND email LIKE '$email';");

        return (bool)$this-> ExecutarCodigoMySql();
    }

}