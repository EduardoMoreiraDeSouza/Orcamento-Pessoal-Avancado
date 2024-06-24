<?php

require_once __DIR__ . "/./ObterDadosBancosCorretoras.php";

abstract class EntradaDadosBancosCorretoras extends ObterDadosBancosCorretoras
{
    protected function EntradaDadosBancosCorretoras($nome, $email)
    {
        $this -> setCodigoMySql("INSERT INTO dbName.bancosCorretoras VALUES ('$nome', '$email');");

        return (bool)$this-> ExecutarCodigoMySql();
    }
}