<?php

require_once __DIR__ . "/./EntradaDadosBancosCorretoras.php";

abstract class AlterarDadosBancosCorretoras extends EntradaDadosBancosCorretoras
{
    public function AlterarDadosBancosCorretoras($bancoCorretora, $bancoCorretoraAtual, $saldo)
    {
        $this -> setCodigoMySql(
            "UPDATE dbName.bancosCorretoras SET
                bancoCorretora = '$bancoCorretora',
                saldo = '$saldo'
            WHERE bancoCorretora LIKE '$bancoCorretoraAtual' AND email LIKE '".$this-> getSessao()."';"
        );

        return (bool)$this-> ExecutarCodigoMySql();
    }
}