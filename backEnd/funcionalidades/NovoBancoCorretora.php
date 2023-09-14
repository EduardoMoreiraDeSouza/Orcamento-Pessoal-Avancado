<?php

require_once __DIR__ . "/../dados/DadosEntradaFormulario.php";

class NovoBancoCorretora extends DadosEntradaFormulario
{

    private $nome;
    private $valor;

    public function __construct()
    {

        $this -> setNome($this -> nome());
        $this -> setValor($this -> valor());

    }


    protected function getNome()
    {
        return $this->nome;
    }

    protected function setNome($nome)
    {
        $this->nome = $nome;
    }

    protected function getValor()
    {
        return $this->valor;
    }

    protected function setValor($valor)
    {
        $this->valor = $valor;
    }
}