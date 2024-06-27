<?php

require_once __DIR__ . "/./NovoCredito.php";

class EditarGastos extends NovoCredito
{

    protected $formaPagamento;
    protected $id;

    public function __construct()
    {
        if (!$this -> VerificarLogin()) return false;

        $this -> setPaginaPai('gastos');
        $this-> setId($this-> id());
        $this -> setBancoCorretora($this -> bancoCorretora());
        $this -> setFormaPagamento($this -> formaPagamento());
        $this -> setClassificacao($this -> classificacao());
        $this -> setDataCompraPagamento($this -> dataCompraPagamento());
        $this -> setValor($this -> valor());
        $this -> setParcelas($this -> parcelas());

        if (
            !$this-> getId() or
            !$this -> getBancoCorretora() or
            !$this -> getFormaPagamento() or
            !$this -> getClassificacao() or
            !$this -> getDataCompraPagamento() or
            !$this -> getValor() or
            !$this -> getParcelas()
        )
            return (bool)$this -> RetornarErro('pai', null);

        if ($this-> getValor() <= 0)
            $this-> setValor($this-> getValor() * -1);

        if (!$this -> ObterDadosBancosCorretoras($this -> getBancoCorretora(), $this -> getSessao()))
            return (bool)$this-> RetornarErro('pai', 'naoBancoCorretora');

        if (!$this -> AlterarDadosGastos(
            $this-> getId(),
            $this-> getFormaPagamento(),
            $this-> getBancoCorretora(),
            $this-> getClassificacao(),
            $this-> getValor(),
            $this-> getDataCompraPagamento(),
            $this-> getParcelas()
        ))
            return (bool)$this-> RetornarErro('pai', null);

        return !$this-> RetornarErro('pai', null);
    }

    protected function getFormaPagamento()
    {
        return $this -> formaPagamento;
    }

    protected function setFormaPagamento($formaPagamento): void
    {
        $this -> formaPagamento = $formaPagamento;
    }

    protected function getId()
    {
        return $this -> id;
    }

    protected function setId($id): void
    {
        $this -> id = $id;
    }
}