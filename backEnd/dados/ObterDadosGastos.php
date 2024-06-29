<?php

require_once __DIR__ . "/./AlterarDadosCartoesCredito.php";

class ObterDadosGastos extends AlterarDadosCartoesCredito
{
    private $dados;

    public function ObterDadosGastos($email, $id = null)
    {
        if ($email == null)
            return false;
        if ($id != null)
            $this -> setCodigoMySql("SELECT * FROM dbName.gastos WHERE email LIKE '$email' AND id LIKE '$id';");
        else
            $this -> setCodigoMySql("SELECT * FROM dbName.gastos WHERE email LIKE '$email';");

        $this -> setDados($this -> CarregarResultadosMySql(true));

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