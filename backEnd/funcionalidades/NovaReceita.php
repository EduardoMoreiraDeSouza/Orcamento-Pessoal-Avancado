<?php

require_once __DIR__ . "/./NovoDebito.php";

class NovaReceita extends NovoDebito
{

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

        if (!$this -> EntradaReceita($this -> getBancoCorretora(), $this -> getClassificacao(), $this -> getDataEfetivacao(), $this -> getValor())) {
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        else {

            date_default_timezone_set('America/Sao_Paulo');

            if ($this-> getDataEfetivacao() <= date('Y-m-d')) {
                $this->EditarBancosCorretoras(
                    $this->getBancoCorretora(),
                    $this->getBancoCorretora(),
                    $this->getSessao(),
                    $this->SaidaDadosBancosCorretoras($this->getBancoCorretora(), $this->getSessao())['saldo'] + $this->getValor()
                );
            }

        }

        $this -> Redirecionar($this -> getPaginaPai());
        return true;

    }

}