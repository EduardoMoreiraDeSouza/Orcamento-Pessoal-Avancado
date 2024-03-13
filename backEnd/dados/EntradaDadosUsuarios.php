<?php

require_once __DIR__ . "/./SaidaDadosUsuarios.php";

class EntradaDadosUsuarios extends SaidaDadosUsuarios
{

    protected function EntradaDadosUsuario($cpf, $senha)
    {

        $this -> setCodigoMySql("INSERT INTO orcamentoPessoal.usuarios('cpf', 'senha') VALUES ('$cpf', '$senha');");

        if (!$this -> ExecutarCodigoMySql()) {
            $this -> Comunicar('erroSql');
            return false;
        }

        return true;
    }
}