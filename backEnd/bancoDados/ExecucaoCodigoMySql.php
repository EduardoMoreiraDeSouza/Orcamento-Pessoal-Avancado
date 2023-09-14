<?php

require_once __DIR__ . "/./ConexaoDB.php";

class ExecucaoCodigoMySql extends ConexaoDB
{
    private $execucaoCodigoMySql;

    protected function ExecutarCodigoMySql()
    {

        $this -> setExecucaoCodigoMySql(mysqli_query($this -> ConexaoDB(), $this -> getCodigoMySql()));

        if (!$this -> getExecucaoCodigoMySql()) {

            $this -> setCodigoMySql(null);
            $this -> Comunicar('erroSql');
            return false;

        }

        else {

            $this -> setCodigoMySql(null);
            return $this -> getExecucaoCodigoMySql();

        }
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