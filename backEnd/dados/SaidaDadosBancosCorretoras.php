<?php

require_once __DIR__ . "/./EntradaDadosUsuarios.php";

class SaidaDadosBancosCorretoras extends EntradaDadosUsuarios
{

    private $execucaoMySqlBancosCorretoras;
    private $dadosBancosCorretoras;

    public function SaidaDadosBancosCorretoras($nome, $cpf)
    {

        $this-> gerarCodigoMySql($nome, $cpf);
        $this -> setExecucaoMySqlBancosCorretoras($this -> ExecutarCodigoMySql());

        if (!$this -> getExecucaoMySqlBancosCorretoras())
            return false;

        $this -> setDadosBancosCorretoras(mysqli_fetch_assoc($this -> getExecucaoMySqlBancosCorretoras()));
        if (!empty($this -> getDadosBancosCorretoras()))
            return $this -> getDadosBancosCorretoras();

        return false;
    }

    private function gerarCodigoMySql($nome, $cpf)
    {

        $dbName = $this-> Servidor('DBname');

        $codigo = "SELECT * FROM $dbName.bancosCorretoras WHERE";

        if ($nome == null and $cpf == null)
            return false;
        elseif ($nome != null and $cpf != null)
            $codigoVariante = "nome LIKE '$nome' AND cpf LIKE 'cpf';";
        elseif ($nome != null and $cpf == null)
            $codigoVariante = "nome LIKE '$nome';";
        elseif ($nome == null and $cpf != null)
            $codigoVariante = "cpf LIKE '$cpf';";

        $this-> setCodigoMySql($codigo . $codigoVariante);
        return true;

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