<?php

require_once __DIR__ . "/./EntradaDadosUsuarios.php";

class ObterDadosBancosCorretoras extends EntradaDadosUsuarios
{

    private $dados;

    public function ObterDadosBancosCorretoras($id, $email)
    {
        if ($id == null and $email == null)
            return false;

        $this -> gerarCodigoMySql($id, $email);
        $this -> setDados($this -> CarregarResultadosMySql(true));

        return !empty($this -> getDados()) ? $this -> getDados() : false;
    }

    private function gerarCodigoMySql($id, $email): void
    {
        $codigo = "SELECT * FROM dbName.bancosCorretoras WHERE ";

        if ($id != null and $email != null)
            $codigoVariante = "id LIKE '$id' AND email LIKE '$email';";
        elseif ($id != null and $email == null)
            $codigoVariante = "id LIKE '$id';";
        elseif ($id == null and $email != null)
            $codigoVariante = "email LIKE '$email';";

        $this -> setCodigoMySql($codigo . $codigoVariante);
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