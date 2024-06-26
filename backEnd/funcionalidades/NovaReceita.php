<?php

require_once __DIR__ . "/./NovoDebito.php";

class NovaReceita extends NovoDebito
{
    public function __construct()
    {
        if (!$this-> VerificarLogin()) return false;

        $this -> setPaginaPai($_SESSION['pagina_pai']);
        $this -> setId($this -> id());
		$this-> setNome($this-> nome());
        $this -> setClassificacao($this -> classificacao());
        $this -> setDataCompraPagamento($this -> dataCompraPagamento());
        $this -> setValor($this -> valor());
        $this -> setParcelas($this -> parcelas());

        if (
            !$this -> getId() or
            !$this -> getNome() or
            !$this -> getClassificacao() or
            !$this -> getDataCompraPagamento() or
            !$this -> getValor() or
            !$this -> getParcelas()
        )
            return (bool)$this-> RetornarErro('pai', null);

        if ($this-> getValor() < 0)
            return (bool)$this-> RetornarErro('pai', 'valorAbaixoZero');

        if (!$this -> ObterDadosBancosCorretoras($this -> getId(), $this -> getSessao()))
            return (bool)$this-> RetornarErro('pai', 'naoBancoCorretora');

        if (!$this -> EntradaDadosReceita(
            $this-> getId(),
			$this-> getNome(),
            $this -> getClassificacao(),
            $this -> getDataCompraPagamento(),
            $this -> getValor(),
            $this-> getParcelas()
        ))
            return (bool)$this-> RetornarErro('pai', null);

        return !$this-> RetornarErro('pai', null);
    }
}