<?php

require_once __DIR__ . "/./EntradaDadosBancosCorretoras.php";

abstract class AlterarDadosBancosCorretoras extends EntradaDadosBancosCorretoras
{
    public function AlterarDadosBancosCorretoras($id, $bancoCorretora, $saldo)
    {
        $this -> setCodigoMySql(
            "UPDATE dbName.bancosCorretoras SET
                bancoCorretora = '$bancoCorretora',
                saldo = '$saldo'
            WHERE id LIKE '$id' AND email LIKE '".$this-> getSessao()."';"
        );

        return (bool)$this-> ExecutarCodigoMySql();
    }
}