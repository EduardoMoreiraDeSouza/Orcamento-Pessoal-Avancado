<?php

require_once __DIR__ . "/./EditarBancoCorretora.php";

class EditarCartaoCredito extends EditarBancoCorretora
{

    public function __construct()
    {

        if (!$this-> VerificarLogin()) return false;

        $this-> setPaginaPai('credito');
        $this-> setNomeId($this-> nomeId());
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

        elseif (
            !$this-> EditarDadosCartoesCredito(
                $this-> getNome(),
                $this-> getNomeId(),
                $this-> getSessao(),
                $this-> getLimite(),
                $this-> getFechamento(),
                $this-> getVencimento()
            )
        ) {
            $this->Redirecionar($this-> getPaginaPai());
            return false;
        }

        $this->Redirecionar($this-> getPaginaPai());
        return true;
    }

}