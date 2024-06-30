<?php

require_once __DIR__ . "/./AlterarDadosCartoesCredito.php";

class ObterDadosGastos extends AlterarDadosCartoesCredito
{
    private $dados;

    public function ObterDadosGastos($email, $id = null, $bancoCorretora = null)
    {
	    $this -> gerarCodigoMySql($email, $id, $bancoCorretora);

        $this -> setDados($this -> CarregarResultadosMySql(true));

        return !empty($this -> getDados()) ? $this -> getDados() : false;
    }

	private function gerarCodigoMySql($email, $id, $bancoCorretora): void
	{
		$codigo = "SELECT * FROM dbName.gastos WHERE ";

		if ($id != null and $bancoCorretora != null and $email != null)
			$codigoVariante = "id LIKE '$id' AND bancoCorretora LIKE '$bancoCorretora' AND email LIKE '$email';";
		elseif ($id != null and $bancoCorretora == null and $email == null)
			$codigoVariante = "id LIKE '$id';";
		elseif ($id == null and $bancoCorretora != null and $email == null)
			$codigoVariante = "bancoCorretora LIKE '$bancoCorretora';";
		elseif ($id == null and $bancoCorretora == null and $email != null)
			$codigoVariante = "email LIKE '$email';";
		elseif ($id != null and $bancoCorretora != null and $email == null)
			$codigoVariante = "id LIKE '$id' AND bancoCorretora LIKE '$bancoCorretora';";
		elseif ($id != null and $bancoCorretora == null and $email != null)
			$codigoVariante = "id LIKE '$id' AND email LIKE '$email';";
		elseif ($id == null and $bancoCorretora != null and $email != null)
			$codigoVariante = "bancoCorretora LIKE '$bancoCorretora' AND email LIKE '$email';";

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