<?php

class ExcluirReceita extends ExecucaoCodigoMySql
{
    public function ExcluirReceita($id_receita)
    {
        if (!$this-> VerificarLogin()) return false;

        $this -> setPaginaPai('receitas');
        $this -> setCodigoMySql("DELETE FROM dbName.receitas WHERE id_receita LIKE '$id_receita' AND email LIKE '".$this-> getSessao()."';");

        return (bool)$this-> ExecutarCodigoMySql();
    }
}