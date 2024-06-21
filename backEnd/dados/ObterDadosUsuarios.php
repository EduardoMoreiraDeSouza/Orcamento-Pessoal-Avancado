<?php

require_once __DIR__ . "/../bancoDados/CarregarResultadosMySql.php";

abstract class ObterDadosUsuarios extends CarregarResultadosMySql
{
    private $dados;

    protected function ObterDadosUsuarios($email)
    {
        if (empty($email))
            return false;

        $this -> setCodigoMySql("SELECT * FROM dbName.usuarios WHERE email LIKE '$email';");
        $this -> setDados($this-> CarregarResultadosMySql());

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
