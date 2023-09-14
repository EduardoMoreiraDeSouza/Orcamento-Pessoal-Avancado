<?php

require_once __DIR__ .  "/../verificacoes/VerificarCpf.php";

abstract class DadosEntradaFormulario extends VerificarCpf
{

    private $dados;

    protected function nome()
    {

        $this -> setDados(addslashes($_POST['nome']));

        if ($this -> dadosDefinidos())
            return $this -> getDados();

        return false;

    }

    protected function valor()
    {

        $this -> setDados(addslashes($_POST['valor']));

        if ($this -> dadosDefinidos())
            return $this -> formatarValor($this -> getDados());

        return false;

    }

    protected function cpf()
    {

        $this -> setDados($this -> somenteNumeros(addslashes($_POST['cpf'])));

        if ($this -> dadosDefinidos() and $this -> VerificarCPF($this -> getDados()))
            return $this -> somenteNumeros($this -> getDados());

        return false;

    }

    protected function senha()
    {

        $this -> setDados(addslashes($_POST['senha']));

        if (!$this -> dadosDefinidos())
            return false;

        elseif (strlen($this -> getDados()) >= 8 ){

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
            return $this -> RetornarFalha(null, 'vazio');
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
