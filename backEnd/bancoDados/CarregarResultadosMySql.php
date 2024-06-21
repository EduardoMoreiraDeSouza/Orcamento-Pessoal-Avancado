<?php

require_once __DIR__ . "/./ExecucaoCodigoMySql.php";

class CarregarResultadosMySql extends ExecucaoCodigoMySql
{
    protected function CarregarResultadosMySql($retornarArraySeUmResultado = false)
    {
        $execucao = $this -> ExecutarCodigoMySql();

        if (!$execucao or empty($execucao))
            return "";

        $dadosCarregados = [];
        while ($dados = mysqli_fetch_assoc($execucao)) {
            $dadosCarregados[] = $dados;
        }

        return (count($dadosCarregados) == 1 and !$retornarArraySeUmResultado) ? $dadosCarregados[0] : $dadosCarregados;
    }
}