<?php

require_once __DIR__ . "/../site/RetornarErro.php";

class VerificarLogin extends RetornarErro {

    public function VerificarLogin()
    {
        if (empty($this -> getSessao())) {

            $this -> Comunicar('entrar');
            $this -> Redirecionar('entrar', true);

            return false;
        }

        return true;
    }
}
