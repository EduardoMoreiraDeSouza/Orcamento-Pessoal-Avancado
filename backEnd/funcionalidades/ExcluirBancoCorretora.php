<?php

require_once __DIR__ . "/../bancoDados/ExecucaoCodigoMySql.php";

final class ExcluirBancoCorretora extends ExecucaoCodigoMySql
{
    public function ExcluirBancoCorretora($bancoCorretora, $email)
    {
        if (!$this-> VerificarLogin()) return false;

        $this -> setPaginaPai('bancosCorretoras');
        $this -> setCodigoMySql("DELETE FROM dbName.bancosCorretoras WHERE bancoCorretora LIKE '$bancoCorretora' AND email LIKE '$email';");


        return (bool)$this-> ExecutarCodigoMySql();
    }

}