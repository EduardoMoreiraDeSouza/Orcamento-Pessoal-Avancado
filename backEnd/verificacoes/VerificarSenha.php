<?php

require_once __DIR__ . "/../dados/EntradaReceita.php";

class VerificarSenha extends EntradaReceita
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