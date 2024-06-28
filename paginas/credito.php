<?php

require_once __DIR__ . "/../backEnd/verificacoes/VerificarLogin.php";
$login = new VerificarLogin();

if ($login -> VerificarLogin()) {

    require_once __DIR__ . "/../backEnd/bancoDados/ExecucaoCodigoMySql.php";
    require_once __DIR__ . "/../backEnd/gerais/FormatacaoDados.php";
    require_once __DIR__ . "/../backEnd/gerais/ValorFinal.php";

    $formatacao = new FormatacaoDados();
    $execucao = new ExecucaoCodigoMySql();

    $execucao -> timezone();

    if (isset($_GET['excluir']) and isset($_GET['nome'])) {
        require_once __DIR__ . "/../backEnd/funcionalidades/ExcluirCartaoCredito.php";

        $exluir = new ExcluirCartaoCredito();
        $exluir -> ExcluirCartaoCredito($_GET['nome'], $login -> getSessao());
        $exluir -> Redirecionar('credito', true);
    }

    ?>

    <!doctype html>
    <html lang="pr-br">

    <head>

        <title>Cartões de Crédito</title>

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

        <h1 class="text-center">Cartões de Crédito</h1>

        <div class="container row mt-5">
            <div class="col-auto">

                <p>
                    <button class="btn btn-dark" type="button" data-bs-toggle="collapse"
                            data-bs-target="#novoCartaoCredito" aria-expanded="false"
                            aria-controls="collapseWidthExample">
                        Novo Cartão de Crédito
                    </button>
                </p>

                <div style="min-height: auto;" class="mb-4">

                    <div class="collapse collapse-horizontal" id="novoCartaoCredito">

                        <div class="card card-body border border-dark bg-secondary" style="width: 1000px;">

                            <form action="../backEnd/InteracaoFront/novoCartaoCredito.php" method="POST"
                                  class="form hstack gap-3">

                                <select class="form-select" name="nome" required>
                                    <option value="" selected> Banco | Corretora</option>

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

                                <input type="number" class="container input-group-text" name="valor"
                                       placeholder="Limite:" step="0.01" required>
                                <input type="number" class="container input-group-text" name="fechamento"
                                       placeholder="fechamento" max="31" min="1" required>
                                <input type="number" class="container input-group-text" name="vencimento"
                                       placeholder="vencimento" max="31" min="1" required>

                                <input type="submit" class="container btn btn-dark" value="Criar">

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-auto">

                <p>
                    <button class="btn btn-dark" type="button" data-bs-toggle="collapse"
                            data-bs-target="#novoGastoCredito" aria-expanded="false"
                            aria-controls="collapseWidthExample">
                        Novo Gasto no Crédito
                    </button>
                </p>

                <div style="min-height: auto;" class="mb-3">

                    <div class="collapse collapse-horizontal" id="novoGastoCredito">
                        <p>Não sabe o valor das parcelas? <br/>Coloque o valor total do gasto (Com juros, se tiver), e
                            no final coloque um * (Asterisco) para calcularmos para você!</p>
                        <div class="card card-body border border-dark bg-secondary" style="width: 900px;">
                            <form action="../backEnd/InteracaoFront/novoCredito.php" method="POST"
                                  class="form hstack gap-3">
                                <select class="form-select" name="cartaoCredito" required>
                                    <option value="" selected>Cartão</option>

                                    <?php

                                    $execucao -> setCodigoMySql("SELECT * FROM dbName.cartoesCredito WHERE email LIKE '" . $login -> getSessao() . "';");
                                    $resultadoExecucao = $execucao -> ExecutarCodigoMySql();
                                    while ($dadosCartoesCredito = mysqli_fetch_assoc($resultadoExecucao)) {

                                        $nome = $dadosCartoesCredito['nome'];

                                        ?>

                                        <option value="<?= $nome ?>"><?= $nome ?></option>


                                        <?php
                                    } ?>
                                </select>

                                <select class="form-select" name="clasificacao" required>
                                    <option value="" selected>Classificação</option>
                                    <option value="Pessoal">Pessoal</option>
                                    <option value="Necessário">Necessário</option>
                                    <option value="Reserva">Reserva</option>
                                    <option value="Dívidas">Dívidas</option>
                                    <option value="Investimentos">Investimentos</option>
                                    <option value="Boas Ações">Boas Ações</option>
                                </select>

                                <input type="date" class="container input-group-text" name="dataCompraPagamento"
                                       value="<?= date('Y-m-d') ?>" required>
                                <input type="text" class="container input-group-text" name="valor" placeholder="Valor"
                                       step="0.01" value="" required>
                                <input type="number" class="container input-group-text" name="parcelas"
                                       title="Quantidade de Parcelas" step="1" min="1" value="1" required>

                                <input type="submit" class="container btn btn-dark" value="Creditar">

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-auto">
                <p>
                    <button class="btn btn-dark" type="button">
                        <a style="text-decoration: none" class="text-light" href="./gastos.php">Meus Gastos</a>
                    </button>
                </p>
            </div>

        </div>

        <table class="table table-dark text-center">

            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Cartão</th>
                <th scope="col">Limite</th>
                <th scope="col">Limite Restante</th>
                <th scope="col">Fechamento</th>
                <th scope="col">vencimento</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>

            <?php

            $execucao -> setCodigoMySql("SELECT * FROM dbName.cartoesCredito WHERE email LIKE '" . $login -> getSessao() . "';");
            $resultadoExecucao = $execucao -> ExecutarCodigoMySql();

            $quantidade = 0;
            $limiteTotal = 0;

            while ($dadosCartoesCredito = mysqli_fetch_assoc($resultadoExecucao)) {

                $valorFinal = new ValorFinal('cartaoCredito', $dadosCartoesCredito['nome']);

                $quantidade++;
                $nome = $dadosCartoesCredito['nome'];
                $fechamento = $dadosCartoesCredito['fechamento'];
                $vencimento = $dadosCartoesCredito['vencimento'];
                $limite = floatval($valorFinal -> ValorFinal('cartaoCredito', $dadosCartoesCredito['nome']));
                $limiteTotal += $limite;


                ?>

                <form action="../backEnd/InteracaoFront/editarCartaoCredito.php" method="POST">
                    <tr>
                        <th scope="row"><?= $quantidade ?>º</th>
                        <td>
                            <input type="text" class="container input-group-text" name="nome" placeholder="Nome:"
                                   value="<?= $nome ?>" required>
                        </td>
                        <td>
                            <input type="text" class="container input-group-text" name="valor" placeholder="Limite:"
                                   value="R$ <?= $dadosCartoesCredito['limite'] ?>">
                        </td>
                        <td>
                            <input type="text" class="container input-group-text" name="" placeholder="Limite:"
                                   value="R$ <?= $formatacao -> formatarValor($limite) ?>" disabled>
                        </td>
                        <td>
                            <input type="number" class="container input-group-text" name="fechamento"
                                   placeholder="Fechamento:" step="0.01" min="1" value="<?= $fechamento ?>">
                        </td>
                        <td>
                            <input type="number" class="container input-group-text" name="vencimento"
                                   placeholder="Vencimento:" step="0.01" min="1" value="<?= $vencimento ?>">
                        </td>
                        <td>
                            <button style="text-decoration: none;" class="text-primary bg-transparent" name="nomeId"
                                    value="<?= $nome ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                </svg>
                            </button>

                            <button type="button" style="text-decoration: none;" class="text-primary bg-transparent">
                                <a href="?excluir=true&nome=<?= $nome ?>" style="text-decoration: none;"
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
            <td></td>
            <td>R$ <?= $formatacao -> formatarValor($limiteTotal) ?></td>
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