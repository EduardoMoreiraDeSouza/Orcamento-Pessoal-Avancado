<?php

require_once __DIR__ . "/./NovoDebito.php";

class NovoCredito extends NovoDebito
{
    private $cartaoCredito;

    public function __construct()
    {
        if (!$this -> VerificarLogin()) return false;

        $this -> setPaginaPai('credito');
        $this -> setCartaoCredito($this -> cartaoCredito());
        $this -> setClassificacao($this -> classificacao());
        $this -> setDataCompraPagamento($this -> dataCompraPagamento());
        $this -> setValor($this -> valor());
        $this -> setParcelas($this -> parcelas());

        if (
            !$this -> getCartaoCredito() or
            !$this -> getClassificacao() or
            !$this -> getDataCompraPagamento() or
            !$this -> getValor() or
            !$this -> getParcelas()
        )
            return (bool)$this-> RetornarErro('pai', null);

        $cartao = $this -> ObterDadosCartoesCredito($this -> getCartaoCredito(), $this -> getSessao());

        if (!$cartao)
            return (bool)$this-> RetornarErro('pai', 'naoBancoCorretora');

        $this-> timezone();

        /* if ($cartao['saldo'] - $this -> getValor() < 0 and $this -> getDataCompraPagamento() <= date('Y-m-d')) {
            $this -> Comunicar('saldoInsuficiente');
            $this -> Redirecionar('pai');
            return false;
        } */

        if (!$this -> EntradaDadosGastos(
            $this -> getCartaoCredito(),
            'Crédito',
            $this -> getClassificacao(),
            $this -> getDataCompraPagamento(),
            $this -> getValor(),
            $this -> getParcelas()
        ))
            return (bool)$this-> RetornarErro('pai', null);

        return !$this-> RetornarErro('pai', null);
    }

    public function getCartaoCredito()
    {
        return $this -> cartaoCredito;
    }

    public function setCartaoCredito($cartaoCredito): void
    {
        $this -> cartaoCredito = $cartaoCredito;
    }

}