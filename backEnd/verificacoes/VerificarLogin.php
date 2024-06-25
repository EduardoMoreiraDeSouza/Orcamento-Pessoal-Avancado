<?php

require_once __DIR__ . "/../gerais/InformacoesData.php";

class VerificarLogin extends InformacoesData {

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
