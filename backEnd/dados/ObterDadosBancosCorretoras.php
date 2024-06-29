<?php

require_once __DIR__ . "/./EntradaDadosUsuarios.php";

abstract class ObterDadosBancosCorretoras extends EntradaDadosUsuarios
{

    private $dados;

    public function ObterDadosBancosCorretoras($bancoCorretora, $email)
    {
        if ($bancoCorretora == null and $email == null)
            return false;

        $this -> gerarCodigoMySql($bancoCorretora, $email);
        $this -> setDados($this -> CarregarResultadosMySql());

        return !empty($this -> getDados()) ? $this -> getDados() : false;
    }

    private function gerarCodigoMySql($bancoCorretora, $email): void
    {
        $codigo = "SELECT * FROM dbName.bancosCorretoras WHERE ";

        if ($bancoCorretora != null and $email != null)
            $codigoVariante = "bancoCorretora LIKE '$bancoCorretora' AND email LIKE '$email';";
        elseif ($bancoCorretora != null and $email == null)
            $codigoVariante = "bancoCorretora LIKE '$bancoCorretora';";
        elseif ($bancoCorretora == null and $email != null)
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