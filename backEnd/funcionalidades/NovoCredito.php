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
        $this-> setParcelas($this-> parcelas());

        if (
            !$this -> getCartaoCredito() or
            !$this -> getClassificacao() or
            !$this -> getDataEfetivacao() or
            !$this -> getValor() or
            !$this-> getParcelas()
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
        $limiteFinal = $limiteBanco - $this-> getValor() * $this-> getParcelas();

        if ($limiteFinal < 0) {
            $this -> Comunicar('limiteInsuficiente');
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        if (!$this-> EntradaDadosGastos(
            $this-> getCartaoCredito(),
            'Crédito',
            $this-> getClassificacao(),
            $this-> getDataEfetivacao(),
            $this-> getValor(),
            $this-> getParcelas()
        )) {
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        else
            $this-> EditarDadosCartoesCredito(
                $this-> getCartaoCredito(),
                $this-> getCartaoCredito(),
                $this-> getSessao(),
                $limiteFinal,
                $cartao['fechamento'],
                $cartao['vencimento'],
            );

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