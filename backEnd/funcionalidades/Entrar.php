<?php

require_once __DIR__ . "/./NovoCartaoCredito.php";

class Entrar extends NovoCartaoCredito
{
    private $email;
    private $senha;

    public function __construct()
    {
        $this -> setPaginaPai('entrar');
        $this -> setEmail($this -> email());
        $this -> setSenha($this -> senha());

        if (
            !$this -> getSenha() or
            !$this -> getEmail() or
            !$this -> VerificarSenha($this -> getEmail(), $this -> getSenha())
        )
            return (bool)$this-> RetornarErro('pai', null);

        if (!$this -> ObterDadosUsuarios($this -> getEmail()))
            return (bool)$this-> RetornarErro('pai', 'cadastrar');

        $this -> setSessao($this -> getEmail());

        return !$this-> RetornarErro('inicio', 'entrarSucesso');
    }

    protected function getEmail()
    {
        return $this -> email;
    }

    protected function setEmail($email): void
    {
        $this -> email = $email;
    }

    protected function getSenha()
    {
        return $this -> senha;
    }

    protected function setSenha($senha): void
    {
        $this -> senha = $senha;
    }

}