<?php

require_once __DIR__ . "/./SaidaDadosCartoesCredito.php";

abstract class EntradaDadosCartoesCredito extends SaidaDadosCartoesCredito
{
    protected function EntradaDadosCartoesCredito($nome, $email, $limite, $fechamento, $vencimento)
    {
        $this -> setCodigoMySql("INSERT INTO dbName.cartoesCredito VALUES ('$nome', '$email', '$limite', '$fechamento', '$vencimento');");

        if (!$this -> ExecutarCodigoMySql()) {
            $this -> Comunicar('erroSql');
            return false;
        }

        return true;
    }
}