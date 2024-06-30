<?php

class ExcluirReceita extends ExecucaoCodigoMySql
{
    public function ExcluirReceita($id)
    {
        if (!$this-> VerificarLogin()) return false;

        $this -> setPaginaPai('receitas');
        $this -> setCodigoMySql("DELETE FROM dbName.receitas WHERE id LIKE '$id' AND email LIKE '".$this-> getSessao()."';");

        return (bool)$this-> ExecutarCodigoMySql();
    }
}