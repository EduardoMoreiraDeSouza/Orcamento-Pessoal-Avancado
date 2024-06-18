<?php

require_once __DIR__ .  "/./Mensagens.php";

abstract class Comunicar extends Mensagens
{
    private $mensagem;
    private $script;

    protected function Comunicar($mensagem)
    {
        $this -> setMensagem($mensagem);
        $this -> mostrarMensagem();

        return true;
    }

    private function mostrarMensagem(): void
    {
        $this -> setScript("alert('".$this -> getMensagem()."')");
        $this -> ScriptJS($this -> getScript());
    }

    private function getMensagem()
    {
        return $this -> mensagem;
    }

    private function setMensagem($mensagem): void
    {
        $this -> mensagem = $this -> Mensagens($mensagem);
    }

    private function getScript()
    {
        return $this -> script;
    }

    private function setScript($script): void
    {
        $this -> script = $script;
    }
}
