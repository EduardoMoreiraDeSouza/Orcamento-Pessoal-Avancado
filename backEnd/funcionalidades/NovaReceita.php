<?php

require_once __DIR__ . "/./NovoDebito.php";

class NovaReceita extends NovoDebito
{
    public function __construct()
    {
        if (!$this-> VerificarLogin()) return false;

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

        if (!$this -> ObterDadosBancosCorretoras($this -> getBancoCorretora(), $this -> getSessao())) {
            $this -> Comunicar('naoBancoCorretora');
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        if (!$this -> EntradaDadosReceita($this -> getBancoCorretora(), $this -> getClassificacao(), $this -> getDataEfetivacao(), $this -> getValor())) {
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        $this -> Redirecionar($this -> getPaginaPai());
        return true;
    }
}