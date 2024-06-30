<?php

require_once __DIR__ . "/./AlterarDadosCartoesCredito.php";

class ObterDadosGastos extends AlterarDadosCartoesCredito
{
    private $dados;

    public function ObterDadosGastos($email, $id = null)
    {
	    $this -> gerarCodigoMySql($email, $id);

        $this -> setDados($this -> CarregarResultadosMySql(true));

        return !empty($this -> getDados()) ? $this -> getDados() : false;
    }

	private function gerarCodigoMySql($email, $id): void
	{
		$codigo = "SELECT * FROM dbName.gastos WHERE ";

		if ($id != null and $email == null)
			$codigoVariante = "id_gasto LIKE '$id';";
		elseif ($id == null and $email != null)
			$codigoVariante = "email LIKE '$email';";
		elseif ($id != null and $email != null)
			$codigoVariante = "id_gasto LIKE '$id' AND email LIKE '$email';";

		$this -> setCodigoMySql($codigo . $codigoVariante);
	}

    private function getDados()
    {
        return $this -> dados;
    }

    private function setDados($dados): void
    {
        $this -> dados = $dados;
    }
}