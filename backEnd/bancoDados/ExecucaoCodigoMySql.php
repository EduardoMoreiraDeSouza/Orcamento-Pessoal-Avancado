<?php

require_once __DIR__ . "/./ConexaoDB.php";

class ExecucaoCodigoMySql extends ConexaoDB
{
    private $execucaoCodigoMySql;
    private $codigoMySql;

    public function ExecutarCodigoMySql()
    {
        $this -> setExecucaoCodigoMySql(mysqli_query($this -> ConexaoDB(), $this -> getCodigoMySql()));

        if (!$this -> getExecucaoCodigoMySql()) {
            $this -> setCodigoMySql(null);
            $this -> Comunicar('erroSql');
            return false;
        }

        $this -> setCodigoMySql(null);
        return $this -> getExecucaoCodigoMySql();
    }

    public function getCodigoMySql()
    {
        return $this -> codigoMySql;
    }

    public function setCodigoMySql($codigoMySql): void
    {
        $this -> codigoMySql = str_replace('dbName', $this -> Servidor('dbName'), $codigoMySql);
    }

    private function getExecucaoCodigoMySql()
    {
        return $this -> execucaoCodigoMySql;
    }

    private function setExecucaoCodigoMySql($execucaoCodigoMySql): void
    {
        $this -> execucaoCodigoMySql = $execucaoCodigoMySql;
    }

}