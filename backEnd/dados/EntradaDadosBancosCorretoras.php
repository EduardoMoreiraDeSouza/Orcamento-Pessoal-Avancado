<?php

require_once __DIR__ . "/./SaidaDadosBancosCorretoras.php";

class EntradaDadosBancosCorretoras extends SaidaDadosBancosCorretoras
{

    protected function EntradaDadosBancosCorretoras($nome, $cpf, $saldo)
    {

        $this -> setCodigoMySql("INSERT INTO orcamentopessoal.bancoscorretoras VALUES ('$nome', '$cpf', '$saldo');");

        if (!$this -> ExecutarCodigoMySql()) {
            $this -> Comunicar('erroSql');
            return false;
        }

        return true;
    }
}