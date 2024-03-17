<?php

require_once __DIR__ . "/./SaidaDadosUsuarios.php";

abstract class EntradaDadosUsuarios extends SaidaDadosUsuarios
{
    protected function EntradaDadosUsuario($cpf, $senha)
    {

        $dbName = $this-> Servidor('DBname');
        $this -> setCodigoMySql("INSERT INTO $dbName.usuarios VALUES ('$cpf', '$senha');");

        if (!$this -> ExecutarCodigoMySql()) {
            $this -> Comunicar('erroSql');
            return false;
        }

        return true;
    }
}