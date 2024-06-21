<?php

require_once __DIR__ . "/./Cadastrar.php";

class Sair extends Cadastrar
{
    public function __construct()
    {
        $this -> sair();
    }

    protected function sair(): true
    {
        if (!empty($this -> getSessao())) {
            $this -> setSessao(null);
            $this -> destruirSessao();
        }

        $this -> Redirecionar('inicio');
        return true;
    }
}