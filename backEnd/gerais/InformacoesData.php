<?php

require_once __DIR__ . "/../site/RetornarErro.php";

class InformacoesData extends RetornarErro
{
    public function InformacoesData($informacaoEsperada, $data = null)
    {
        $this-> timezone();

        if ($data == null)
            $data = date("Y-m-d");

        $dia = intval(substr($data, 8, 5));
        $mes = intval(substr($data, 5, 2));
        $ano = intval(substr($data, 0, 4));

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

        while ($anoIni != $anoFin) {

            if (gettype($anoIni / 4) == "integer")
                $diasAnos += 366;
            else
                $diasAnos += 365;

            $anoIni++;

        }

        while ($mesIni != $mesFin) {

            if ($mesIni == 1 or $mesIni == 3 or $mesIni == 5 or $mesIni == 7 or $mesIni == 8 or $mesIni == 10 or $mesIni == 12)
                $diasMeses += 31;

            if ($mesIni == 2)
                $diasMeses += 28;

            if ($mesIni == 4 or $mesIni == 6 or $mesIni == 9 or $mesIni == 11)
                $diasMeses += 30;

            if ($mesIni == 12)
                $mesIni = 1;
            else
                $mesIni++;

        }

        return intval(($diasAnos + $diasMeses + $dias)/30);
    }
}