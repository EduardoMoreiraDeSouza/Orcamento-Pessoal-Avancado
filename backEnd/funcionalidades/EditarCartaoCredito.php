<?php

require_once __DIR__ . "/./EditarBancoCorretora.php";

class EditarCartaoCredito extends EditarBancoCorretora
{
	public function __construct()
	{
		if (!$this -> VerificarLogin()) return false;

		$this -> setPaginaPai($_SESSION['pagina_pai']);
		$this -> setId($this -> id());
		$this -> setLimite($this -> valor());
		$this -> setFechamento($this -> fechamento());
		$this -> setVencimento($this -> vencimento());

		if (
			!$this -> getId() or
			!$this -> getLimite() or
			!$this -> getFechamento() or
			!$this -> getVencimento()
		)
			return (bool) $this -> RetornarErro('pai', null);

		elseif ($this -> getFechamento() == $this -> getVencimento())
			return (bool) $this -> RetornarErro('pai', 'fechamentoVencimento');

		elseif (($this -> ObterDadosCartoesCredito($this -> getId(), $this -> getSessao())['limite'] - floatval($this -> ValorFinal('cartaoCredito', $this -> getId()))) > $this -> getLimite())
			return (bool) $this -> RetornarErro('pai', 'novoLimiteMenor');

		elseif (
			!$this -> AlterarDadosCartoesCredito(
				$this -> getId(),
				$this -> getLimite(),
				$this -> getFechamento(),
				$this -> getVencimento()
			)
		)
			return (bool) $this -> RetornarErro('pai', null);

		return !$this -> RetornarErro('pai', null);
	}

}