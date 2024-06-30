<?php

require_once __DIR__ . "/./ObterDadosCartoesCredito.php";

abstract class EntradaDadosCartoesCredito extends ObterDadosCartoesCredito
{
    protected function EntradaDadosCartoesCredito($id, $limite, $fechamento, $vencimento)
    {
        $this -> setCodigoMySql("INSERT INTO dbName.cartoesCredito VALUES ('$id', '".$this-> getSessao()."', '$limite', '$fechamento', '$vencimento');");

        return (bool)$this-> ExecutarCodigoMySql();
    }
}