<?php

require_once __DIR__ . "/./Comunicar.php";

class Redirecionar extends Comunicar
{

    public function Redirecionar($local, $subpasta = null)
    {

        if ($subpasta == true)
            $caminho = "..";
        else
            $caminho = "../..";


        if ($local == 'inicio')
            $this -> ScriptJS("window.location.href = `$caminho/`");

        else
            $this -> ScriptJS("window.location.href = `$caminho/paginas/$local.php`");

        return true;

    }

}