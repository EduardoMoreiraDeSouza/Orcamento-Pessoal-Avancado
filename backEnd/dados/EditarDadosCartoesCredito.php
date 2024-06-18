<?php

require_once __DIR__ . "/./EntradaDadosCartoesCredito.php";

abstract class EditarDadosCartoesCredito extends EntradaDadosCartoesCredito
{
    public function EditarDadosCartoesCredito($nome, $nomeAtual, $email, $limite, $fechamento, $vencimento)
    {
        $this->setCodigoMySql(
            "UPDATE dbName.cartoesCredito SET
                nome = '$nome',
                limite = '$limite',
                fechamento = '$fechamento',
                vencimento = '$vencimento'                
            WHERE nome LIKE '$nomeAtual' AND email LIKE '$email';"
        );

        if (!$this -> ExecutarCodigoMySql()) {
            $this -> Comunicar('erroSql');
            return false;
        }

        return true;
    }
}