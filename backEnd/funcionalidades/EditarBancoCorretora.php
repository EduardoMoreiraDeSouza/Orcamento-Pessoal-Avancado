<?php

require_once __DIR__ . "/../funcionalidades/Entrar.php";

class EditarBancoCorretora extends Entrar
{

    public function __construct()
    {
        if (!$this -> VerificarLogin()) return false;

        $this -> setPaginaPai('bancosCorretoras');
        $this -> setId($this -> id());
        $this -> setBancoCorretoraId($this -> bancoCorretora());
        $this -> setSaldo($this -> saldo());

        if (
            !$this -> getBancoCorretoraId() or
            !$this -> getId() or
            !$this -> getSaldo()
        )
            return (bool)$this-> RetornarErro('pai', null);

        if (
            !$this -> AlterarDadosBancosCorretoras(
	            $this -> getId(),
                $this -> getBancoCorretoraId(),
                0
            )
        )   
            return (bool)$this-> RetornarErro('pai', null);

	    print "<script>alert('". $this-> getSaldo() > floatval($this-> ValorFinal('bancoCorretora', $this-> getId())) ."')</script>";

        if ($this-> getSaldo() > floatval($this-> ValorFinal('bancoCorretora', $this-> getId()))) {
            if (!$this -> EntradaDadosReceita(
				$this-> getId(),
                $this -> getBancoCorretoraId(),
                'correcaoSaldo',
                date('Y-m-d'),
                $this -> getSaldo() - floatval($this-> ValorFinal('bancoCorretora', $this-> getId())),
                1
            ))
                return (bool)$this -> RetornarErro('pai', null);
        }

        elseif ($this-> getSaldo() < floatval($this-> ValorFinal('bancoCorretora', $this-> getId()))) {
            if (!$this -> EntradaDadosGastos(
				$this-> getId(),
                $this -> getBancoCorretoraId(),
                'Débito',
                'correcaoSaldo',
                date('Y-m-d'),
                floatval($this-> ValorFinal('bancoCorretora', $this-> getId())) - $this -> getSaldo(),
                1
            ))
                return (bool)$this-> RetornarErro('pai', null);
        }

        return !$this-> RetornarErro('pai', null);
    }
}
