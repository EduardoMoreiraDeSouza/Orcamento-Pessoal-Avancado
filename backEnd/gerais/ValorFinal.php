<?php

require_once __DIR__ . "/./FormatacaoDados.php";

class ValorFinal extends FormatacaoDados
{
    public function ValorFinal($tipo, $entidade, $dataReferencia = null)
    {

        $this->timezone();

        if ($tipo == 'cartaoCredito') {

            $limiteTotal = $this->ObterDadosCartoesCredito($entidade, $this->getSessao())['limite'];
            $gastosCreditoTotal = 0;
            $gastos = $this->ObterDadosGastos($this->getSessao());
            $gastoAtual = 0;

            if ($gastos)
                foreach ($gastos as $ignored) {
                    if ($gastos[$gastoAtual]['bancoCorretora'] == $entidade)
                        if ($gastos[$gastoAtual]['formaPagamento'] == 'Crédito')
                            $gastosCreditoTotal += $gastos[$gastoAtual]['valor'] * ($gastos[$gastoAtual]['parcelas'] - $this->parcelasPagasCredito($gastos[$gastoAtual], $dataReferencia));
                    $gastoAtual++;
                }

            return $limiteTotal - $gastosCreditoTotal;
        } elseif ($tipo == 'bancoCorretora') {

            $gastosDebitoTotal = 0;
            $gastos = $this->ObterDadosGastos($this->getSessao());
            $gastoAtual = 0;

            if ($gastos)
                foreach ($gastos as $ignored) {
                    if ($gastos[$gastoAtual]['bancoCorretora'] == $entidade)
                        if ($gastos[$gastoAtual]['formaPagamento'] == 'Débito')
                            $gastosDebitoTotal += $gastos[$gastoAtual]['valor'] * $this->parcelasDebitadas($gastos[$gastoAtual], $dataReferencia);
                    $gastoAtual++;
                }

            $receitaTotal = 0;
            $receita = $this->ObterDadosReceita($this->getSessao());
            $receitaAtual = 0;

            if ($receita)
                foreach ($receita as $ignored) {
                    if ($receita[$receitaAtual]['bancoCorretora'] == $entidade)
                        $receitaTotal += $receita[$receitaAtual]['valor'] * $this->parcelasRecebidas($receita[$receitaAtual], $dataReferencia);

                    $receitaAtual++;
                }

            $saldoFinal = $receitaTotal - $gastosDebitoTotal;

            $this->AlterarDadosBancosCorretoras(
                $entidade,
                $entidade,
                $saldoFinal,
            );

            return $saldoFinal;
        }

        return false;
    }

    public function parcelasPagasCredito($gasto, $dataReferencia = null)
    {
        $dadosCartao = $this->ObterDadosCartoesCredito($gasto['bancoCorretora'], $this->getSessao());

        $mesPagamento = intval($this->InformacoesData('m', $gasto['dataCompraPagamento']));
        $anoPagamento = intval($this->InformacoesData('y', $gasto['dataCompraPagamento']));
        $diaPagamento = intval($this->InformacoesData('d', $gasto['dataCompraPagamento']));

        if ($dataReferencia == null)
            $dataReferencia = date("Y-m-d");

        if ($diaPagamento >= $dadosCartao['fechamento']) {
            if ($dadosCartao['vencimento'] < $dadosCartao['fechamento'])
                $mesPagamento += 2;
            elseif ($dadosCartao['vencimento'] > $dadosCartao['fechamento'])
                $mesPagamento += 0;
            else
                $mesPagamento += 1;
        }
        elseif ($diaPagamento == $dadosCartao['vencimento']) {
              $mesPagamento += 1;
        } else {
            if ($dadosCartao['vencimento'] > $dadosCartao['fechamento'])
                $mesPagamento -= 2;
            else
                $mesPagamento++;
        }

        if ($mesPagamento > 12) {
            $mesPagamento = $mesPagamento - 12;
            $anoPagamento++;

            if (gettype($anoPagamento / 4) == "integer")
                $diasFevereiro = 29;
            else
                $diasFevereiro = 28;

            if ($mesPagamento == 2 and intval($this->InformacoesData('d', $gasto['dataCompraPagamento'])) > $diasFevereiro)
                $mesPagamento++;
        }

        if ($mesPagamento < 10)
            $mesPagamento = "0" . $mesPagamento;

        if ($dadosCartao['vencimento'] < 10)
            $dadosCartao['vencimento'] = "0" . $dadosCartao['vencimento'];

        $primeiraDataPagamento = $anoPagamento . '-' . $mesPagamento . '-' . $dadosCartao['vencimento'];
        $diferencaMeses = $this->diferencaMesesData($primeiraDataPagamento, $dataReferencia);

        if ($diferencaMeses > $gasto['parcelas'])
            return $gasto['parcelas'];
        elseif ($diferencaMeses > 0)
            return $diferencaMeses;
        else
            return 0;
    }

    public function parcelasDebitadas($gasto, $dataReferencia = null)
    {
        $primeiroMesPagamento = intval($this->InformacoesData('m', $gasto['dataCompraPagamento']));
        $primeiroAnoPagamento = intval($this->InformacoesData('y', $gasto['dataCompraPagamento']));

        if ($dataReferencia == null)
            $dataReferencia = date("Y-m-d");

        if ($this->InformacoesData('d', $dataReferencia) >= $this->InformacoesData('d', $gasto['dataCompraPagamento'])) {
            $primeiroMesPagamento -= 1;

            if ($primeiroMesPagamento <= 0) {
                $primeiroMesPagamento = 12;
                $primeiroAnoPagamento--;
            }
        }

        if ($primeiroMesPagamento < 10)
            $primeiroMesPagamento = "0" . $primeiroMesPagamento;

        $primeiraDataPagamento = $primeiroAnoPagamento . '-' . $primeiroMesPagamento . '-' . $this->InformacoesData('d', $gasto['dataCompraPagamento']);
        $diferencaMeses = $this->diferencaMesesData($primeiraDataPagamento, $dataReferencia);


        if ($diferencaMeses > 0)
            return $diferencaMeses;
        else
            return 0;

    }

    public function parcelasRecebidas($receita, $dataReferencia = null)
    {
        $primeiroMesPagamento = intval($this->InformacoesData('m', $receita['dataCompraPagamento']));
        $primeiroAnoPagamento = intval($this->InformacoesData('y', $receita['dataCompraPagamento']));

        if ($dataReferencia == null)
            $dataReferencia = date("Y-m-d");

        if ($this->InformacoesData('d', $dataReferencia) >= $this->InformacoesData('d', $receita['dataCompraPagamento'])) {
            $primeiroMesPagamento -= 1;

            if ($primeiroMesPagamento <= 0) {
                $primeiroMesPagamento = 12;
                $primeiroAnoPagamento--;
            }
        }

        if ($primeiroMesPagamento < 10)
            $primeiroMesPagamento = "0" . $primeiroMesPagamento;

        $primeiraDataPagamento = $primeiroAnoPagamento . '-' . $primeiroMesPagamento . '-' . $this->InformacoesData('d', $receita['dataCompraPagamento']);
        $diferencaMeses = $this->diferencaMesesData($primeiraDataPagamento, $dataReferencia);

        if ($diferencaMeses > $receita['parcelas'])
            return $receita['parcelas'];
        elseif ($diferencaMeses > 0)
            return $diferencaMeses;
        else
            return 1;
    }
}