<?php

require_once __DIR__ . "/./EditarDadosCartoesCredito.php";

class SaidaDadosGastos extends EditarDadosCartoesCredito
{
    private $execucaoMySql;
    private $dados;

    public function SaidaDadosGastos($email)
    {

        $this-> gerarCodigoMySql($email);
        $this -> setExecucaoMySql($this -> ExecutarCodigoMySql());

        if (!$this -> getExecucaoMySql())
            return false;

        $this -> setDados(mysqli_fetch_assoc($this -> getExecucaoMySql()));

        return !empty($this->getDados()) ? $this->getDados() : false;

    }

    private function gerarCodigoMySql($email)
    {
        $codigo = "SELECT * FROM dbName.gastos WHERE ";

        if ($email == null)
            return false;
        else
            $codigoVariante = "email LIKE '$email';";

        $this-> setCodigoMySql($codigo . $codigoVariante);
        return true;
    }

    private function getDados()
    {
        return $this -> dados;
    }

    private function setDados($dados): void
    {
        $this -> dados = $dados;
    }

    private function getExecucaoMySql()
    {
        return $this -> execucaoMySql;
    }

    private function setExecucaoMySql($execucaoMySql): void
    {
        $this -> execucaoMySql = $execucaoMySql;
    }

}