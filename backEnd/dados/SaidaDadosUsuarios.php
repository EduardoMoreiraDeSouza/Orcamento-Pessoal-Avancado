<?php

require_once __DIR__ . "/../bancoDados/ExecucaoCodigoMySql.php";

abstract class SaidaDadosUsuarios extends ExecucaoCodigoMySql
{
    private $execucaoMySqlUsuarios;
    private $dadosUsuarios;

    protected function SaidaDadosUsuarios($email)
    {
        $this -> setCodigoMySql("SELECT * FROM dbName.usuarios WHERE email LIKE '$email';");
        $this -> setExecucaoMySqlUsuarios($this -> ExecutarCodigoMySql());

        if (!$this -> getExecucaoMySqlUsuarios())
            return false;

        $this -> setDadosUsuarios(mysqli_fetch_assoc($this -> getExecucaoMySqlUsuarios()));
        if (!empty($this -> getDadosUsuarios()))
            return $this -> getDadosUsuarios();

        return false;
    }


    private function getDadosUsuarios()
    {
        return $this -> dadosUsuarios;
    }

    private function setDadosUsuarios($dadosUsuarios): void
    {
        $this -> dadosUsuarios = $dadosUsuarios;
    }

    private function getExecucaoMySqlUsuarios()
    {
        return $this -> execucaoMySqlUsuarios;
    }

    private function setExecucaoMySqlUsuarios($execucaoMySqlUsuarios): void
    {
        $this -> execucaoMySqlUsuarios = $execucaoMySqlUsuarios;
    }
}
