<?php

require_once __DIR__ . "/./EditarCartaoCredito.php";

class Cadastrar extends EditarCartaoCredito
{
    private $confirmarSenha;
    public function __construct()
    {
        $this -> setPaginaPai('cadastrar');
        $this -> setSenha($this -> senha());
        $this -> setEmail($this -> email());
        $this -> setConfirmarSenha($this -> confirmarSenha());

        if (
            !$this -> getSenha() or
            !$this -> getEmail() or
            !$this -> getConfirmarSenha()
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

    private function getConfirmarSenha()
    {
        return $this->confirmarSenha;
    }

    private function setConfirmarSenha($confirmarSenha): void
    {
        $this->confirmarSenha = $confirmarSenha;
    }
}