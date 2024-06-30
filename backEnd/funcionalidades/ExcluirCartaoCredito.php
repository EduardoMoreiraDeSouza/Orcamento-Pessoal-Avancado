<?php

require_once __DIR__ . "/../bancoDados/ExecucaoCodigoMySql.php";

class ExcluirCartaoCredito extends ExecucaoCodigoMySql
{
    public function ExcluirCartaoCredito($id)
    {

        if (!$this-> VerificarLogin()) return false;

        $this -> setPaginaPai('credito');
        $this -> setCodigoMySql("DELETE FROM dbName.cartoesCredito WHERE id LIKE '$id' AND email LIKE '".$this-> getSessao()."';");

        return (bool)$this-> ExecutarCodigoMySql();
    }

}