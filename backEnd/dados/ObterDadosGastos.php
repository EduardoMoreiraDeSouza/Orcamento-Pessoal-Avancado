<?php

require_once __DIR__ . "/./AlterarDadosCartoesCredito.php";

class ObterDadosGastos extends AlterarDadosCartoesCredito
{
    private $dados;

    public function ObterDadosGastos($email)
    {
        if ($email == null)
            return false;

        $this -> setCodigoMySql("SELECT * FROM dbName.gastos WHERE email LIKE '$email';");
        $this -> setDados($this -> CarregarResultadosMySql());

        return !empty($this -> getDados()) ? $this -> getDados() : false;
    }

    private function getDados()
    {
        return $this -> dados;
    }

    private function setDados($dados): void
    {
        $this -> dados = $dados;
    }
}