<?php

require_once __DIR__ . "/./ObterDadosBancosCorretoras.php";

abstract class EntradaDadosBancosCorretoras extends ObterDadosBancosCorretoras
{
    protected function EntradaDadosBancosCorretoras($nome, $email, $saldo)
    {
        $this -> setCodigoMySql("INSERT INTO dbName.bancosCorretoras VALUES ('$nome', '$email', '$saldo');");

        return (bool)$this-> ExecutarCodigoMySql();
    }
}