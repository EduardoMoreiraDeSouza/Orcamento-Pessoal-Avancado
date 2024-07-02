<?php

require_once __DIR__ . "/../funcionalidades/Entrar.php";

class EditarBancoCorretora extends Entrar
{
	public function __construct()
	{
		if (!$this -> VerificarLogin())
			return false;

		$this -> setPaginaPai($_SESSION['pagina_pai']);
		$this -> setId($this -> id());
		$this -> setBancoCorretoraId($this -> bancoCorretora());
		$this -> setSaldo($this -> saldo());

		if (
			!$this -> getBancoCorretoraId() or
			!$this -> getId()
		)
			return (bool) $this -> RetornarErro('pai', null);

		if (
			!$this -> AlterarDadosBancosCorretoras(
				$this -> getId(),
				$this -> getBancoCorretoraId(),
				'0'
			)
		)
			return (bool) $this -> RetornarErro('pai', null);

		if ($this -> getSaldo() > floatval($this -> ValorFinal('bancoCorretora', $this -> getId()))) {
			if (
				!$this -> EntradaDadosReceita(
					$this -> getId(),
					'Correção do Saldo',
					'Correção do Saldo',
					date('Y-m-d'),
					$this -> getSaldo() - floatval($this -> ValorFinal('bancoCorretora', $this -> getId())),
					1
				)
			)
				return (bool) $this -> RetornarErro('pai', null);
		}

		elseif ($this -> getSaldo() < floatval($this -> ValorFinal('bancoCorretora', $this -> getId()))) {
			if (
				!$this -> EntradaDadosGastos(
					$this -> getId(),
					'Correção do Saldo',
					'Débito',
					'Correção do Saldo',
					date('Y-m-d'),
					floatval($this -> ValorFinal('bancoCorretora', $this -> getId())) - $this -> getSaldo(),
					1
				)
			)
				return (bool) $this -> RetornarErro('pai', null);
		}

		return !$this -> RetornarErro('pai', null);
	}
}
