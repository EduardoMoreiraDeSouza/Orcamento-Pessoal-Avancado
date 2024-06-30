<?php

require_once __DIR__ . "/./NovoDebito.php";

class NovoCredito extends NovoDebito
{
    public function __construct()
    {
        if (!$this -> VerificarLogin()) return false;

        $this -> setPaginaPai('gastos');
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
            return (bool)$this -> RetornarErro('pai', null);

        if (!$this -> ObterDadosCartoesCredito($this -> getId(), $this -> getSessao()))
            return (bool)$this -> RetornarErro('pai', 'naoBancoCorretora');

        if ($this-> getValor() < 0)
            $this-> setValor($this-> getValor() * -1);

        $this -> timezone();

        if ($this -> ValorFinal('cartaoCredito', $this -> getId()) < $this-> getValor() * $this-> getParcelas())
            return (bool)$this -> RetornarErro('pai', 'limiteInsuficiente');

        if (!$this -> EntradaDadosGastos(
			$this-> getId(),
	        $this-> ObterDadosBancosCorretoras($this-> getId(), $this-> getSessao())[0]['bancoCorretora'],
            'Crédito',
            $this -> getClassificacao(),
            $this -> getDataCompraPagamento(),
            $this -> getValor(),
            $this -> getParcelas()
        )
        )
            return (bool)$this -> RetornarErro('pai', null);

        return !$this -> RetornarErro('pai', null);
    }
}