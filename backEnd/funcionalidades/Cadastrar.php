<?php

require_once __DIR__ . "/./Entrar.php";

class Cadastrar extends Entrar
{

    public function __construct()
    {

        $this -> setPaginaPai('cadastrar');
        $this -> setSenha($this -> senha());
        $this -> setCpf($this -> cpf());

        if (
            !$this -> getSenha() or
            !$this -> getCpf()
        ) {
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        if ($this -> SaidaDadosUsuarios($this -> getCpf())) {
            $this-> Comunicar('x2cpf');
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        if (!$this -> EntradaDadosUsuario($this -> getCpf(), $this -> getSenha())) {
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        $this -> Comunicar('cadastro');

        new Entrar();

        $this -> Redirecionar('inicio');
        return true;

    }
}