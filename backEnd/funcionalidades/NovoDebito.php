<?php

require_once __DIR__ . "/../funcionalidades/EditarBancoCorretora.php";

class NovoDebito extends EditarBancoCorretora
{
    private $bancoCorretora;
    private $classificacao;
    private $dataEfetivacao;
    private $valor;
    private $parcelas;

    public function __construct()
    {
        if (!$this -> VerificarLogin()) return false;

        $this -> setPaginaPai('bancosCorretoras');
        $this -> setBancoCorretora($this -> bancoCorretora());
        $this -> setClassificacao($this -> classificacao());
        $this -> setDataEfetivacao($this -> dataEfetivacao());
        $this -> setValor($this -> valor());
        $this -> setParcelas($this -> parcelas());

        if (
            !$this -> getBancoCorretora() or
            !$this -> getClassificacao() or
            !$this -> getDataEfetivacao() or
            !$this -> getValor() or
            !$this -> getParcelas()
        )
            return (bool)$this-> RetornarErro('pai', null);

        $banco = $this -> ObterDadosBancosCorretoras($this -> getBancoCorretora(), $this -> getSessao());

        if (!$banco)
            return (bool)$this-> RetornarErro('pai', 'naoBancoCorretora');

        $this-> timezone();

        if ($banco['saldo'] - $this -> getValor() < 0 and $this -> getDataEfetivacao() <= date('Y-m-d'))
            return (bool)$this-> RetornarErro('pai', 'saldoInsuficiente');

        if (!$this -> EntradaDadosGastos(
            $this -> getBancoCorretora(),
            'Débito',
            $this -> getClassificacao(),
            $this -> getDataEfetivacao(),
            $this -> getValor(),
            $this -> getParcelas()
        ))
            return (bool)$this-> RetornarErro('pai', null);

        return !$this-> RetornarErro('pai', null);
    }


    protected function getBancoCorretora()
    {
        return $this -> bancoCorretora;
    }

    protected function setBancoCorretora($bancoCorretora)
    {
        $this -> bancoCorretora = $bancoCorretora;
    }

    protected function getClassificacao()
    {
        return $this -> classificacao;
    }

    protected function setClassificacao($classificacao)
    {
        $this -> classificacao = $classificacao;
    }

    protected function getDataEfetivacao()
    {
        return $this -> dataEfetivacao;
    }

    protected function setDataEfetivacao($dataEfetivacao)
    {
        $this -> dataEfetivacao = $dataEfetivacao;
    }

    protected function getValor()
    {
        return $this -> valor;
    }

    protected function setValor($valor)
    {
        $this -> valor = $valor;
    }

    protected function getParcelas()
    {
        return $this -> parcelas;
    }

    protected function setParcelas($parcelas)
    {
        $this -> parcelas = $parcelas;
    }

}