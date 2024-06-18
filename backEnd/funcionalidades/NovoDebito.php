<?php

require_once __DIR__ . "/../funcionalidades/EditarBancoCorretora.php";

class NovoDebito extends EditarBancoCorretora
{
    private $bancoCorretora;
    private $classificacao;
    private $dataEfetivacao;
    private $valor;
    private $parcelas;

    public function __construct()
    {
        if (!$this-> VerificarLogin()) return false;

        $this -> setPaginaPai('bancosCorretoras');
        $this -> setBancoCorretora($this -> bancoCorretora());
        $this -> setClassificacao($this -> classificacao());
        $this -> setDataEfetivacao($this -> dataEfetivacao());
        $this -> setValor($this -> valor());
        $this-> setParcelas($this-> parcelas());

        if (
            !$this -> getBancoCorretora() or
            !$this -> getClassificacao() or
            !$this -> getDataEfetivacao() or
            !$this -> getValor() or
            !$this-> getParcelas()
        ) {
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        $banco = $this -> SaidaDadosBancosCorretoras($this -> getBancoCorretora(), $this -> getSessao());

        if (!$banco) {
            $this -> Comunicar('naoBancoCorretora');
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        date_default_timezone_set('America/Sao_Paulo');

        if ($banco['saldo'] - $this->getValor() < 0 and $this-> getDataEfetivacao() <= date('Y-m-d')) {
            $this -> Comunicar('saldoInsuficiente');
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        if (!$this -> EntradaDadosGastos(
            $this -> getBancoCorretora(),
            'Débito',
            $this -> getClassificacao(),
            $this -> getDataEfetivacao(),
            $this -> getValor(),
            $this-> getParcelas()
        )) {
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        elseif ($this-> getDataEfetivacao() <= date('Y-m-d')) {
            $this->EditarDadosBancosCorretoras(
                $this->getBancoCorretora(),
                $this->getBancoCorretora(),
                $this->getSessao(),
                $banco['saldo'] - $this->getValor()
            );
        }

        $this -> Redirecionar($this -> getPaginaPai());
        return true;
    }


    protected function getBancoCorretora()
    {
        return $this -> bancoCorretora;
    }

    protected function setBancoCorretora($bancoCorretora)
    {
        $this -> bancoCorretora = $bancoCorretora;
    }

    protected function getClassificacao()
    {
        return $this -> classificacao;
    }

    protected function setClassificacao($classificacao)
    {
        $this -> classificacao = $classificacao;
    }

    protected function getDataEfetivacao()
    {
        return $this -> dataEfetivacao;
    }

    protected function setDataEfetivacao($dataEfetivacao)
    {
        $this -> dataEfetivacao = $dataEfetivacao;
    }

    protected function getValor()
    {
        return $this -> valor;
    }

    protected function setValor($valor)
    {
        $this -> valor = $valor;
    }

    protected function getParcelas()
    {
        return $this -> parcelas;
    }

    protected function setParcelas($parcelas)
    {
        $this -> parcelas = $parcelas;
    }

}