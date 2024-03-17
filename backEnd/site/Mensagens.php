<?php

require_once __DIR__ . "/./ScriptJS.php";
abstract class Mensagens extends ScriptJS
{

    private $mensagens;

    protected function Mensagens($mensagem)
    {

        $this->setMensagens([

            'erroSql' => 'Erro ao tentar acessar o banco de dados',

            'vazio' => 'Preencha todos os campos, por favor!',

            'senhaPequena' => 'A senha deve conter no mínimo 8 caracteres!',
            'senha' => 'A senha está incorreta!',

            'cpfFalso' => 'CPF inválido!',

            'entrarSucesso' => 'Você entrou com seu CPF!',
            'entrar' => 'Para continuar é nescessário entrar com seu CPF!',

            'cadastrar' => 'Você não está cadastrado em nosso sistema!',
            'cadastro' => 'Agora você está cadastrado em nosso sitema!',

            'x2bancosCorretoras' => 'Este Banco/Corretora já está cadastrado!',
            'x2cartoesCredito' => 'Já existe um cartão de crédito com esse nome!',
            'x2cpf' => 'Este CPF já está cadastrado!',

            'naoBancoCorretora' => 'O banco/corretora selecionado não existe!',
            'saldoInsuficiente' => 'O saldo disponível não é suficiente para debitar o valor!',

            'sucesso' => 'Comando executado com sucesso!',

            'fechamentoVencimento' => 'O dia do fechamento não pode ser igual ao vencimento!'

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
