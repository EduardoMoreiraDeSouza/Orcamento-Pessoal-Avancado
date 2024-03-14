<?php

require_once __DIR__ . "/../funcionalidades/EditarBancoCorretora.php";

class NovoDebito extends EditarBancoCorretora
{

    private $bancoCorretora;
    private $classificacao;
    private $dataEfetivacao;
    private $valor;

    public function __construct()
    {

        if (empty($this -> getSessao())){
            $this -> Comunicar('entrar');
            $this -> Redirecionar('entrar');
            return false;
        }

        $this -> setPaginaPai('bancosCorretoras');
        $this -> setBancoCorretora($this -> bancoCorretora());
        $this -> setClassificacao($this -> classificacao());
        $this -> setDataEfetivacao($this -> dataEfetivacao());
        $this -> setValor($this -> valor());

        if (
            !$this -> getBancoCorretora() or
            !$this -> getClassificacao() or
            !$this -> getDataEfetivacao() or
            !$this -> getValor()
        ) {
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        if (!$this -> SaidaDadosBancosCorretoras($this -> getBancoCorretora(), $this -> getSessao())) {
            $this -> Comunicar('naoBancoCorretora');
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        if (!$this -> EntradaGastos($this -> getBancoCorretora(), 'debito', $this -> getClassificacao(), $this -> getDataEfetivacao(), $this -> getValor())) {
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        else {

            $this-> EditarBancosCorretoras(
                $this-> getBancoCorretora(),
                $this-> getBancoCorretora(),
                $this-> getSessao(),
                $this-> SaidaDadosBancosCorretoras($this-> getBancoCorretora(), $this-> getSessao())['saldo'] - $this-> getValor()
            );

        }

        $this -> Redirecionar($this -> getPaginaPai());
        return true;

    }


    private function getBancoCorretora()
    {
        return $this -> bancoCorretora;
    }

    private function setBancoCorretora($bancoCorretora)
    {
        $this -> bancoCorretora = $bancoCorretora;
    }

    private function getClassificacao()
    {
        return $this -> classificacao;
    }

    private function setClassificacao($classificacao)
    {
        $this -> classificacao = $classificacao;
    }

    private function getDataEfetivacao()
    {
        return $this -> dataEfetivacao;
    }

    private function setDataEfetivacao($dataEfetivacao)
    {
        $this -> dataEfetivacao = $dataEfetivacao;
    }

    private function getValor()
    {
        return $this -> valor;
    }

    public function setValor($valor)
    {
        $this -> valor = $valor;
    }
}