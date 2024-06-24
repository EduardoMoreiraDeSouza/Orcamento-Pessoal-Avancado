<?php

require_once __DIR__ . "/./NovoDebito.php";

class NovaReceita extends NovoDebito
{
    public function __construct()
    {
        if (!$this-> VerificarLogin()) return false;

        $this -> setPaginaPai('bancosCorretoras');
        $this -> setBancoCorretora($this -> bancoCorretora());
        $this -> setClassificacao($this -> classificacao());
        $this -> setDataCompraPagamento($this -> dataCompraPagamento());
        $this -> setValor($this -> valor());

        if (
            !$this -> getBancoCorretora() or
            !$this -> getClassificacao() or
            !$this -> getDataCompraPagamento() or
            !$this -> getValor()
        )
            return (bool)$this-> RetornarErro('pai', null);

        if (!$this -> ObterDadosBancosCorretoras($this -> getBancoCorretora(), $this -> getSessao()))
            return (bool)$this-> RetornarErro('pai', 'naoBancoCorretora');

        if (!$this -> EntradaDadosReceita($this -> getBancoCorretora(), $this -> getClassificacao(), $this -> getDataCompraPagamento(), $this -> getValor()))
            return (bool)$this-> RetornarErro('pai', null);

        return !$this-> RetornarErro('pai', null);
    }
}