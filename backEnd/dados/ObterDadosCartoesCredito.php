<?php

require_once __DIR__ . "/./AlterarDadosBancosCorretoras.php";

abstract class ObterDadosCartoesCredito extends AlterarDadosBancosCorretoras
{
    private $dados;

    public function ObterDadosCartoesCredito($nome, $email)
    {
        if ($nome == null and $email == null)
            return false;

        $this -> gerarCodigoMySql($nome, $email);
        $this -> setDados($this -> CarregarResultadosMySql());

        return !empty($this -> getDados()) ? $this -> getDados() : false;
    }

    private function gerarCodigoMySql($nome, $email): void
    {
        $codigo = "SELECT * FROM dbName.cartoesCredito WHERE ";

        if ($nome != null and $email != null)
            $codigoVariante = "nome LIKE '$nome' AND email LIKE '$email';";
        elseif ($nome != null and $email == null)
            $codigoVariante = "nome LIKE '$nome';";
        elseif ($nome == null and $email != null)
            $codigoVariante = "email LIKE '$email';";

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