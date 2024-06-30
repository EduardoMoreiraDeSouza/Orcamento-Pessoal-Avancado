<?php

require_once __DIR__ . "/../formulario/Formulario.php";

class NovoBancoCorretora extends Formulario
{
	private $bancoCorretora;
	private $saldo;

	public function __construct()
	{
		if (!$this -> VerificarLogin())
			return false;

		$this -> setPaginaPai('bancosCorretoras');
		$this -> setBancoCorretora($this -> bancoCorretora());
		$this -> setSaldo($this -> saldo());

		if (
			!$this -> getBancoCorretora()
		)
			return (bool) $this -> RetornarErro('pai', null);

		if ($this -> ObterDadosBancosCorretoras($this -> getBancoCorretora(), $this -> getSessao()))
			return (bool) $this -> RetornarErro('pai', 'x2bancosCorretoras');

		if (
			!$this -> EntradaDadosBancosCorretoras(
				$this -> getBancoCorretora()
			)
		)
			return (bool) $this -> RetornarErro('pai', null);

		$this -> timezone();
		$id_bancoCorretora = 0;

		$bancos = $this -> ObterDadosBancosCorretoras(null, $this -> getSessao());
		if ($this -> getSaldo() != 0 and $bancos) {
			$contador = 0;
			foreach ($bancos as $ignored) {
				if ($bancos[$contador]['bancoCorretora'] == $this -> getBancoCorretora())
					$id_bancoCorretora = $bancos[$contador]['id'];
				$contador++;
			}
		}

		if ($this -> getSaldo() > 0) {
			if (
				!$this -> EntradaDadosReceita(
					$id_bancoCorretora,
					$this -> getBancoCorretora(),
					'correcaoSaldo',
					date('Y-m-d'),
					$this -> getSaldo(),
					1
				)
			)
				return (bool) $this -> RetornarErro('pai', null);
		}
		elseif ($this -> getSaldo() < 0) {
			if (
				!$this -> EntradaDadosGastos(
					$id_bancoCorretora,
					'Débito',
					'correcaoSaldo',
					date('Y-m-d'),
					$this -> getSaldo() * -1,
					1
				)
			)
				return (bool) $this -> RetornarErro('pai', null);
		}

		return !$this -> RetornarErro('pai', null);
	}


	protected function getBancoCorretora()
	{
		return $this -> bancoCorretora;
	}

	protected function setBancoCorretora($bancoCorretora): void
	{
		$this -> bancoCorretora = $bancoCorretora;
	}

	protected function getSaldo()
	{
		return $this -> saldo;
	}

	protected function setSaldo($valor)
	{
		$this -> saldo = $valor;
	}
}