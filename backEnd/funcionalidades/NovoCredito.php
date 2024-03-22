<?php

require_once __DIR__ . "/./NovoDebito.php";

class NovoCredito extends NovoDebito
{

    private $cartaoCredito;

    public function __construct()
    {

        if (!$this-> VerificarLogin()) return false;

        $this -> setPaginaPai('credito');
        $this -> setCartaoCredito($this -> cartaoCredito());
        $this -> setClassificacao($this -> classificacao());
        $this -> setDataEfetivacao($this -> dataEfetivacao());
        $this -> setValor($this -> valor());

        if (
            !$this -> getCartaoCredito() or
            !$this -> getClassificacao() or
            !$this -> getDataEfetivacao() or
            !$this -> getValor()
        ) {
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        $cartao = $this-> SaidaDadosCartoesCredito($this-> getCartaoCredito(), $this-> getSessao());

        if (!$cartao) {
            $this -> Comunicar('naoBancoCorretora');
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        date_default_timezone_set('America/Sao_Paulo');

        $limiteBanco = $cartao['limite'];
        $limiteFinal = $limiteBanco - $this-> getValor();
        $dataAtual = date('Y-m-d');

        if ($limiteFinal < 0 and $this-> getDataEfetivacao() <= $dataAtual) {
            $this -> Comunicar('limiteInsuficiente');
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        if (!$this-> EntradaDadosGastos(
            $this-> getCartaoCredito(), 'credito',
            $this-> getClassificacao(), $this-> getDataEfetivacao(),
            $this-> getValor())
        ) {
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        elseif ($this-> getDataEfetivacao() <= $dataAtual) {
            $this-> EditarDadosCartoesCredito(
                $this-> getCartaoCredito(),
                $this-> getCartaoCredito(),
                $this-> getSessao(),
                $limiteFinal,
                $cartao['fechamento'],
                $cartao['vencimento'],
            );
        }

        $this -> Redirecionar($this -> getPaginaPai());
        return true;

    }

    public function getCartaoCredito()
    {
        return $this-> cartaoCredito;
    }

    public function setCartaoCredito($cartaoCredito): void
    {
        $this-> cartaoCredito = $cartaoCredito;
    }

}