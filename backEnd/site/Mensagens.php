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
            'confirmarSenhaErro' => 'As senhas não são iguais!',

            'emailFalso' => 'Email inválido!',

            'entrarSucesso' => 'Você entrou com seu Email!',
            'entrar' => 'Para continuar é nescessário entrar com seu Email!',

            'cadastrar' => 'Você não está cadastrado em nosso sistema!',
            'cadastro' => 'Agora você está cadastrado em nosso sistema!',

            'x2bancosCorretoras' => 'Este Banco/Corretora já está cadastrado!',
            'x2cartoesCredito' => 'Já existe um cartão de crédito com esse bancoCorretora!',
            'x2email' => 'Este Email já está cadastrado!',
	        'cartaoNaoExite' => 'Não exite cartão de crédito para esse banco/corretora!',

            'naoBancoCorretora' => 'O banco/corretora selecionado não existe!',
            'saldoInsuficiente' => 'O saldo disponível não é suficiente para debitar o valor!',
            'limiteInsuficiente' => 'O limite disponível não é suficiente para esse crédito!',
			'novoLimiteMenor' => 'Seu novo limite é menor que seus gastos!',

            'sucesso' => 'Comando executado com sucesso!',

            'fechamentoVencimento' => 'O dia do fechamento não pode ser igual ao vencimento!',

            'valorInvalido' => 'O valor inserido está inválido!',
            'valorAbaixoZero' => 'O valor não pode ser negativo, ou zero!'

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
