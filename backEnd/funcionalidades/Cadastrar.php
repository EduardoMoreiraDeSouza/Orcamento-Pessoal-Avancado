<?php

require_once __DIR__ . "/./Entrar.php";
require_once __DIR__ . "/./NovoBancoCorretora.php";

class Cadastrar extends NovoBancoCorretora
{

    private $cpf;
    private $senha;

    public function __construct()
    {

        $this -> setPaginaPai('cadastrar');
        $this -> setSenha($this -> senha());
        $this -> setCpf($this -> cpf());

        if (
            !$this -> getSenha() or
            !$this -> getCpf()
        ) {
            $this -> Redirecionar('cadastrar');
            return false;
        }

        if ($this -> SaidaDadosUsuarios($this -> getCpf())) {
            $this-> Comunicar('x2cpf');
            $this -> Redirecionar('cadastrar');
            return false;
        }

        if (!$this -> EntradaDadosUsuario($this -> getCpf(), $this -> getSenha())) {
            $this -> Redirecionar('cadastrar');
            return false;
        }

        $this -> Comunicar('cadastro');

        new Entrar();

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