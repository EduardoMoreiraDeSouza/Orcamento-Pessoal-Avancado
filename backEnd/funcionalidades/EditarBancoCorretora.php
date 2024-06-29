<?php

require_once __DIR__ . "/../funcionalidades/Entrar.php";

class EditarBancoCorretora extends Entrar
{
    private $bancoCorretoraId;

    public function __construct()
    {
        if (!$this -> VerificarLogin()) return false;

        $this -> setPaginaPai('bancosCorretoras');
        $this -> setBancoCorretoraId($this -> bancoCorretoraId());
        $this -> setBancoCorretora($this -> bancoCorretora());
        $this -> setSaldo($this -> saldo());

        if (
            !$this -> getBancoCorretora() or
            !$this -> getBancoCorretoraId() or
            !$this -> getSaldo()
        )
            return (bool)$this-> RetornarErro('pai', null);

        if (
            !$this -> AlterarDadosBancosCorretoras(
                $this -> getBancoCorretora(),
                $this -> getBancoCorretoraId(),
                0
            )
        )   
            return (bool)$this-> RetornarErro('pai', null);

        if ($this-> getSaldo() > floatval($this-> ValorFinal('bancoCorretora', $this-> getBancoCorretora()))) {

            if (!$this -> EntradaDadosReceita(
                $this -> getBancoCorretora(),
                'correcaoSaldo',
                date('Y-m-d'),
                $this -> getSaldo() - floatval($this-> ValorFinal('bancoCorretora', $this-> getBancoCorretora())),
                1
            ))
                return (bool)$this -> RetornarErro('pai', null);
        }

        elseif ($this-> getSaldo() < floatval($this-> ValorFinal('bancoCorretora', $this-> getBancoCorretora()))) {
            if (!$this -> EntradaDadosGastos(
                $this -> getBancoCorretora(),
                'Débito',
                'correcaoSaldo',
                date('Y-m-d'),
                floatval($this-> ValorFinal('bancoCorretora', $this-> getBancoCorretora())) - $this -> getSaldo(),
                1
            ))
                return (bool)$this-> RetornarErro('pai', null);
        }

        return !$this-> RetornarErro('pai', null);
    }

    protected function getBancoCorretoraId()
    {
        return $this -> bancoCorretoraId;
    }

    protected function setBancoCorretoraId($bancoCorretoraId): void
    {
        $this -> bancoCorretoraId = $bancoCorretoraId;
    }

}
