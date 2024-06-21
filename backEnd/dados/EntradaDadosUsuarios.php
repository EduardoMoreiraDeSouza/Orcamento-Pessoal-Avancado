<?php

require_once __DIR__ . "/./ObterDadosUsuarios.php";

abstract class EntradaDadosUsuarios extends ObterDadosUsuarios
{
    protected function EntradaDadosUsuario($email, $senha)
    {
        $this -> setCodigoMySql("INSERT INTO dbName.usuarios VALUES ('$email', '$senha');");

        return (bool)$this-> ExecutarCodigoMySql();
    }
}