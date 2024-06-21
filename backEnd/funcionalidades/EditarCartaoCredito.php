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
        )   
            return (bool)$this-> RetornarErro('pai', null);

        elseif ($this-> getFechamento() == $this-> getVencimento())
            return (bool)$this-> RetornarErro('pai', 'fechamentoVencimento');

        elseif (
            !$this-> AlterarDadosCartoesCredito(
                $this-> getNome(),
                $this-> getNomeId(),
                $this-> getSessao(),
                $this-> getLimite(),
                $this-> getFechamento(),
                $this-> getVencimento()
            )
        )
            return (bool)$this-> RetornarErro('pai', null);

        return !$this-> RetornarErro('pai', null);
    }

}