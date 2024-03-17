<?php

require_once __DIR__ . "/../dados/EntradaDadosReceita.php";

class VerificarSenha extends EntradaDadosReceita
{

    public function VerificarSenha($cpf, $senha): bool
    {

        if (
            $this -> SaidaDadosUsuarios($cpf) and
            $this -> SaidaDadosUsuarios($cpf)['senha'] == $senha
        ) return true;

        $this -> Comunicar('senha');
        return false;
    }
}