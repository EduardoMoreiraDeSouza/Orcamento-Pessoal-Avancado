<?php

require_once __DIR__ . "/./SaidaDadosUsuarios.php";

abstract class EntradaDadosUsuarios extends SaidaDadosUsuarios
{
    protected function EntradaDadosUsuario($email, $senha)
    {

        $dbName = $this-> Servidor('DBname');
        $this -> setCodigoMySql("INSERT INTO $dbName.usuarios VALUES ('$email', '$senha');");

        if (!$this -> ExecutarCodigoMySql()) {
            $this -> Comunicar('erroSql');
            return false;
        }

        return true;
    }
}