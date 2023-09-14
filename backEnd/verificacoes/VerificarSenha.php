<?php

require_once __DIR__ . "/../dados/EntradaDadosUsuarios.php";

class VerificarSenha extends EntradaDadosUsuarios
{

    protected function VerificarSenha($cpf, $senha): bool
    {

        if (
            $this -> SaidaDadosUsuarios($cpf) and
            $this -> SaidaDadosUsuarios($cpf)['senha'] == $senha
        ) return true;

        $this -> Comunicar('senha');
        return false;
    }
}