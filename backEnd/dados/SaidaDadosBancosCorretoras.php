<?php

require_once __DIR__ . "/./EntradaDadosUsuarios.php";

class SaidaDadosBancosCorretoras extends EntradaDadosUsuarios
{

    private $execucaoMySqlBancosCorretoras;
    private $dadosBancosCorretoras;

    protected function SaidaDadosBancosCorretoras($nome, $cpf)
    {

        $dbName = $this-> Servidor('DBname');
        $this -> setCodigoMySql("SELECT * FROM $dbName.bancoscorretoras WHERE nome LIKE '$nome' AND cpf LIKE '$cpf';");
        $this -> setExecucaoMySqlBancosCorretoras($this -> ExecutarCodigoMySql());

        if (!$this -> getExecucaoMySqlBancosCorretoras())
            return false;

        $this -> setDadosBancosCorretoras(mysqli_fetch_assoc($this -> getExecucaoMySqlBancosCorretoras()));
        if (!empty($this -> getDadosBancosCorretoras()))
            return $this -> getDadosBancosCorretoras();

        return false;
    }


    private function getDadosBancosCorretoras()
    {
        return $this -> dadosBancosCorretoras;
    }

    private function setDadosBancosCorretoras($dadosBancosCorretoras): void
    {
        $this -> dadosBancosCorretoras = $dadosBancosCorretoras;
    }

    private function getExecucaoMySqlBancosCorretoras()
    {
        return $this -> execucaoMySqlBancosCorretoras;
    }

    private function setExecucaoMySqlBancosCorretoras($execucaoMySqlBancosCorretoras): void
    {
        $this -> execucaoMySqlBancosCorretoras = $execucaoMySqlBancosCorretoras;
    }
}