<?php

class Globais{

    private $paginaPai;

    private $localServidor;
    
    public function timezone(): bool
    {
        return date_default_timezone_set('America/Sao_Paulo');
    }

    public function getSessao()
    {
        $this -> iniciarSessao();

        if (!isset($_SESSION['usuario']))
            return null;
	    if (!isset($_SESSION['pagina_pai']))
			$_SESSION['pagina_pai'] = null;

        return $_SESSION['usuario'];
    }

    protected function setSessao($usuario): void
    {
        $this -> iniciarSessao();
        $_SESSION['usuario'] = $usuario;
    }

    protected function destruirSessao(): void
    {
        session_destroy();
    }

    private function iniciarSessao(): void
    {
        if(!isset($_SESSION))
        {
            session_start();
        }
    }

    protected function getPaginaPai()
    {
        return $this -> paginaPai;
    }

    protected function setPaginaPai($paginaPai): void
    {
        $this -> paginaPai = $paginaPai;
    }


    protected function getLocalServidor()
    {
        $this -> setLocalServidor('local'); // local ou global
        return $this -> localServidor;
    }

    protected function setLocalServidor($localServidor): void
    {
        $this -> localServidor = $localServidor;
    }
}
