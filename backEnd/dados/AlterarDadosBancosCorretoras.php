<?php

require_once __DIR__ . "/./EntradaDadosBancosCorretoras.php";

abstract class AlterarDadosBancosCorretoras extends EntradaDadosBancosCorretoras
{
    public function AlterarDadosBancosCorretoras($bancoCorretora, $bancoCorretoraAtual, $email)
    {
        $this -> setCodigoMySql(
            "UPDATE dbName.bancosCorretoras SET
                bancoCorretora = '$bancoCorretora'
            WHERE bancoCorretora LIKE '$bancoCorretoraAtual' AND email LIKE '$email';"
        );

        return (bool)$this-> ExecutarCodigoMySql();
    }
}