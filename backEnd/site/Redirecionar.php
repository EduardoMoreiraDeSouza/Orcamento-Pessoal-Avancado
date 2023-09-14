<?php

require_once __DIR__ . "/./Comunicar.php";

class Redirecionar extends Comunicar
{

    protected function Redirecionar($local)
    {

        if ($local == 'inicio')
            $this -> ScriptJS("window.location.href = `../../`");

        else
            $this -> ScriptJS("window.location.href = `../../paginas/$local.php`");

        return true;

    }

}