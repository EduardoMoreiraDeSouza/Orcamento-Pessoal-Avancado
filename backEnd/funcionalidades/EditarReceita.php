<?php

require_once __DIR__ . "/./EditarGastos.php";

class EditarReceita extends EditarGastos
{
    public function __construct()
    {
        if (!$this-> VerificarLogin()) return false;

        $this -> setPaginaPai('receitas');
        $this -> setId($this-> id());
        $this -> setBancoCorretora($this -> bancoCorretora());
        $this -> setClassificacao($this -> classificacao());
        $this -> setDataCompraPagamento($this -> dataCompraPagamento());
        $this -> setValor($this -> valor());
        $this -> setParcelas($this -> parcelas());

        if (
            !$this -> getId() or
            !$this -> getBancoCorretora() or
            !$this -> getClassificacao() or
            !$this -> getDataCompraPagamento() or
            !$this -> getValor() or
            !$this-> getParcelas()
        )
            return (bool)$this -> RetornarErro('pai', null);

        if ($this-> getValor() <= 0)
            return (bool)$this-> RetornarErro('pai', 'valorAbaixoZero');

        if (!$this -> ObterDadosBancosCorretoras($this -> getId(), $this -> getSessao()))
            return (bool)$this-> RetornarErro('pai', 'naoBancoCorretora');

        if (!$this -> AlterarDadosReceita(
           $this -> getId(),
           $this -> getBancoCorretora(),
           $this -> getClassificacao(),
           $this -> getValor(),
           $this-> getParcelas(),
           $this -> getDataCompraPagamento()
        ))
            return (bool)$this-> RetornarErro('pai', null);

        return !$this-> RetornarErro('pai', null);
    }
}