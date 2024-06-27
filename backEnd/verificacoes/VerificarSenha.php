<?php

require_once __DIR__ . "/../dados/AlterarDadosReceita.php";

class VerificarSenha extends AlterarDadosReceita
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