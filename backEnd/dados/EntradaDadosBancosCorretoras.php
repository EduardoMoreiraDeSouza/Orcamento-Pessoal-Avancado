<?php

require_once __DIR__ . "/./SaidaDadosBancosCorretoras.php";

abstract class EntradaDadosBancosCorretoras extends SaidaDadosBancosCorretoras
{
    protected function EntradaDadosBancosCorretoras($nome, $email, $saldo)
    {
        $this -> setCodigoMySql("INSERT INTO dbName.bancosCorretoras VALUES ('$nome', '$email', '$saldo');");

        if (!$this -> ExecutarCodigoMySql()) {
            $this -> Comunicar('erroSql');
            return false;
        }

        return true;
    }
}