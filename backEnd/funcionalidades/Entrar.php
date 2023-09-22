<?php

require_once __DIR__ . "/./NovoBancoCorretora.php";

class Entrar extends NovoBancoCorretora
{

    private $cpf;
    private $senha;

    public function __construct()
    {

        $this -> setPaginaPai('entrar');
        $this -> setCpf($this -> cpf());
        $this -> setSenha($this -> senha());

        if (!$this -> SaidaDadosUsuarios($this -> getCpf())) {

            $this-> Comunicar('cadastrar');
            $this -> Redirecionar($this -> getPaginaPai());
            return false;

        }

        if (
            !$this -> getSenha() or
            !$this -> getCpf() or
            !$this -> VerificarSenha($this -> getCpf(), $this -> getSenha())
        ) {
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        $this -> setSessao($this -> getCpf());

        $this -> Comunicar('entrarSucesso');
        $this -> Redirecionar('inicio');
        return true;

    }

    protected function getCpf()
    {
        return $this -> cpf;
    }

    protected function setCpf($cpf): void
    {
        $this -> cpf = $cpf;
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