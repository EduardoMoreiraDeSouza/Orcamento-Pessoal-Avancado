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
       
        cpf VARCHAR(11) PRIMARY KEY,
        senha VARCHAR(64) NOT NULL
    
    ) DEFAULT CHARSET = utf8;";
    mysqli_query($conexaoDB, $codigoMySql);

    $codigoMySql = "CREATE TABLE bancosCorretoras(
       
        nome VARCHAR(60) PRIMARY KEY,
        cpf VARCHAR(11) NOT NULL,
        saldo DECIMAL(12, 2) NULL
    
    ) DEFAULT CHARSET = utf8;";
    mysqli_query($conexaoDB, $codigoMySql);

    $codigoMySql = "CREATE TABLE gastos(
        cpf VARCHAR(11) NOT NULL,
        id INT AUTO_INCREMENT PRIMARY KEY,
        tipo VARCHAR(7) NOT NULL,
        bancoCorretora VARCHAR(60) NOT NULL,
        classificacao VARCHAR(11) NOT NULL,
        valor DECIMAL(12, 2) NULL,
        dataEfetivacao DATE
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