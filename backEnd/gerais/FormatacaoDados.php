<?php

require_once __DIR__ . "/../verificacoes/VerificarSenha.php";

class FormatacaoDados extends VerificarSenha
{

    protected function somenteNumeros($numeros): int
    {
        return trim(preg_replace('/[^0-9]/', '', $numeros));
    }

    protected function somenteLetrasAcento($letras): int
    {
        return trim(preg_replace('/[^A-Za-zá-üÁ-Ü]/', '', $letras));
    }

    protected function somenteLetras($letras): string
    {
        return trim(preg_replace('/[^A-Za-z]/', '', $letras));
    }

    protected function fraseMaiuscula($frase): string
    {
        return trim(ucwords($frase));
    }

    protected function fraseMinuscula($frase): string
    {
        return trim(strtolower($frase));
    }

    protected function formatarValorDB($valor): float
    {
        return number_format($valor,2,".","");
    }

    protected function formatarValor($valor): float
    {
        return number_format($valor,2,",",".");
    }
}
