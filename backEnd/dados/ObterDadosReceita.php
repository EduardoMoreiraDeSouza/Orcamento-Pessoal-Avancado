<?php

require_once __DIR__ . "/./EntradaDadosGastos.php";

class ObterDadosReceita extends EntradaDadosGastos
{
    private $dados;

    public function ObterDadosReceita($email)
    {
        if ($email == null)
            return false;

        $this -> setCodigoMySql("SELECT * FROM dbName.receitas WHERE email LIKE '$email';");
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