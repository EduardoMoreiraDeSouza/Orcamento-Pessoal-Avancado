<?php

function criarBancoDados()
{
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
       
        email VARCHAR(60) NOT NULL,
        senha VARCHAR(64) NOT NULL,
        
        CONSTRAINT PK_email_usuarios PRIMARY KEY (email)
    
    ) DEFAULT CHARSET = utf8;";
    mysqli_query($conexaoDB, $codigoMySql);

    $codigoMySql = "CREATE TABLE bancosCorretoras(
       
        bancoCorretora VARCHAR(60),
        email VARCHAR(60) NOT NULL,
        saldo DECIMAL(12, 2) NULL,
        
        CONSTRAINT PK_bancoCorretora_bancoCorretoras PRIMARY KEY (bancoCorretora),
        
        CONSTRAINT FK_email_bancoCorretoras FOREIGN KEY (email)
        REFERENCES usuarios(email) on DELETE CASCADE ON UPDATE CASCADE
    
    ) DEFAULT CHARSET = utf8;";
    mysqli_query($conexaoDB, $codigoMySql);

    $codigoMySql = "CREATE TABLE cartoesCredito(
       
        bancoCorretora VARCHAR(60),
        email VARCHAR(60) NOT NULL,
        limite DECIMAL(12, 2) NULL,
        fechamento INT(2),
        vencimento INT(2),
        
        CONSTRAINT PK_bancoCorretora_cartoesCredito PRIMARY KEY (bancoCorretora),
        
        CONSTRAINT FK_email_cartoesCredito FOREIGN KEY (email)
        REFERENCES usuarios(email) ON DELETE CASCADE ON UPDATE CASCADE,
        
        CONSTRAINT FK_bancoCorretora_cartoesCredito FOREIGN KEY (bancoCorretora)
        REFERENCES bancosCorretoras(bancoCorretora) ON DELETE CASCADE ON UPDATE CASCADE
    
    ) DEFAULT CHARSET = utf8;";
    mysqli_query($conexaoDB, $codigoMySql);

    $codigoMySql = "CREATE TABLE gastos(
    
        email VARCHAR(60) NOT NULL,
        id INT AUTO_INCREMENT,
        formaPagamento VARCHAR(7) NOT NULL,
        bancoCorretora VARCHAR(60) NOT NULL,
        classificacao VARCHAR(13) NOT NULL,
        valor DECIMAL(12, 2) NULL,
        parcelas INT(4),
        dataCompraPagamento DATE,
    
        CONSTRAINT PK_id_gastos PRIMARY KEY (id),
        CONSTRAINT FK_email_gastos FOREIGN KEY (email)
        REFERENCES usuarios(email) ON DELETE CASCADE ON UPDATE CASCADE,
        
        CONSTRAINT FK_bancoCorretora_gastos FOREIGN KEY (bancoCorretora)
        REFERENCES bancosCorretoras(bancoCorretora) ON DELETE CASCADE ON UPDATE CASCADE 
    
    ) DEFAULT CHARSET = utf8;";
    mysqli_query($conexaoDB, $codigoMySql);

    $codigoMySql = "CREATE TABLE receitas(
    
        email VARCHAR(60) NOT NULL,
        id INT AUTO_INCREMENT,
        bancoCorretora VARCHAR(60) NOT NULL,
        classificacao VARCHAR(15) NOT NULL,
        valor DECIMAL(12, 2) NULL,
        parcelas INT(4),
        dataCompraPagamento DATE,
        
        CONSTRAINT PK_id_receitas PRIMARY KEY (id),
        
        CONSTRAINT FK_email_receitas FOREIGN KEY (email)
        REFERENCES usuarios(email) ON DELETE CASCADE ON UPDATE CASCADE,
        
        CONSTRAINT FK_bancoCorretora_receitas FOREIGN KEY (bancoCorretora)
        REFERENCES bancosCorretoras(bancoCorretora) ON DELETE CASCADE ON UPDATE CASCADE 
                     
    ) DEFAULT CHARSET = utf8;";
    mysqli_query($conexaoDB, $codigoMySql);
}

function excluirBancoDados()
{
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
            window.location.href = 'index.php'

        </script>";
}

if (isset($_POST['excluirBancoDados'])) {

    excluirBancoDados();

    echo "<script>

            alert('Banco de Dados Excluído com Sucesso!')
            window.location.href = 'index.php'

        </script>";

}

?>