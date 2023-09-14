<?php

require_once __DIR__ . "/./ScriptJS.php";
abstract class Mensagens extends ScriptJS
{

    private $mensagens;

    protected function Mensagens($mensagem)
    {

        $this->setMensagens([

            'vazio' => 'Preencha todos os campos, por favor!',
            'senhaPequena' => 'A senha deve conter no mínimo 8 caracteres!',
            'senha' => 'A senha está incorreta!',
            'x2cpf' => 'Este CPF já está cadastrado!',
            'erroSql' => 'Erro ao tentar acessar o banco de dados',
            'cadastro' => 'Agora você está cadastrado em nosso sitema!',
            'cpfFalso' => 'CPF inválido!',
            'entrarSucesso' => 'Você agora está logado!',
            'cadastrar' => 'Você não está cadastrado em nosso sistema!'

        ]);

        return $this->getMensagens()[$mensagem];

    }


    private function getMensagens()
    {
        return $this->mensagens;
    }

    private function setMensagens($mensagens): void
    {
        $this->mensagens = $mensagens;
    }
}
