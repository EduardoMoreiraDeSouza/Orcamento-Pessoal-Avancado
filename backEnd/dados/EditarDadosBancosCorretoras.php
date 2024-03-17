<?php

require_once __DIR__ . "/./EntradaDadosBancosCorretoras.php";

abstract class EditarDadosBancosCorretoras extends EntradaDadosBancosCorretoras
{

    public function EditarDadosBancosCorretoras($nome, $nomeAtual, $cpf, $saldo)
    {

        $dbName = $this-> Servidor('DBname');
        $this -> setCodigoMySql(
            "UPDATE $dbName.bancosCorretoras SET
                nome = '$nome',
                saldo = '$saldo'
            WHERE nome LIKE '$nomeAtual' AND cpf LIKE '$cpf';"
        );

        if (!$this -> ExecutarCodigoMySql())
            return false;

        return true;

    }

}