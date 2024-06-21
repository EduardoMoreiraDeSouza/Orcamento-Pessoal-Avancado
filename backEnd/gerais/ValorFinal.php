<?php

require_once __DIR__ . "/./FormatacaoDados.php";

class ValorFinal extends FormatacaoDados
{
    public function ValorFinal($tipo, $entidade, $email) {

        date_default_timezone_set('America/Sao_Paulo');

        if ($tipo == 'cartaoCredito') {

            $limiteTotal = $this-> ObterDadosCartoesCredito($entidade, $email)['limite'];
            $gastosCreditoTotal = 0;

            foreach ($this-> ObterDadosGastos($email) as $gasto) {
                if ($gasto['formaPagamento'] == 'Crédito')
                    $gastosCreditoTotal += $gasto['valor'] * $gasto['parcelas'];
            }

            return $limiteTotal - $gastosCreditoTotal;

        }

        elseif ($tipo == 'bancoCorretora') {

            $saldo = $this-> ObterDadosBancosCorretoras($entidade, $email)['saldo'];
            $gastosDebitoTotal = 0;

            foreach ($this-> ObterDadosGastos($email) as $gasto) {
                if ($gasto['formaPagamento'] == 'Débito')
                    $gastosDebitoTotal += $gasto['valor'];
            }

            return $saldo - $gastosDebitoTotal;

        }

        return false;
    }
}