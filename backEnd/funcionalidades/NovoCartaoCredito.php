<?php

require_once __DIR__ . "/./NovoBancoCorretora.php";

class NovoCartaoCredito extends NovoBancoCorretora
{

    private $limite;
    private $fechamento;
    private $vencimento;

    public function __construct()
    {

        if (!$this-> VerificarLogin()) return false;

        $this -> setPaginaPai('credito');

        $this-> setNome($this-> nome());
        $this-> setLimite($this-> valor());
        $this-> setFechamento($this-> fechamento());
        $this-> setVencimento($this-> vencimento());

        if (
            !$this-> getNome() or
            !$this-> getLimite() or
            !$this-> getFechamento() or
            !$this-> getVencimento()
        ) {
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        elseif ($this-> getFechamento() == $this-> getVencimento()) {
            $this -> Comunicar('fechamentoVencimento');
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        elseif ($this-> SaidaDadosCartoesCredito($this-> getNome(), $this-> getSessao())) {
            $this -> Comunicar('x2cartoesCredito');
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        elseif (!$this-> EntradaDadosCartoesCredito($this-> getNome(),
            $this-> getSessao(),
            $this-> getLimite(),
            $this-> getFechamento(),
            $this-> getVencimento())
        )  {
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        $this -> Redirecionar($this -> getPaginaPai());
        return true;

    }

    protected function setLimite($limite): void
    {
        $this-> limite = $limite;
    }

    protected function getLimite()
    {
        return $this-> limite;
    }

    protected function setFechamento($fechamento): void
    {
        $this-> fechamento = $fechamento;
    }

    protected function getFechamento()
    {
        return $this-> fechamento;
    }

    protected function setVencimento($vencimento): void
    {
        $this-> vencimento = $vencimento;
    }

    protected function getVencimento()
    {
        return $this-> vencimento;
    }

}