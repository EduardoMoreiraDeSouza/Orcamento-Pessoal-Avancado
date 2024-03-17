<?php

require_once __DIR__ . "/./EntradaDadosCartoesCredito.php";

abstract class EditarDadosCartoesCredito extends EntradaDadosCartoesCredito
{

    public function EditarDadosCartoesCredito($nome, $nomeAtual, $cpf, $limite, $fechamento, $vencimento)
    {

        $dbName = $this->Servidor('DBname');
        $this->setCodigoMySql(
            "UPDATE $dbName.cartoesCredito SET
                nome = '$nome',
                limite = '$limite',
                fechamento = '$fechamento',
                vencimento = '$vencimento'                
            WHERE nome LIKE '$nomeAtual' AND cpf LIKE '$cpf';"
        );

        if (!$this->ExecutarCodigoMySql())
            return false;

        return true;

    }

}