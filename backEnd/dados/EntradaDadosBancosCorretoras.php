<?php

require_once __DIR__ . "/./ObterDadosBancosCorretoras.php";

abstract class EntradaDadosBancosCorretoras extends ObterDadosBancosCorretoras
{
    protected function EntradaDadosBancosCorretoras($bancoCorretora, $email)
    {
        $this -> setCodigoMySql("INSERT INTO dbName.bancosCorretoras VALUES ('', '$bancoCorretora', '$email', '');");

        return (bool)$this-> ExecutarCodigoMySql();
    }
}