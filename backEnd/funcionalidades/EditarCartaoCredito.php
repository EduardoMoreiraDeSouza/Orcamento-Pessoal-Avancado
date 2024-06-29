<?php

require_once __DIR__ . "/./EditarBancoCorretora.php";

class EditarCartaoCredito extends EditarBancoCorretora
{
    public function __construct()
    {
        if (!$this-> VerificarLogin()) return false;

        $this-> setPaginaPai('credito');
        $this-> setBancoCorretoraId($this-> bancoCorretoraId());
        $this-> setBancoCorretora($this-> bancoCorretora());
        $this-> setLimite($this-> valor());
        $this-> setFechamento($this-> fechamento());
        $this-> setVencimento($this-> vencimento());

        if (
            !$this-> getBancoCorretora() or
            !$this-> getLimite() or
            !$this-> getFechamento() or
            !$this-> getVencimento()
        )   
            return (bool)$this-> RetornarErro('pai', null);

        elseif ($this-> getFechamento() == $this-> getVencimento())
            return (bool)$this-> RetornarErro('pai', 'fechamentoVencimento');

        elseif (
            !$this-> AlterarDadosCartoesCredito(
                $this-> getBancoCorretora(),
                $this-> getBancoCorretoraId(),
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