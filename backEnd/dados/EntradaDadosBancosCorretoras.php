<?php

require_once __DIR__ . "/./SaidaDadosBancosCorretoras.php";

class EntradaDadosBancosCorretoras extends SaidaDadosBancosCorretoras
{

    protected function EntradaDadosBancosCorretoras($nome, $cpf, $saldo)
    {

        $dbName = $this-> Servidor('DBname');
        $this -> setCodigoMySql("INSERT INTO $dbName.bancosCorretoras VALUES ('$nome', '$cpf', '$saldo');");

        if (!$this -> ExecutarCodigoMySql()) {
            $this -> Comunicar('erroSql');
            return false;
        }

        return true;
    }
}