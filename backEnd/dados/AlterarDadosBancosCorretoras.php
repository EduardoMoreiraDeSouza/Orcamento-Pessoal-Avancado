<?php

require_once __DIR__ . "/./EntradaDadosBancosCorretoras.php";

abstract class AlterarDadosBancosCorretoras extends EntradaDadosBancosCorretoras
{
    public function AlterarDadosBancosCorretoras($nome, $nomeAtual, $email, $saldo)
    {
        $this -> setCodigoMySql(
            "UPDATE dbName.bancosCorretoras SET
                nome = '$nome',
                saldo = '$saldo'
            WHERE nome LIKE '$nomeAtual' AND email LIKE '$email';"
        );

        return (bool)$this-> ExecutarCodigoMySql();
    }
}