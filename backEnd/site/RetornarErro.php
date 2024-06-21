<?php

require_once __DIR__ . "/./Redirecionar.php";

abstract class RetornarErro extends Redirecionar
{
    protected function RetornarErro($redirecionar, $mensagem): false
    {
        if ($mensagem != null and !empty($mensagem)) $this -> Comunicar($mensagem);

        if ($redirecionar != null) $this -> Redirecionar($redirecionar);

        return false;
    }
}