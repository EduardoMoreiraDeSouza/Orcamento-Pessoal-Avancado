<?php

require_once __DIR__ . "/./EntradaDadosUsuarios.php";

abstract class SaidaDadosBancosCorretoras extends EntradaDadosUsuarios
{

    private $execucaoMySql;
    private $dados;

    public function SaidaDadosBancosCorretoras($nome, $email)
    {

        $this-> gerarCodigoMySql($nome, $email);
        $this -> setExecucaoMySql($this -> ExecutarCodigoMySql());

        if (!$this -> getExecucaoMySql())
            return false;

        $this -> setDados(mysqli_fetch_assoc($this -> getExecucaoMySql()));

        return !empty($this->getDados()) ? $this->getDados() : false;

    }

    private function gerarCodigoMySql($nome, $email)
    {

        $dbName = $this-> Servidor('DBname');

        $codigo = "SELECT * FROM $dbName.bancosCorretoras WHERE ";

        if ($nome == null and $email == null)
            return false;
        elseif ($nome != null and $email != null)
            $codigoVariante = "nome LIKE '$nome' AND email LIKE '$email';";
        elseif ($nome != null and $email == null)
            $codigoVariante = "nome LIKE '$nome';";
        elseif ($nome == null and $email != null)
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