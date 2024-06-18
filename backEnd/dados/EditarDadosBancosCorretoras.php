<?php

require_once __DIR__ . "/./EntradaDadosBancosCorretoras.php";

abstract class EditarDadosBancosCorretoras extends EntradaDadosBancosCorretoras
{

    public function EditarDadosBancosCorretoras($nome, $nomeAtual, $email, $saldo)
    {

        $dbName = $this-> Servidor('DBname');
        $this -> setCodigoMySql(
            "UPDATE $dbName.bancosCorretoras SET
                nome = '$nome',
                saldo = '$saldo'
            WHERE nome LIKE '$nomeAtual' AND email LIKE '$email';"
        );

        if (!$this -> ExecutarCodigoMySql())
            return false;

        return true;

    }

}