<?php

require_once __DIR__ . "/./EntradaDadosCartoesCredito.php";

abstract class AlterarDadosCartoesCredito extends EntradaDadosCartoesCredito
{
    public function AlterarDadosCartoesCredito($nome, $nomeAtual, $email, $limite, $fechamento, $vencimento)
    {
        $this->setCodigoMySql(
            "UPDATE dbName.cartoesCredito SET
                nome = '$nome',
                limite = '$limite',
                fechamento = '$fechamento',
                vencimento = '$vencimento'                
            WHERE nome LIKE '$nomeAtual' AND email LIKE '$email';"
        );

        return (bool)$this-> ExecutarCodigoMySql();
    }
}