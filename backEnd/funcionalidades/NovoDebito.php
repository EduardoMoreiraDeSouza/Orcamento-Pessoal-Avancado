<?php

require_once __DIR__ . "/../funcionalidades/EditarBancoCorretora.php";

class NovoDebito extends EditarBancoCorretora
{
	private $classificacao;
	private $dataCompraPagamento;
	private $valor;
	private $parcelas;

	public function __construct()
	{
		if (!$this -> VerificarLogin())
			return false;

		$this -> setPaginaPai($_SESSION['pagina_pai']);
		$this -> setId($this -> id());
		$this -> setClassificacao($this -> classificacao());
		$this -> setDataCompraPagamento($this -> dataCompraPagamento());
		$this -> setValor($this -> valor());
		$this -> setParcelas($this -> parcelas());

		if (
			!$this -> getId() or
			!$this -> getClassificacao() or
			!$this -> getDataCompraPagamento() or
			!$this -> getValor() or
			!$this -> getParcelas()
		)
			return (bool) $this -> RetornarErro('pai', null);

		if ($this -> getValor() < 0)
			$this -> setValor($this -> getValor() * -1);

		if (!$this -> ObterDadosBancosCorretoras($this -> getId(), $this -> getSessao()))
			return (bool) $this -> RetornarErro('pai', 'naoBancoCorretora');

		if (
			!$this -> EntradaDadosGastos(
				$this -> getId(),
				'Débito',
				$this -> getClassificacao(),
				$this -> getDataCompraPagamento(),
				$this -> getValor(),
				$this -> getParcelas()
			)
		)
			return (bool) $this -> RetornarErro('pai', null);

		return !$this -> RetornarErro('pai', null);
	}

	protected function getClassificacao()
	{
		return $this -> classificacao;
	}

	protected function setClassificacao($classificacao)
	{
		$this -> classificacao = $classificacao;
	}

	protected function getDataCompraPagamento()
	{
		return $this -> dataCompraPagamento;
	}

	protected function setDataCompraPagamento($dataCompraPagamento)
	{
		$this -> dataCompraPagamento = $dataCompraPagamento;
	}

	protected function getValor()
	{
		return $this -> valor;
	}

	protected function setValor($valor)
	{
		$this -> valor = $valor;
	}

	protected function getParcelas()
	{
		return $this -> parcelas;
	}

	protected function setParcelas($parcelas)
	{
		$this -> parcelas = $parcelas;
	}

}