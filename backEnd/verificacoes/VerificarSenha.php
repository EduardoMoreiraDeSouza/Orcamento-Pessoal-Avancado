<?php

require_once __DIR__ . "/../dados/EntradaGastos.php";

class VerificarSenha extends EntradaGastos
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