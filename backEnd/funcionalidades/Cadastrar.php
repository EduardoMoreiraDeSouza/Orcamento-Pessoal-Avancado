<?php

require_once __DIR__ . "/./EditarCartaoCredito.php";

class Cadastrar extends EditarCartaoCredito
{

    public function __construct()
    {

        $this -> setPaginaPai('cadastrar');
        $this -> setSenha($this -> senha());
        $this -> setEmail($this -> email());

        if (
            !$this -> getSenha() or
            !$this -> getEmail()
        ) {
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        if ($this -> SaidaDadosUsuarios($this -> getEmail())) {
            $this-> Comunicar('x2email');
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        if (!$this -> EntradaDadosUsuario($this -> getEmail(), $this -> getSenha())) {
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        $this -> Comunicar('cadastro');

        new Entrar();

        $this -> Redirecionar('inicio');
        return true;

    }
}