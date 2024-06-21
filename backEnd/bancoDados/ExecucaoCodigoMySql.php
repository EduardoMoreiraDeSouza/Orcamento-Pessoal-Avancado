<?php

require_once __DIR__ . "/./ConexaoDB.php";

class ExecucaoCodigoMySql extends ConexaoDB
{
    private $executar;
    private $codigoMySql;

    public function ExecutarCodigoMySql()
    {
        $this -> setExecutar($this-> executar());
        $this -> setCodigoMySql(null);

        if (!$this -> getExecutar())
            return (bool)$this-> RetornarErro('inicio', 'erroSql');

        return $this -> getExecutar();
    }

    private function executar()
    {
        if (!empty($this-> getCodigoMySql()))
            return mysqli_query($this -> ConexaoDB(), $this -> getCodigoMySql());

        return false;
    }

    public function getCodigoMySql()
    {
        return $this -> codigoMySql;
    }

    public function setCodigoMySql($codigoMySql): void
    {
        $this -> codigoMySql = str_replace('dbName', $this -> Servidor('dbName'), $codigoMySql);
    }

    private function getExecutar()
    {
        return $this -> executar;
    }

    private function setExecutar($executar): void
    {
        $this -> executar = $executar;
    }

}