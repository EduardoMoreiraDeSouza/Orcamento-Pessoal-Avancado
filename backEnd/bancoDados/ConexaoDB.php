<?php

require_once __DIR__ . "/../site/Servidor.php";

abstract class ConexaoDB extends Servidor
{

    private $conexaoDB;

    protected function ConexaoDB()
    {

        $this -> setConexaoDB(
            mysqli_connect(
                $this -> Servidor('servidor'),
                $this -> Servidor('usuario'),
                $this -> Servidor('senhaServidor'),
                $this -> Servidor('DBname')
            ));

        if ($this -> getConexaoDB())
            return $this -> getConexaoDB();

        $this -> Comunicar('erroSql');
        return false;
    }

    private function getConexaoDB()
    {
        return $this -> conexaoDB;
    }

    private function setConexaoDB($conexaoDB): void
    {
        $this -> conexaoDB = $conexaoDB;
    }
}
