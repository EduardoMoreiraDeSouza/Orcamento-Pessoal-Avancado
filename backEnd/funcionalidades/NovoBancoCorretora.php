<?php

require_once __DIR__ . "/../formulario/Formulario.php";

class NovoBancoCorretora extends Formulario
{
	private $nome;
	private $bancoCorretoraId;
	private $saldo;

	public function __construct()
	{
		if (!$this -> VerificarLogin())
			return false;

		$this -> setPaginaPai($_SESSION['pagina_pai']);
		$this -> setBancoCorretoraId($this -> bancoCorretora());
		$this -> setSaldo($this -> saldo());

		if (
			!$this -> getBancoCorretoraId()
		)
			return (bool) $this -> RetornarErro('pai', null);

		$id_bancoCorretora = 0;

		if ($bancos = $this -> ObterDadosBancosCorretoras(null, $this -> getSessao())) {
			$contador = 0;
			foreach ($bancos as $ignored) {
				if ($bancos[$contador]['bancoCorretora'] == $this -> getBancoCorretoraId())
					return (bool) $this -> RetornarErro('pai', 'x2bancosCorretoras');
			}
		}

		if (
			!$this -> EntradaDadosBancosCorretoras(
				$this -> getBancoCorretoraId()
			)
		)
			return (bool) $this -> RetornarErro('pai', null);

		if ($this -> getSaldo() != 0 and $bancos = $this -> ObterDadosBancosCorretoras(null, $this -> getSessao())) {
			$contador = 0;
			foreach ($bancos as $ignored) {
				if ($bancos[$contador]['bancoCorretora'] == $this -> getBancoCorretoraId())
					$id_bancoCorretora = $bancos[$contador]['id'];
				$contador++;
			}
		}

		if ($this -> getSaldo() > 0) {
			if (
				!$this -> EntradaDadosReceita(
					$id_bancoCorretora,
					'Correção do Saldo',
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


	protected function getBancoCorretoraId()
	{
		return $this -> bancoCorretoraId;
	}

	protected function setBancoCorretoraId($bancoCorretoraId): void
	{
		$this -> bancoCorretoraId = $bancoCorretoraId;
	}

	protected function getSaldo()
	{
		return $this -> saldo;
	}

	protected function setSaldo($valor)
	{
		$this -> saldo = $valor;
	}

	protected function getNome()
	{
		return $this -> nome;
	}

	protected function setNome($nome): void
	{
		$this -> nome = $nome;
	}
}