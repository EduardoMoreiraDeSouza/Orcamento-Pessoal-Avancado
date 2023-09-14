<?php

require_once __DIR__ . "/./Cadastrar.php";

class Entrar extends Cadastrar
{

    public function __construct()
    {

        $this -> setCpf($this -> cpf());
        $this -> setSenha($this -> senha());

        if (!$this -> SaidaDadosUsuarios($this -> getCpf())) {

            $this-> Comunicar('cadastrar');
            $this -> Redirecionar('entrar');
            return false;

        }

        if (
            !$this -> getSenha() or
            !$this -> getCpf() or
            !$this -> VerificarSenha($this -> getCpf(), $this -> getSenha())
        ) {
            $this -> Redirecionar('entrar');
            return false;
        }

        $this -> setSessao($this -> getCpf());

        $this -> Comunicar('entrarSucesso');
        $this -> Redirecionar('inicio');
        return true;

    }

}