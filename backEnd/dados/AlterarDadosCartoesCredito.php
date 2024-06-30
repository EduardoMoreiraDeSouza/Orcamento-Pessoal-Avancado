<?php

require_once __DIR__ . "/./EntradaDadosCartoesCredito.php";

abstract class AlterarDadosCartoesCredito extends EntradaDadosCartoesCredito
{
    public function AlterarDadosCartoesCredito($id, $bancoCorretora, $email, $limite, $fechamento, $vencimento)
    {
        $this->setCodigoMySql(
            "UPDATE dbName.cartoesCredito SET
                bancoCorretora = '$bancoCorretora',
                limite = '$limite',
                fechamento = '$fechamento',
                vencimento = '$vencimento'                
            WHERE id LIKE '$id' AND email LIKE '$email';"
        );

        return (bool)$this-> ExecutarCodigoMySql();
    }
}