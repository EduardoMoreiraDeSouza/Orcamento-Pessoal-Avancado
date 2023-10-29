<?php

require_once __DIR__ . "/../dados/DadosEntradaFormulario.php";

class NovoBancoCorretora extends DadosEntradaFormulario
{

    private $nome;
    private $saldo;

   /*  public function __construct()
    {

        if (empty($this -> getSessao())){
            $this -> Comunicar('entrar');
            $this -> Redirecionar('entrar');
            return false;
        }

        $this -> setPaginaPai('bancosCorretoras');
        $this -> setNome($this -> nome());
        $this -> setSaldo($this -> saldo());

        if (
            !$this-> getNome()
        ) {
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        if ($this -> SaidaDadosBancosCorretoras($this -> getNome(), $this -> getSessao())){
            $this -> Comunicar('x2bancosCorretoras');
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        if (!$this -> EntradaDadosBancosCorretoras($this -> getNome(), $this -> getSessao(), $this -> getSaldo())) {
            $this -> Redirecionar($this -> getPaginaPai());
            return false;
        }

        $this -> Redirecionar($this -> getPaginaPai());
        return true;
    }
 */

    protected function getNome()
    {
        return $this->nome;
    }

    protected function setNome($nome)
    {
        $this->nome = $nome;
    }

    protected function getSaldo()
    {
        return $this->saldo;
    }

    protected function setSaldo($valor)
    {
        $this->saldo = $valor;
    }
}