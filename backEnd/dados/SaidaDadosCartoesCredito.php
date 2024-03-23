<?php

require_once __DIR__ . "/./EditarDadosBancosCorretoras.php";

abstract class SaidaDadosCartoesCredito extends EditarDadosBancosCorretoras
{

    private $execucaoMySql;
    private $dados;

    public function SaidaDadosCartoesCredito($nome, $cpf)
    {

        $this-> gerarCodigoMySql($nome, $cpf);
        $this -> setExecucaoMySql($this -> ExecutarCodigoMySql());

        if (!$this -> getExecucaoMySql())
            return false;

        $this -> setDados(mysqli_fetch_assoc($this -> getExecucaoMySql()));

        return !empty($this->getDados()) ? $this->getDados() : false;

    }

    private function gerarCodigoMySql($nome, $cpf)
    {

        $dbName = $this-> Servidor('DBname');

        $codigo = "SELECT * FROM $dbName.cartoesCredito WHERE ";

        if ($nome == null and $cpf == null)
            return false;
        elseif ($nome != null and $cpf != null)
            $codigoVariante = "nome LIKE '$nome' AND cpf LIKE '$cpf';";
        elseif ($nome != null and $cpf == null)
            $codigoVariante = "nome LIKE '$nome';";
        elseif ($nome == null and $cpf != null)
            $codigoVariante = "cpf LIKE '$cpf';";

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