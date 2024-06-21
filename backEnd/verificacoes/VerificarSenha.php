<?php

require_once __DIR__ . "/../dados/EntradaDadosReceita.php";

class VerificarSenha extends EntradaDadosReceita
{
    public function VerificarSenha($email, $senha): bool
    {
        if (
            $this -> ObterDadosUsuarios($email) and
            $this -> ObterDadosUsuarios($email)['senha'] == $senha
        ) return true;

        $this -> Comunicar('senha');
        return false;
    }
}