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

        if (!$this -> SaidaDadosUsuarios($this -> getEmail())) {

            $this-> Comunicar('cadastrar');
            $this -> Redirecionar($this -> getPaginaPai());
            return false;

        }

        if (
            !$this -> getSenha() or
            !$this -> getEmail() or
            !$this -> VerificarSenha($this -> getEmail(), $this -> getSenha())
        ) {
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        $this -> setSessao($this -> getEmail());

        $this -> Comunicar('entrarSucesso');
        $this -> Redirecionar('inicio');
        return true;

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