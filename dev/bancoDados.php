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
       
    	id INT AUTO_INCREMENT,
        bancoCorretora VARCHAR(60),
        email VARCHAR(60) NOT NULL,
        saldo DECIMAL(12, 2) NULL,
        
        CONSTRAINT PK_id_bancoCorretoras PRIMARY KEY (id),
        
        CONSTRAINT FK_email_bancoCorretoras FOREIGN KEY (email)
        REFERENCES usuarios(email) on DELETE CASCADE ON UPDATE CASCADE
    
    ) DEFAULT CHARSET = utf8;";
    mysqli_query($conexaoDB, $codigoMySql);

    $codigoMySql = "CREATE TABLE cartoesCredito(
       
    	id_bancoCorretora INT NOT NULL,    
        email VARCHAR(60) NOT NULL,
        limite DECIMAL(12, 2) NULL,
        fechamento INT(2),
        vencimento INT(2),
        
        CONSTRAINT PK_id_cartoesCredito PRIMARY KEY (id_bancoCorretora),
        
        CONSTRAINT FK_email_cartoesCredito FOREIGN KEY (email)
        REFERENCES usuarios(email) ON DELETE CASCADE ON UPDATE CASCADE,
        
        CONSTRAINT FK_id_cartoesCredito FOREIGN KEY (id_bancoCorretora)
        REFERENCES bancosCorretoras(id) ON DELETE CASCADE ON UPDATE CASCADE
    
    ) DEFAULT CHARSET = utf8;";
    mysqli_query($conexaoDB, $codigoMySql);

    $codigoMySql = "CREATE TABLE gastos(
    
    	id_gasto INT AUTO_INCREMENT NOT NULL,
        id_bancoCorretora INT NOT NULL,
        email VARCHAR(60) NOT NULL,
        formaPagamento VARCHAR(7) NOT NULL,
        classificacao VARCHAR(13) NOT NULL,
        valor DECIMAL(12, 2) NULL,
        parcelas INT(4),
        dataCompraPagamento DATE,
    
    	CONSTRAINT PK_id_gastos PRIMARY KEY (id_gasto), 
    
        CONSTRAINT FK_email_gastos FOREIGN KEY (email)
        REFERENCES usuarios(email) ON DELETE CASCADE ON UPDATE CASCADE,
        
        CONSTRAINT FK_id_gastos FOREIGN KEY (id_bancoCorretora)
        REFERENCES bancosCorretoras(id) ON DELETE CASCADE ON UPDATE CASCADE 
    
    ) DEFAULT CHARSET = utf8;";
    mysqli_query($conexaoDB, $codigoMySql);

    $codigoMySql = "CREATE TABLE receitas(
    
    	id_receita INT AUTO_INCREMENT NOT NULL,    
    	id_bancoCorretora INT NOT NULL,
        email VARCHAR(60) NOT NULL,
        classificacao VARCHAR(15) NOT NULL,
        valor DECIMAL(12, 2) NULL,
        parcelas INT(4),
        dataCompraPagamento DATE,
        
        CONSTRAINT PK_id_receita_cartoesCredito PRIMARY KEY (id_receita),
        
        CONSTRAINT FK_email_receitas FOREIGN KEY (email)
        REFERENCES usuarios(email) ON DELETE CASCADE ON UPDATE CASCADE,
        
        CONSTRAINT FK_bancoCorretora_receitas FOREIGN KEY (id_bancoCorretora)
        REFERENCES bancosCorretoras(id) ON DELETE CASCADE ON UPDATE CASCADE 
                     
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