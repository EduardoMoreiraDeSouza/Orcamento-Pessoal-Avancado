<?php

require_once __DIR__ . "/./FormatacaoDados.php";

class ValorFinal extends FormatacaoDados
{
    public function ValorFinal($tipo, $entidade)
    {

        $this -> timezone();

        if ($tipo == 'cartaoCredito') {

            $limiteTotal = $this -> ObterDadosCartoesCredito($entidade, $this -> getSessao())['limite'];
            $gastosCreditoTotal = 0;
            $gastos = $this -> ObterDadosGastos($this -> getSessao());
            $gastoAtual = 0;

            if ($gastos)
                foreach ($gastos as $ignored) {
                    if ($gastos[$gastoAtual]['fiador'] == $entidade)
                        if ($gastos[$gastoAtual]['formaPagamento'] == 'Crédito')
                            $gastosCreditoTotal += $gastos[$gastoAtual]['valor'] * $this -> parcelasRestantesCredito($gastos[$gastoAtual]);
                    $gastoAtual++;
                }

            return $limiteTotal - $gastosCreditoTotal;
        }

        elseif ($tipo == 'bancoCorretora') {

            $gastosDebitoTotal = 0;
            $gastos = $this -> ObterDadosGastos($this -> getSessao());
            $gastoAtual = 0;

            if ($gastos)
                foreach ($gastos as $ignored) {
                    if ($gastos[$gastoAtual]['fiador'] == $entidade)
                        if ($gastos[$gastoAtual]['formaPagamento'] == 'Débito')
                            $gastosDebitoTotal += $gastos[$gastoAtual]['valor'] * $this -> parcelasDebitadas($gastos[$gastoAtual]);
                    $gastoAtual++;
                }

            $receitaTotal = 0;
            $receita = $this -> ObterDadosReceita($this -> getSessao());
            $receitaAtual = 0;

            if ($receita)
                foreach ($receita as $ignored) {
                    if ($receita[$receitaAtual]['bancoCorretora'] == $entidade)
                        $receitaTotal += $receita[$receitaAtual]['valor'] * $this-> parcelasRecebidas($receita[$receitaAtual]);

                    $receitaAtual++;
                }

            return $receitaTotal - $gastosDebitoTotal;
        }

        return false;
    }

    protected function parcelasRestantesCredito($gasto)
    {
        $parcelasTotais = $gasto['parcelas'];
        $primeiroMesPagamento = intval($this -> InformacoesData('m', $gasto['dataCompraPagamento']));
        $dadosCartao = $this -> ObterDadosCartoesCredito($gasto['fiador'], $this -> getSessao());
        $primeiroAnoPagamento = intval($this -> InformacoesData('y', $gasto['dataCompraPagamento']));

        if ($this -> InformacoesData('d', $gasto['dataCompraPagamento']) >= $dadosCartao['fechamento']) {
            if ($dadosCartao['vencimento'] < $dadosCartao['fechamento'])
                $primeiroMesPagamento += 2;
            else
                $primeiroMesPagamento ++;

            if ($primeiroMesPagamento > 12) {
                $primeiroMesPagamento = $primeiroMesPagamento - 12;
                $primeiroAnoPagamento ++;

                if (gettype($primeiroAnoPagamento / 4) == "integer")
                    $diasFevereiro = 29;
                else
                    $diasFevereiro = 28;

                if ($primeiroMesPagamento == 2 and intval($this -> InformacoesData('y', $gasto['dataCompraPagamento'])) > $diasFevereiro)
                    $primeiroMesPagamento++;
            }

        }

        if ($primeiroMesPagamento < 10)
            $primeiroMesPagamento = "0" . $primeiroMesPagamento;

        if ($dadosCartao['vencimento'] < 10)
            $dadosCartao['vencimento'] = "0" . $dadosCartao['vencimento'];

        $primeiraDataPagamento = $primeiroAnoPagamento . '-' . $primeiroMesPagamento . '-' . $dadosCartao['vencimento'];
        $diferencaMeses = $this -> diferencaMesesData($primeiraDataPagamento, date('Y-m-d'));

        if ($diferencaMeses)
            if ($parcelasTotais - $diferencaMeses > 0)
                return $parcelasTotais - $diferencaMeses;
            else
                return 0;

        return $parcelasTotais;
    }

    protected function parcelasDebitadas($gasto)
    {
        $primeiroMesPagamento = intval($this -> InformacoesData('m', $gasto['dataCompraPagamento']));
        $primeiroAnoPagamento = intval($this -> InformacoesData('y', $gasto['dataCompraPagamento']));

        if (date('d') >= $this -> InformacoesData('d', $gasto['dataCompraPagamento'])) {
            $primeiroMesPagamento -= 1;

            if ($primeiroMesPagamento <= 0) {
                $primeiroMesPagamento = 12;
                $primeiroAnoPagamento --;
            }
        }

        if ($primeiroMesPagamento < 10)
            $primeiroMesPagamento = "0" . $primeiroMesPagamento;

        $primeiraDataPagamento = $primeiroAnoPagamento . '-' . $primeiroMesPagamento . '-' . $this -> InformacoesData('d', $gasto['dataCompraPagamento']);
        $diferencaMeses = $this -> diferencaMesesData($primeiraDataPagamento, date('Y-m-d'));

        if ($diferencaMeses) {
            if ($diferencaMeses > 0)
                return $diferencaMeses;
            else
                return 0;
        }

        return $diferencaMeses;
    }

    protected function parcelasRecebidas($receita)
    {
        $primeiroMesPagamento = intval($this -> InformacoesData('m', $receita['dataPagamento']));
        $primeiroAnoPagamento = intval($this -> InformacoesData('y', $receita['dataPagamento']));

        if (date('d') >= $this -> InformacoesData('d', $receita['dataPagamento'])) {
            $primeiroMesPagamento -= 1;

            if ($primeiroMesPagamento <= 0) {
                $primeiroMesPagamento = 12;
                $primeiroAnoPagamento--;
            }
        }

        if ($primeiroMesPagamento < 10)
            $primeiroMesPagamento = "0" . $primeiroMesPagamento;

        $primeiraDataPagamento = $primeiroAnoPagamento . '-' . $primeiroMesPagamento . '-' . $this -> InformacoesData('d', $receita['dataPagamento']);
        $diferencaMeses = $this -> diferencaMesesData($primeiraDataPagamento, date('Y-m-d'));

        if ($diferencaMeses) {
            if ($diferencaMeses > 0)
                return $diferencaMeses;
            else
                return 0;
        }

        return $diferencaMeses;
    }
}