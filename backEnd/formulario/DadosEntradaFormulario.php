<?php

require_once __DIR__ . "/../gerais/ValorFinal.php";

abstract class DadosEntradaFormulario extends ValorFinal
{
    private $dados;

    protected function nome()
    {
        $this -> setDados($this -> fraseMaiuscula($this -> fraseMinuscula(addslashes($_POST['nome']))));

        if ($this -> dadosDefinidos())
            return $this -> getDados();

        return false;
    }

    protected function bancoCorretora()
    {
        $this -> setDados(addslashes($_POST['bancoCorretora']));

        if ($this -> dadosDefinidos())
            return $this -> getDados();

        return false;
    }

    protected function cartaoCredito()
    {
        $this -> setDados(addslashes($_POST['cartaoCredito']));

        if ($this -> dadosDefinidos())
            return $this -> getDados();

        return false;
    }

    protected function classificacao()
    {
        $this -> setDados(addslashes($_POST['clasificacao']));

        if ($this -> dadosDefinidos())
            return $this -> getDados();

        return false;
    }

    protected function dataEfetivacao()
    {
        $this -> setDados(addslashes($_POST['dataEfetivacao']));

        if ($this -> dadosDefinidos())
            return $this -> getDados();

        return false;
    }

    protected function fechamento()
    {
        $this -> setDados(addslashes($_POST['fechamento']));

        if ($this -> dadosDefinidos())
            return $this -> getDados();

        return false;
    }

    protected function vencimento()
    {
        $this -> setDados(addslashes($_POST['vencimento']));

        if ($this -> dadosDefinidos())
            return $this -> getDados();

        return false;
    }

    protected function nomeId()
    {
        $this -> setDados($this -> fraseMaiuscula($this -> fraseMinuscula(addslashes($_POST['nameId']))));

        if ($this -> dadosDefinidos())
            return $this -> getDados();

        return false;
    }

    protected function valor()
    {
        $this -> setDados(addslashes($_POST['valor']));

        if ($this -> formatarValorDB($this -> getDados()) < 0) {
            $this -> Comunicar('valorInvalido');
            return false;
        }

        elseif ($this -> dadosDefinidos()) {
            if (str_contains($this -> getDados(), '*'))
                $this -> setDados($this -> formatarValorDB($this -> getDados()) / $this -> parcelas());

            return $this -> formatarValorDB($this -> getDados());
        }

        return false;
    }

    protected function parcelas()
    {
        $this -> setDados(addslashes($_POST['parcelas']));

        if ($this -> dadosDefinidos())
            return $this -> getDados();

        return false;
    }

    protected function formaPagamento()
    {
        $this -> setDados(addslashes($_POST['formaPagamento']));

        if ($this -> dadosDefinidos())
            return $this -> getDados();

        return false;
    }

    protected function saldo()
    {
        $this -> setDados(addslashes($_POST['saldo']));

        return $this -> formatarValorDB($this -> getDados());
    }

    protected function email()
    {
        $this -> setDados(addslashes($_POST['email']));

        if ($this -> dadosDefinidos())
            return $this -> getDados();

        return false;
    }

    protected function senha()
    {
        $this -> setDados(addslashes($_POST['senha']));

        if (!$this -> dadosDefinidos())
            return false;

        elseif (strlen($this -> getDados()) >= 8) {
            $this -> setDados(hash('sha256', $this -> getDados()));
            return $this -> getDados();
        }

        $this -> Comunicar('senhaPequena');
        return false;
    }


    private function dadosDefinidos()
    {
        if (!$this -> getDados() or empty($this -> getDados())) {
            $this -> setDados(null);
            $this -> Comunicar('vazio');
            return false;
        }

        return true;
    }

    private function getDados()
    {
        return $this -> dados;
    }

    private function setDados($dados): void
    {
        $this -> dados = $dados;
    }

}
