<?php

require_once __DIR__ . "/../formulario/DadosEntradaFormulario.php";

class NovoBancoCorretora extends DadosEntradaFormulario
{
    private $nome;
    private $saldo;

    public function __construct()
    {
        if (!$this-> VerificarLogin()) return false;

        $this -> setPaginaPai('bancosCorretoras');
        $this -> setNome($this -> nome());
        $this -> setSaldo($this -> saldo());

        if (
            !$this-> getNome()
        )
            return (bool)$this-> RetornarErro('pai', null);

        if ($this -> ObterDadosBancosCorretoras($this -> getNome(), $this -> getSessao()))
            return (bool)$this-> RetornarErro('pai', 'x2bancosCorretoras');

        if (!$this -> EntradaDadosBancosCorretoras(
            $this -> getNome(),
            $this -> getSessao()
        ))
            return (bool)$this-> RetornarErro('pai', null);

        $this-> timezone();

        if ($this-> getSaldo() > 0) {
            if (!$this -> EntradaDadosReceita(
                $this -> getNome(),
                'correcaoSaldo',
                date('Y-m-d'),
                $this -> getSaldo(),
                1
            ))
                return (bool)$this -> RetornarErro('pai', null);
        }

        elseif ($this-> getSaldo() < 0) {
            if (!$this -> EntradaDadosGastos(
                $this -> getNome(),
                'Débito',
                'correcaoSaldo',
                date('Y-m-d'),
                $this -> getSaldo() * -1,
                1
            ))
                return (bool)$this-> RetornarErro('pai', null);
        }

        return !$this-> RetornarErro('pai', null);
    }


    protected function getNome()
    {
        return $this->nome;
    }

    protected function setNome($nome)
    {
        $this->nome = $nome;
    }

    protected function getSaldo()
    {
        return $this->saldo;
    }

    protected function setSaldo($valor)
    {
        $this->saldo = $valor;
    }
}