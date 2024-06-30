<?php

require_once __DIR__ . "/../bancoDados/ExecucaoCodigoMySql.php";

class ExcluirCartaoCredito extends ExecucaoCodigoMySql
{
    public function ExcluirCartaoCredito($id_bancoCorretora)
    {

        if (!$this-> VerificarLogin()) return false;

        $this -> setPaginaPai('credito');
        $this -> setCodigoMySql("DELETE FROM dbName.cartoesCredito WHERE id_bancoCorretora LIKE '$id_bancoCorretora' AND email LIKE '".$this-> getSessao()."';");

        return (bool)$this-> ExecutarCodigoMySql();
    }

}