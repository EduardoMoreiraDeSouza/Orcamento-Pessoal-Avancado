<?php

function criarBancoDados() {

    $servidor = "localhost";
    $usuario = "root";
    $senhaServidor = "";
    $DBname = "";
    $conexaoDB = mysqli_connect($servidor, $usuario, $senhaServidor, $DBname);

    $codigoMySql = "CREATE DATABASE orcamentoPessoal DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;";
    mysqli_query($conexaoDB, $codigoMySql);

    $DBname = "orcamentoPessoal";
    $conexaoDB = mysqli_connect($servidor, $usuario, $senhaServidor, $DBname);

    $codigoMySql = "CREATE TABLE usuarios(
       
        cpf VARCHAR(11) NOT NULL,
        senha VARCHAR(64) NOT NULL,
        
        CONSTRAINT PK_cpf_usuarios PRIMARY KEY (cpf)
    
    ) DEFAULT CHARSET = utf8;";
    mysqli_query($conexaoDB, $codigoMySql);

    $codigoMySql = "CREATE TABLE bancosCorretoras(
       
        nome VARCHAR(60),
        cpf VARCHAR(11) NOT NULL,
        saldo DECIMAL(12, 2) NULL,
        
        CONSTRAINT PK_nome_bancoCorretoras PRIMARY KEY (nome),
        
        CONSTRAINT FK_nome_bancoCorretoras FOREIGN KEY (cpf)
        REFERENCES usuarios(cpf) on DELETE CASCADE ON UPDATE CASCADE
    
    ) DEFAULT CHARSET = utf8;";
    mysqli_query($conexaoDB, $codigoMySql);

    $codigoMySql = "CREATE TABLE cartoesCredito(
       
        nome VARCHAR(60),
        cpf VARCHAR(11) NOT NULL,
        limite DECIMAL(12, 2) NULL,
        fechamento INT(2),
        vencimento INT(2),
        
        CONSTRAINT PK_nome_cartoesCredito PRIMARY KEY (nome),
        
        CONSTRAINT FK_cpf_cartoesCredito FOREIGN KEY (cpf)
        REFERENCES usuarios(cpf) ON DELETE CASCADE ON UPDATE CASCADE,
        
        CONSTRAINT FK_nome_cartoesCredito FOREIGN KEY (nome)
        REFERENCES bancosCorretoras(nome) ON DELETE CASCADE ON UPDATE CASCADE
    
    ) DEFAULT CHARSET = utf8;";
    mysqli_query($conexaoDB, $codigoMySql);

    $codigoMySql = "CREATE TABLE gastos(
    
        cpf VARCHAR(11) NOT NULL,
        id INT AUTO_INCREMENT,
        tipo VARCHAR(7) NOT NULL,
        fiador VARCHAR(60) NOT NULL,
        classificacao VARCHAR(11) NOT NULL,
        valor DECIMAL(12, 2) NULL,
        parcelas INT(4),
        dataEfetivacao DATE,
    
        CONSTRAINT PK_id_gastos PRIMARY KEY (id),
        CONSTRAINT FK_cpf_gastos FOREIGN KEY (cpf)
        REFERENCES usuarios(cpf) ON DELETE CASCADE ON UPDATE CASCADE,
        
        CONSTRAINT FK_fiador_gastos FOREIGN KEY (fiador)
        REFERENCES bancosCorretoras(nome) ON DELETE CASCADE ON UPDATE CASCADE 
    
    ) DEFAULT CHARSET = utf8;";
    mysqli_query($conexaoDB, $codigoMySql);

    $codigoMySql = "CREATE TABLE receitas(
    
        cpf VARCHAR(11) NOT NULL,
        id INT AUTO_INCREMENT,
        bancoCorretora VARCHAR(60) NOT NULL,
        classificacao VARCHAR(11) NOT NULL,
        valor DECIMAL(12, 2) NULL,
        dataEfetivacao DATE,
        
        CONSTRAINT PK_id_receitas PRIMARY KEY (id),
        CONSTRAINT FK_cpf_receitas FOREIGN KEY (cpf)
        REFERENCES usuarios(cpf) ON DELETE CASCADE ON UPDATE CASCADE
                     
    ) DEFAULT CHARSET = utf8;";
    mysqli_query($conexaoDB, $codigoMySql);

}

function excluirBancoDados() {

    $servidor = "localhost";
    $usuario = "root";
    $senhaServidor = "";
    $DBname = "orcamentoPessoal";
    $conexaoDB = mysqli_connect($servidor, $usuario, $senhaServidor, $DBname);

    $codigoMySql = "DROP DATABASE orcamentoPessoal;";
    mysqli_query($conexaoDB, $codigoMySql);

}

if (isset($_POST['criarBancoDados'])) {

    criarBancoDados();

    echo "<script>

            alert('Banco de Dados Criado com Sucesso!')
            window.location.href = './index.html'

        </script>";
}

if (isset($_POST['excluirBancoDados'])) {

    excluirBancoDados();

    echo "<script>

            alert('Banco de Dados Criado com Sucesso!')
            window.location.href = './index.html'

        </script>";

}

?>