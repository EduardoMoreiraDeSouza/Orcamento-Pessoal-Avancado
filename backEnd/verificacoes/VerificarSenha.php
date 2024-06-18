<?php

require_once __DIR__ . "/../dados/EntradaDadosReceita.php";

class VerificarSenha extends EntradaDadosReceita
{
    public function VerificarSenha($email, $senha): bool
    {
        if (
            $this -> SaidaDadosUsuarios($email) and
            $this -> SaidaDadosUsuarios($email)['senha'] == $senha
        ) return true;

        $this -> Comunicar('senha');
        return false;
    }
}