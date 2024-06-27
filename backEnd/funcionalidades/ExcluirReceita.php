<?php

class ExcluirReceita extends ExecucaoCodigoMySql
{
    public function ExcluirReceita($id, $email)
    {
        if (!$this-> VerificarLogin()) return false;

        $this -> setPaginaPai('receitas');
        $this -> setCodigoMySql("DELETE FROM dbName.receitas WHERE id LIKE '$id' AND email LIKE '$email';");

        return (bool)$this-> ExecutarCodigoMySql();
    }
}