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

        elseif (!$this -> ObterDadosUsuarios($email))
            return (bool)$this-> RetornarErro('pai', 'cadastrar');

        $this -> Comunicar('senha');
        return false;
    }
}