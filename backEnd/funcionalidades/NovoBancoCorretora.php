<?php

require_once __DIR__ . "/../formulario/Formulario.php";

class NovoBancoCorretora extends Formulario
{
    private $bancoCorretora;
    private $saldo;

    public function __construct()
    {
        if (!$this-> VerificarLogin()) return false;

        $this -> setPaginaPai('bancosCorretoras');
        $this -> setBancoCorretora($this -> bancoCorretora());
        $this -> setSaldo($this -> saldo());

        if (
            !$this-> getBancoCorretora()
        )
            return (bool)$this-> RetornarErro('pai', null);

        if ($this -> ObterDadosBancosCorretoras($this -> getBancoCorretora(), $this -> getSessao()))
            return (bool)$this-> RetornarErro('pai', 'x2bancosCorretoras');

        if (!$this -> EntradaDadosBancosCorretoras(
            $this -> getBancoCorretora(),
            $this -> getSessao()
        ))
            return (bool)$this-> RetornarErro('pai', null);

        $this-> timezone();

        if ($this-> getSaldo() > 0) {
            if (!$this -> EntradaDadosReceita(
				'',
                $this -> getBancoCorretora(),
                'correcaoSaldo',
                date('Y-m-d'),
                $this -> getSaldo(),
                1
            ))
                return (bool)$this -> RetornarErro('pai', null);
        }

        elseif ($this-> getSaldo() < 0) {
            if (!$this -> EntradaDadosGastos(
                $this -> getBancoCorretora(),
                'Débito',
                'correcaoSaldo',
                date('Y-m-d'),
                $this -> getSaldo() * -1,
                1
            ))
                return (bool)$this-> RetornarErro('pai', null);
        }

        return !$this-> RetornarErro('pai', null);
    }


    protected function getBancoCorretora()
    {
        return $this->bancoCorretora;
    }

    protected function setBancoCorretora($bancoCorretora)
    {
        $this->bancoCorretora = $bancoCorretora;
    }

    protected function getSaldo()
    {
        return $this->saldo;
    }

    protected function setSaldo($valor)
    {
        $this->saldo = $valor;
    }
}