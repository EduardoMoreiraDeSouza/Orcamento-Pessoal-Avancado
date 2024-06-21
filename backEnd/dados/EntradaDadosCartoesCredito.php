<?php

require_once __DIR__ . "/./ObterDadosCartoesCredito.php";

abstract class EntradaDadosCartoesCredito extends ObterDadosCartoesCredito
{
    protected function EntradaDadosCartoesCredito($nome, $email, $limite, $fechamento, $vencimento)
    {
        $this -> setCodigoMySql("INSERT INTO dbName.cartoesCredito VALUES ('$nome', '$email', '$limite', '$fechamento', '$vencimento');");

        return (bool)$this-> ExecutarCodigoMySql();
    }
}