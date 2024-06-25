<?php

require_once __DIR__ . "/../funcionalidades/Entrar.php";

class EditarBancoCorretora extends Entrar
{
    private $nomeId;

    public function __construct()
    {
        if (!$this -> VerificarLogin()) return false;

        $this -> setPaginaPai('bancosCorretoras');
        $this -> setNomeId($this -> nomeId());
        $this -> setNome($this -> nome());
        $this -> setSaldo($this -> saldo());

        if (
            !$this -> getNome() or
            !$this -> getNomeId()
        )
            return (bool)$this-> RetornarErro('pai', null);

        if (
            !$this -> AlterarDadosBancosCorretoras(
                $this -> getNome(),
                $this -> getNomeId(),
                $this -> getSessao()
            )
        )   
            return (bool)$this-> RetornarErro('pai', null);

        if ($this-> getSaldo() > floatval($this-> ValorFinal('bancoCorretora', $this-> getNome()))) {

            if (!$this -> EntradaDadosReceita(
                $this -> getNome(),
                'correcaoSaldo',
                date('Y-m-d'),
                $this -> getSaldo() - floatval($this-> ValorFinal('bancoCorretora', $this-> getNome()))
            ))
                return (bool)$this -> RetornarErro('pai', null);
        }

        elseif ($this-> getSaldo() < floatval($this-> ValorFinal('bancoCorretora', $this-> getNome()))) {
            if (!$this -> EntradaDadosGastos(
                $this -> getNome(),
                'Débito',
                'correcaoSaldo',
                date('Y-m-d'),
                floatval($this-> ValorFinal('bancoCorretora', $this-> getNome())) - $this -> getSaldo(),
                1
            ))
                return (bool)$this-> RetornarErro('pai', null);
        }

        return !$this-> RetornarErro('pai', null);
    }

    protected function getNomeId()
    {
        return $this -> nomeId;
    }

    protected function setNomeId($nomeId): void
    {
        $this -> nomeId = $nomeId;
    }

}
