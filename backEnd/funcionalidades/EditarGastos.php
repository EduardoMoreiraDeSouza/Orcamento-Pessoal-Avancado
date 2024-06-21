<?php

require_once __DIR__ . "/./NovoCredito.php";

class EditarGastos extends NovoCredito
{

    protected $formaPagamento;

    public function __construct()
    {
        if (!$this-> VerificarLogin()) return false;

        $this-> setPaginaPai('gastos');
        $this -> setBancoCorretora($this -> bancoCorretora());
        $this-> setFormaPagamento($this-> formaPagamento());
        $this -> setClassificacao($this -> classificacao());
        $this -> setDataEfetivacao($this -> dataEfetivacao());
        $this -> setValor($this -> valor());
        $this -> setParcelas($this -> parcelas());

        if (
            !$this -> getBancoCorretora() or
            !$this -> getFormaPagamento() or
            !$this -> getClassificacao() or
            !$this -> getDataEfetivacao() or
            !$this -> getValor() or
            !$this -> getParcelas()
        ) {
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        $banco = $this -> SaidaDadosBancosCorretoras($this -> getBancoCorretora(), $this -> getSessao());

        if (!$banco) {
            $this -> Comunicar('naoBancoCorretora');
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }



    }

    protected function getFormaPagamento()
    {
        return $this -> formaPagamento;
    }

    protected function setFormaPagamento($formaPagamento): void
    {
        $this -> formaPagamento = $formaPagamento;
    }
}