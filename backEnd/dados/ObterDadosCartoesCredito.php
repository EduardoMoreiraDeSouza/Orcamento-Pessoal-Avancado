<?php

require_once __DIR__ . "/./AlterarDadosBancosCorretoras.php";

class ObterDadosCartoesCredito extends AlterarDadosBancosCorretoras
{
    private $dados;

    public function ObterDadosCartoesCredito($id, $email)
    {
        if ($id == null and $email == null)
            return false;

        $this -> gerarCodigoMySql($id, $email);
        $this -> setDados($this -> CarregarResultadosMySql());

        return !empty($this -> getDados()) ? $this -> getDados() : false;
    }

    private function gerarCodigoMySql($id, $email): void
    {
        $codigo = "SELECT * FROM dbName.cartoesCredito WHERE ";

        if ($id != null and $email != null)
            $codigoVariante = "id_bancoCorretora LIKE '$id' AND email LIKE '$email';";
        elseif ($id != null and $email == null)
            $codigoVariante = "id_bancoCorretora LIKE '$id';";
        elseif ($id == null and $email != null)
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