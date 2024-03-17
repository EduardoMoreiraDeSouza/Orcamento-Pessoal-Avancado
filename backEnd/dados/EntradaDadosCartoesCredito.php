<?php

require_once __DIR__ . "/./SaidaDadosCartoesCredito.php";

abstract class EntradaDadosCartoesCredito extends SaidaDadosCartoesCredito
{
    protected function EntradaDadosCartoesCredito($nome, $cpf, $limite, $fechamento, $vencimento)
    {

        $dbName = $this-> Servidor('DBname');
        $this -> setCodigoMySql("INSERT INTO $dbName.cartoesCredito VALUES ('$nome', '$cpf', '$limite', '$fechamento', '$vencimento');");

        if (!$this -> ExecutarCodigoMySql()) {
            $this -> Comunicar('erroSql');
            return false;
        }

        return true;

    }
}