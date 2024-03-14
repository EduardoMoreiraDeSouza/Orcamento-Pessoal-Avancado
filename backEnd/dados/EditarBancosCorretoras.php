<?php

require_once __DIR__ . "/./EntradaDadosBancosCorretoras.php";

class EditarBancosCorretoras extends EntradaDadosBancosCorretoras
{

    public function EditarBancosCorretoras($nome, $nomeAtual, $cpf, $saldo)
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