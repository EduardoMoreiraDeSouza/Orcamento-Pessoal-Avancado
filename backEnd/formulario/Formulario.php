<?php

require_once __DIR__ . "/../gerais/ValorFinal.php";

abstract class Formulario extends ValorFinal
{
    private $dados;

    protected function bancoCorretora()
    {
        $this->setDados($this->fraseMaiuscula($this->fraseMinuscula(addslashes($_POST['bancoCorretora']))));

        if ($this->dadosDefinidos())
            return $this->getDados();

        return false;
    }

    protected function cartaoCredito()
    {
        $this->setDados(addslashes($_POST['cartaoCredito']));

        if ($this->dadosDefinidos())
            return $this->getDados();

        return false;
    }

    protected function classificacao()
    {
        $this->setDados(addslashes($_POST['classificacao']));

        if ($this->dadosDefinidos())
            return $this->getDados();

        return false;
    }

    protected function dataCompraPagamento()
    {
        $this->setDados(addslashes($_POST['dataCompraPagamento']));

        if ($this->dadosDefinidos())
            return $this->getDados();

        return false;
    }

    protected function fechamento()
    {
        $this->setDados(addslashes($_POST['fechamento']));

        if ($this->dadosDefinidos())
            return $this->getDados();

        return false;
    }

    protected function vencimento()
    {
        $this->setDados(addslashes($_POST['vencimento']));

        if ($this->dadosDefinidos())
            return $this->getDados();

        return false;
    }

    protected function id()
    {
        $this->setDados($this->somenteNumeros(addslashes($_POST['id'])));

        if ($this->dadosDefinidos())
            return $this->getDados();

        return false;
    }

	protected function bancoCorretoraId()
	{
		$this->setDados($this->fraseMaiuscula($this->fraseMinuscula(addslashes($_POST['bancoCorretoraId']))));

		if ($this->dadosDefinidos())
			return $this->getDados();

		return false;
	}

    protected function valor()
    {
        $this->setDados(addslashes($_POST['valor']));

        if ($this->dadosDefinidos()) {

			$this-> setDados(str_replace('-', '', $this-> getDados()));

			if (!$this-> formatarValorDB($this-> getDados()))
		        return (bool)$this-> RetornarErro('pai', 'valorInvalido');

	        if (str_contains($this->getDados(), '*'))
                $this->setDados(number_format($this->formatarValorDB($this->getDados()) / $this->parcelas(), 2, '.', ''));
			else
				$this-> setDados($this-> formatarValorDB($this->getDados()));

            return $this->getDados();
        }

        return false;
    }

    protected function parcelas()
    {
        $this->setDados(addslashes($_POST['parcelas']));

        if ($this->dadosDefinidos())
            return $this->getDados();

        return false;
    }

    protected function formaPagamento()
    {
        $this->setDados(addslashes($_POST['formaPagamento']));

        if ($this->dadosDefinidos())
            return $this->getDados();

        return false;
    }

    protected function saldo()
    {
        $this->setDados(addslashes($_POST['saldo']));

        if (!$this-> formatarValorDB($this->getDados()))
            return false;

        return $this->formatarValorDB($this->getDados());
    }

    protected function email()
    {
        $this->setDados(addslashes($_POST['email']));

        if ($this->dadosDefinidos())
            return $this->getDados();

        return false;
    }

    protected function senha()
    {
        $this->setDados(addslashes($_POST['senha']));

        if (!$this->dadosDefinidos())
            return false;

        elseif (strlen($this->getDados()) >= 8) {
            $this->setDados(hash('sha256', $this->getDados()));
            return $this->getDados();
        }

        return (bool)$this-> RetornarErro('pai', 'senhaPequena');
    }

    protected function confirmarSenha()
    {
        $this->setDados(addslashes($_POST['confirmarSenha']));

        if (!$this->dadosDefinidos())
            return false;

        elseif (strlen($this->getDados()) >= 8) {
            $this->setDados(hash('sha256', $this->getDados()));

            if ($this->getDados() != $this->senha())
                return (bool)$this-> RetornarErro('pai', 'confirmarSenhaErro');

            return $this->getDados();
        }

        return (bool)$this-> RetornarErro('pai', 'senhaPequena');
    }


    private function dadosDefinidos()
    {
        if (!$this->getDados() or empty($this->getDados())) {
            $this->setDados(null);

            return (bool)$this->RetornarErro('pai', 'vazio');
        }

        return true;
    }

    private function getDados()
    {
        return $this->dados;
    }

    private function setDados($dados): void
    {
        $this->dados = $dados;
    }

}
