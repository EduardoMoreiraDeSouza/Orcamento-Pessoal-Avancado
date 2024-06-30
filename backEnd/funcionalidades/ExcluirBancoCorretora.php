<?php

require_once __DIR__ . "/../bancoDados/ExecucaoCodigoMySql.php";

final class ExcluirBancoCorretora extends ExecucaoCodigoMySql
{
    public function ExcluirBancoCorretora($id, $email)
    {
        if (!$this-> VerificarLogin()) return false;

        $this -> setPaginaPai('bancosCorretoras');
        $this -> setCodigoMySql("DELETE FROM dbName.bancosCorretoras WHERE id LIKE '$id' AND email LIKE '$email';");


        return (bool)$this-> ExecutarCodigoMySql();
    }

}