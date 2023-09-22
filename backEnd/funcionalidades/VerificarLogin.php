<?php

require_once __DIR__ . "/../site/Redirecionar.php";

class VerificarLogin extends Redirecionar {

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
