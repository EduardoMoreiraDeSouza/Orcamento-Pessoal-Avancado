<?php

require_once __DIR__ . "/../backEnd/verificacoes/VerificarLogin.php";
$login = new VerificarLogin();

if ($login -> VerificarLogin()) {

    require_once __DIR__ . "/../backEnd/bancoDados/ExecucaoCodigoMySql.php";
    require_once __DIR__ . "/../backEnd/gerais/FormatacaoDados.php";

    $formatacao = new FormatacaoDados();

    $execucao = new ExecucaoCodigoMySql();
    $codigoMySql = "SELECT * FROM dbName.receitas WHERE email LIKE '" . $login -> getSessao() . "';";

    $execucao -> setCodigoMySql($codigoMySql);
    $resultadoExecucao = $execucao -> ExecutarCodigoMySql();
    $execucao -> timezone();

    if (isset($_GET['excluir']) and isset($_GET['id'])) {

        require_once __DIR__ . "/../backEnd/funcionalidades/ExcluirGasto.php";
        $exluir = new ExcluirGasto(); // ATENÇÃO MUDAR
        $exluir -> ExcluirGasto($_GET['id'], $login -> getSessao());
        $exluir -> Redirecionar('gastos', true);

    }

    ?>

    <!doctype html>
    <html lang="pr-br">

    <head>

        <title>Minhas Receitas</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
              crossorigin="anonymous">

    </head>

    <body class="bg-success d-grid vh-100">

    <header class="container-fluid mt-2">
        <a href="../index.php" class="btn btn-close bg-light"></a>
        <a href="../index.php" class="text-light" style="text-decoration: none;">Fechar</a>
    </header>

    <main class="container w-75 bg-light p-5 rounded border border-secondary shadow-lg">
        <h1 class="text-center">Minhas Receitas</h1>
        <div class="container row mt-5">
            <div class="col-auto">

                <p>
                    <button class="btn btn-dark" type="button" data-bs-toggle="collapse"
                            data-bs-target="#novoBancoCorretora" aria-expanded="false"
                            aria-controls="collapseWidthExample">
                        Novo Banco | Corretora
                    </button>
                </p>

                <div style="min-height: auto;" class="mb-4">
                    <div class="collapse collapse-horizontal" id="novoBancoCorretora">
                        <div class="card card-body border border-dark bg-secondary" style="width: 500px;">
                            <form action="../backEnd/interacaoComUsuario/novoBancoCorretora.php" method="POST"
                                  class="form hstack gap-3">

                                <input type="text" class="container input-group-text" name="nome" placeholder="Nome:"
                                       required>
                                <input type="number" class="container input-group-text" name="saldo"
                                       placeholder="Saldo:" step="0.01">

                                <input type="submit" class="container btn btn-dark" value="Criar">

                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-auto">

                <p>
                    <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#novaReceita"
                            aria-expanded="false" aria-controls="collapseWidthExample">
                        Nova Receita
                    </button>
                </p>

                <div style="min-height: auto;" class="mb-3">
                    <div class="collapse collapse-horizontal" id="novaReceita">

                        <p>Não sabe o valor das parcelas? <br/>Coloque o valor total da receita (Com juros, se tiver), e
                            no final coloque um * (Asterisco) para calcularmos para você!</p>

                        <div class="card card-body border border-dark bg-secondary" style="width: 700px;">
                            <form action="../backEnd/interacaoComUsuario/novaReceita.php" method="POST"
                                  class="form hstack gap-3">

                                <select class="form-select" name="bancoCorretora" required>

                                    <option value="" selected>Banco | Corretora</option>

                                    <?php

                                    $execucao -> setCodigoMySql("SELECT * FROM dbName.bancosCorretoras WHERE email LIKE '" . $login -> getSessao() . "';");
                                    $resultadoExecucao = $execucao -> ExecutarCodigoMySql();

                                    while ($dadosBancosCorretoras = mysqli_fetch_assoc($resultadoExecucao)) {

                                        $nome = $dadosBancosCorretoras['nome'];

                                        ?>

                                        <option value="<?= $nome ?>"><?= $nome ?></option>


                                        <?php
                                    } ?>

                                </select>

                                <select class="form-select" name="clasificacao" required>
                                    <option value="" selected>Classificação</option>
                                    <option value="Salário">Salário</option>
                                    <option value="Rendimentos">Rendimentos</option>
                                    <option value="Empreendimentos">Empreendimentos</option>
                                    <option value="Emprestimos">Empréstimos</option>
                                    <option value="Reserva">Reserva</option>
                                    <option value="Outros">Outros</option>
                                </select>
                                <input type="date" class="container input-group-text" name="dataCompraPagamento"
                                       value="<?= date('Y-m-d') ?>" required>
                                <input type="text" class="container input-group-text" name="valor" placeholder="Valor"
                                       required>
                                <input type="number" class="container input-group-text" name="parcelas"
                                       title="Quantidade de Parcelas" step="1" min="0" value="1">
                                <input type="submit" class="container btn btn-dark" value="Depositar">

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-dark text-center">

            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Banco/Corretora</th>
                <th scope="col">Valor</th>
                <th scope="col">Classificacao</th>
                <th scope="col">Parcelas</th>
                <th scope="col">Pagamento</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>

            <?php

            $execucao -> setCodigoMySql($codigoMySql);
            $resultadoExecucao = $execucao -> ExecutarCodigoMySql();

            $quantidade = 0;
            $saldoTotal = 0;

            while ($dadosReceitas = mysqli_fetch_assoc($resultadoExecucao)) {

                $quantidade++;

                $id = $dadosReceitas['id'];
                $bancoCorretora = $dadosReceitas['bancoCorretora'];
                $valor = $dadosReceitas['valor'];
                $parcelas = $dadosReceitas['parcelas'];
                $classificacao = $dadosReceitas['classificacao'];
                $dataCompraPagamento = $dadosReceitas['dataPagamento'];

                ?>

                <form action="../backEnd/interacaoComUsuario/editarGastos.php" method="POST"> <!-- Editar gastos -->
                    <tr>
                        <th scope="row"><?= $quantidade ?>º</th>
                        <td>
                            <select class="form-select" name="bancoCorretora" required>

                                <?php

                                $execucao2 = new ExecucaoCodigoMySql();
                                $codigoMySql2 = "SELECT * FROM dbName.bancosCorretoras WHERE email LIKE '" . $login -> getSessao() . "';";
                                $execucao2 -> setCodigoMySql($codigoMySql2);
                                $resultadoExecucao2 = $execucao2 -> ExecutarCodigoMySql();

                                while ($dadosBancosCorretoras = mysqli_fetch_assoc($resultadoExecucao2)) {

                                    $nome = $dadosBancosCorretoras['nome'];

                                    ?>

                                    <option value="<?= $nome ?>" <?= $nome == $bancoCorretora ? 'selected' : '' ?>><?= $nome ?></option>


                                    <?php
                                } ?>

                            </select>
                        </td>
                        <td>
                            <input type="text" class="container input-group-text" name="valor" placeholder="Saldo:"
                                   step="0.01" value="R$ <?= $formatacao -> formatarValor($valor) ?>">
                        </td>

                        <td>
                            <select class="form-select" name="clasificacao" required>
                                <option value="Pessoal" <?= $classificacao == 'Salário' ? 'selected' : '' ?>>Salário
                                </option>
                                <option value="Necessário" <?= $classificacao == 'Rendimentos' ? 'selected' : '' ?>>
                                    Rendimentos
                                </option>
                                <option value="Reserva" <?= $classificacao == 'Empreendimentos' ? 'selected' : '' ?>>Empreendimentos
                                </option>
                                <option value="Dívidas" <?= $classificacao == 'Emprestimos' ? 'selected' : '' ?>>Emprestimos
                                </option>
                                <option value="Investimentos" <?= $classificacao == 'Reserva' ? 'selected' : '' ?>>
                                    Reserva
                                </option>
                                <option value="Boas Ações" <?= $classificacao == 'Outros' ? 'selected' : '' ?>>Boas
                                    Outros
                                </option>
                                <option value="Boas Ações" <?= $classificacao == 'correcaoSaldo' ? 'selected' : '' ?>>
                                    Correção de Saldo
                                </option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="container input-group-text" name="parcelas" placeholder="Parcelas:"
                                   step="0.01" value="<?= $parcelas ?>">
                        </td>
                        <td>
                            <input type="date" class="container input-group-text" name="dataCompraPagamento"
                                   value="<?= $dataCompraPagamento ?>">
                        </td>
                        <td>
                            <button style="text-decoration: none;" class="text-primary bg-transparent" name="id"
                                    value="<?= $id ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                </svg>
                            </button>

                            <button type="button" style="text-decoration: none;" class="text-primary bg-transparent">
                                <a href="?excluir=true&id=<?= $id ?>" style="text-decoration: none;"
                                   class="text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-backspace" viewBox="0 0 16 16">
                                        <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
                                        <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z"/>
                                    </svg>
                                </a>
                            </button>

                        </td>
                    </tr>
                </form>

                <?php
            } ?>

            <th scope="row">#</th>
            <td>Total</td>
            <td>R$ <?= $formatacao -> formatarValor($saldoTotal) ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>

            </tbody>
        </table>

    </main>

    <footer>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
            integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

    </body>
    </html>

    <?php
} ?>