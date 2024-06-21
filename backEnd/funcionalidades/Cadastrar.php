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
        )
            return (bool)$this-> RetornarErro('pai', null);

        if ($this -> ObterDadosUsuarios($this -> getEmail()))
            return (bool)$this-> RetornarErro('pai', 'x2email');

        if (!$this -> EntradaDadosUsuario($this -> getEmail(), $this -> getSenha()))
            return (bool)$this-> RetornarErro('pai', null);

        $this -> Comunicar('cadastro');

        new Entrar();

        return !$this-> RetornarErro('inicio', null);
    }
}