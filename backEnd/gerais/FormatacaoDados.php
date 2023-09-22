<?php

require_once __DIR__ . "/../verificacoes/VerificarSenha.php";

class FormatacaoDados extends VerificarSenha
{

    public function somenteNumerosPontos($numeros)
    {
        return trim(preg_replace('/[^0-9.,]/', '', $numeros));
    }

    public function somenteNumeros($numeros)
    {
        return trim(preg_replace('/[^0-9]/', '', $numeros));
    }

    public function somenteLetrasAcento($letras): int
    {
        return trim(preg_replace('/[^A-Za-zá-üÁ-Ü]/', '', $letras));
    }

    public function somenteLetras($letras): string
    {
        return trim(preg_replace('/[^A-Za-z]/', '', $letras));
    }

    public function fraseMaiuscula($frase): string
    {
        return trim(ucwords($frase));
    }

    public function fraseMinuscula($frase): string
    {
        return trim(strtolower($frase));
    }

    public function formatarValorDB($valor): float | string
    {
        return str_replace(',',".", $this -> somenteNumerosPontos($valor));
    }

    public function formatarValor($valor): string
    {
        return number_format($valor,2,",",".");
    }
}
