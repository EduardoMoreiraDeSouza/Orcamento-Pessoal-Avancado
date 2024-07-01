<?php

require_once __DIR__ . "/../site/RetornarErro.php";

class InformacoesData extends RetornarErro
{
    public function InformacoesData($informacaoEsperada, $data = null)
    {
        if ($data == null)
            $data = date("Y-m-d");

        $dia = substr($data, 8, 5);
        $mes = substr($data, 5, 2);
        $ano = substr($data, 0, 4);

        return match ($informacaoEsperada) {
            'd' => $dia,
            'm' => $mes,
            'y' => $ano,
            default => false
        };
    }

    public function diferencaMesesData($dataInicial, $dataFinal): int
    {

        if ($dataInicial > $dataFinal)
            return false;

        $diaIni = intval(substr($dataInicial, 8, 5));
        $mesIni = intval(substr($dataInicial, 5, 2));
        $anoIni = intval(substr($dataInicial, 0, 4));


        $diaFin = intval(substr($dataFinal, 8, 5));
        $mesFin = intval(substr($dataFinal, 5, 2));
        $anoFin = intval(substr($dataFinal, 0, 4));


        $diasAnos = 0;
        $diasMeses = 0;
        $dias = $diaFin - $diaIni;

        if (gettype($anoIni / 4) == "integer")
            $diasFevereiro = 29;
        else
            $diasFevereiro = 28;

        while ($mesIni != $mesFin or $anoIni != $anoFin) {

            if ($mesIni == 1 or $mesIni == 3 or $mesIni == 5 or $mesIni == 7 or $mesIni == 8 or $mesIni == 10 or $mesIni == 12)
                $diasMeses += 31;

            if ($mesIni == 2)
                $diasMeses += $diasFevereiro;

            if ($mesIni == 4 or $mesIni == 6 or $mesIni == 9 or $mesIni == 11)
                $diasMeses += 30;

            if ($mesIni == 12) {
                $mesIni = 1;
                $anoIni++;
            }
            else
                $mesIni++;
        }

        return round(($diasAnos + $diasMeses + $dias)/30);
    }

    public function ultimoDiaMes($mes, $ano) {

        if (gettype($ano / 4) == "integer")
            $fevereiro = 29;
        else
            $fevereiro = 28;

        if ($mes == '01' or $mes == '03' or $mes == '05' or $mes == '07' or $mes == '08' or $mes == '10' or $mes == '12')
            return 31;

        if ($mes == '02')
            return $fevereiro;

        if ($mes == '04' or $mes == '06' or $mes == '09' or $mes == '11')
            return 30;

        return false;
    }
}