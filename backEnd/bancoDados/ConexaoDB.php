<?php

require_once __DIR__ . "/../site/Servidor.php";

abstract class ConexaoDB extends Servidor
{

    private $conexaoDB;

    public function ConexaoDB()
    {
        $this -> setConexaoDB($this -> conectarDB());

        if ($this -> getConexaoDB())
            return $this -> getConexaoDB();

        return (bool)$this -> RetornarErro('inicio', 'erroSql');
    }

    private function conectarDB()
    {
        try {
            return mysqli_connect(
                $this -> Servidor('servidor'),
                $this -> Servidor('usuario'),
                $this -> Servidor('senhaServidor'),
                $this -> Servidor('DBname')
            );
        } catch (Exception $e) {
            return false;
        }
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
