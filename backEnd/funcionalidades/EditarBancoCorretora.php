<?php

require_once __DIR__ . "/../funcionalidades/Entrar.php";

class EditarBancoCorretora extends Entrar
{

    private $nomeId;

    public function __construct()
    {

        $this -> setNomeId($this -> nomeId());
        $this -> setNome($this -> nome());
        $this -> setSaldo($this -> formatarValorDB($this -> saldo()));

        $this -> setCodigoMySql(
"UPDATE orcamentopessoal.bancoscorretoras SET
                nome = '". $this -> getNome() ."',
                cpf = '". $this -> getSessao() ."',
                saldo = '". $this -> getSaldo() ."'
            WHERE nome LIKE '". $this -> getNomeId() ."' AND cpf LIKE '". $this -> getSessao() ."';"
        );

        if (!$this -> ExecutarCodigoMySql()) {
            $this->Redirecionar('bancosCorretoras');
            return false;
        }

        $this->Redirecionar('bancosCorretoras');
        return true;
    }

    protected function getNomeId()
    {
        return $this -> nomeId;
    }
    protected function setNomeId($nomeId): void
    {
        $this -> nomeId = $nomeId;
    }

}
