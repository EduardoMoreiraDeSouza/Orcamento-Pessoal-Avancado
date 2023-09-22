<?php

require_once __DIR__ . "/../bancoDados/ExecucaoCodigoMySql.php";

class ExcluirBancoCorretora extends ExecucaoCodigoMySql
{
    public function ExcluirBancoCorretora($nome, $cpf)
    {

        $this -> setCodigoMySql("DELETE FROM orcamentoPessoal.bancoscorretoras WHERE nome LIKE '$nome' AND cpf LIKE '$cpf';");

        if (!$this -> ExecutarCodigoMySql())
            return false;

        return true;
    }

}