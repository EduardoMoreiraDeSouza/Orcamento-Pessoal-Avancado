<?php

require_once __DIR__ . "/../backEnd/funcionalidades/VerificarLogin.php";
$login = new VerificarLogin();

if ($login -> VerificarLogin()) {

require_once __DIR__ . "/../backEnd/gerais/FormatacaoDados.php";

$classes = new FormatacaoDados();
$codigoMySql = "SELECT * FROM orcamentoPessoal.bancoscorretoras WHERE cpf LIKE '". $classes -> getSessao() ."';";
$classes -> setCodigoMySql($codigoMySql);
$resultadoExecucao = $classes -> ExecutarCodigoMySql();

if (
    isset($_GET['excluir']) and
    $_GET['excluir'] and
    isset($_GET['nome'])
) {

    require_once __DIR__ . "/../backEnd/funcionalidades/ExcluirBancoCorretora.php";
    $exluir = new ExcluirBancoCorretora();
    $exluir -> ExcluirBancoCorretora($_GET['nome'], $classes -> getSessao());
    $classes -> Redirecionar('bancosCorretoras', true);

}

date_default_timezone_set('America/Sao_Paulo');

?>

<!doctype html>
<html lang="pr-br">

<head>

  <title>Bancos e Corretoras</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body class="bg-success d-grid vh-100">

    <header class="container-fluid mt-2">

        <a href="../index.php" class="btn btn-close bg-light"></a>
        <a href="../index.php" class="text-light" style="text-decoration: none;">Fechar</a>

    </header>

    <main class="container w-75 bg-light p-5 rounded border border-secondary shadow-lg">

      <h1 class="text-center">Bancos e Corretoras</h1>

        <div class="container row mt-5">

            <div class="col-auto">
                <p>
                    <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#novoBancoCorretora" aria-expanded="false" aria-controls="collapseWidthExample">
                        Novo Banco | Corretora
                    </button>
                </p>

                <div style="min-height: auto;" class="mb-4">

                    <div class="collapse collapse-horizontal" id="novoBancoCorretora">

                        <div class="card card-body border border-dark bg-secondary" style="width: 500px;">

                            <form action="../backEnd/interacaoComUsuario/novoBancoCorretora.php" method="POST" class="form hstack gap-3">

                                <input type="text" class="container input-group-text" name="nome" placeholder="Nome:" required>
                                <input type="text" class="container input-group-text" name="saldo" placeholder="Saldo:" step="0.01" value="R$ ">

                                <input type="submit" class="container btn btn-dark" value="Criar">

                            </form>

                        </div>
                    </div>
                </div>

            </div>

            <div class="col-auto">

                <p>
                    <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#novoDebito" aria-expanded="false" aria-controls="collapseWidthExample">
                        Novo Débito
                    </button>
                </p>

                <div style="min-height: auto;" class="mb-3">

                    <div class="collapse collapse-horizontal" id="novoDebito">

                        <div class="card card-body border border-dark bg-secondary" style="width: 700px;">

                            <form action="../backEnd/interacaoComUsuario/novoDebito.php" method="POST" class="form hstack gap-3">


                                <select class="form-select" name="bancoCorretora" required>

                                    <option value="" selected>Banco | Corretora</option>

                                    <?php

                                    while ($dadosBancosCorretoras = mysqli_fetch_assoc($resultadoExecucao)) {

                                        $nome = $dadosBancosCorretoras['nome'];

                                    ?>

                                        <option value="<?= $nome ?>"><?= $nome ?></option>


                                    <?php }  ?>

                                </select>

                                <select class="form-select" name="clasificacao" required>
                                    <option value="" selected>Classificação</option>
                                    <option value="pessoal">Pessoal</option>
                                    <option value="nescessario">Necessário</option>
                                    <option value="reserva">Reserva</option>
                                    <option value="dividas">Dívidas</option>
                                    <option value="arca">A.R.C.A</option>
                                    <option value="boasAcoes">Boas Ações</option>
                                </select>

                                <input type="date" class="container input-group-text" name="dataEfetivacao" value="<?=date('Y-m-d')?>" required>

                                <input type="text" class="container input-group-text" name="valor" placeholder="Valor" step="0.01" value="" required>

                                <input type="submit" class="container btn btn-dark" value="Debitar">

                            </form>

                        </div>
                    </div>
                </div>

            </div>

            <div class="col-auto">

                <p>
                    <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#novaReceita" aria-expanded="false" aria-controls="collapseWidthExample">
                        Nova Receita
                    </button>
                </p>

                <div style="min-height: auto;" class="mb-3">

                    <div class="collapse collapse-horizontal" id="novaReceita">

                        <div class="card card-body border border-dark bg-secondary" style="width: 700px;">

                            <form action="../backEnd/interacaoComUsuario/novaReceita.php" method="POST" class="form hstack gap-3">


                                <select class="form-select" name="bancoCorretora" required>

                                    <option value="" selected>Banco | Corretora</option>

                                    <?php

                                    $classes -> setCodigoMySql($codigoMySql);
                                    $resultadoExecucao = $classes -> ExecutarCodigoMySql();
                                    
                                    while ($dadosBancosCorretoras = mysqli_fetch_assoc($resultadoExecucao)) {

                                        $nome = $dadosBancosCorretoras['nome'];

                                        ?>

                                        <option value="<?= $nome ?>"><?= $nome ?></option>


                                    <?php }  ?>

                                </select>

                                <select class="form-select" name="clasificacao" required>
                                    <option value="" selected>Classificação</option>
                                    <option value="salario">Salário</option>
                                    <option value="rendimentos">Rendimentos</option>
                                    <option value="empreendimentos">Empreendimentos</option>
                                    <option value="terceiros">Terceiros</option>
                                </select>

                                <input type="date" class="container input-group-text" name="dataEfetivacao" value="<?=date('Y-m-d')?>" required>

                                <input type="text" class="container input-group-text" name="valor" placeholder="Valor" step="0.01" value="" required>

                                <input type="submit" class="container btn btn-dark" value="Debitar">

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
                    <th scope="col">Banco | Corretora</th>
                    <th scope="col">Saldo</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>

            <?php

            $classes -> setCodigoMySql($codigoMySql);
            $resultadoExecucao = $classes -> ExecutarCodigoMySql();

            $quantidade = 0;
            $saldoTotal = 0;

            while ($dadosBancosCorretoras = mysqli_fetch_assoc($resultadoExecucao)) {

                $quantidade++;
                $nome = $dadosBancosCorretoras['nome'];
                $saldoTotal += $dadosBancosCorretoras['saldo'];
                $saldo = $classes -> formatarValor($dadosBancosCorretoras['saldo']);

            ?>

            <form action="../backEnd/interacaoComUsuario/editarBancoCorretora.php" method="POST">
                <tr>
                    <th scope="row"><?= $quantidade ?>º</th>
                    <td>
                        <input type="text" class="container input-group-text" name="nome" placeholder="Nome:" value="<?= $nome ?>" required>
                    </td>
                    <td>
                        <input type="text" class="container input-group-text" name="saldo" placeholder="Saldo:" step="0.01" value="R$ <?= $saldo ?>">
                    </td>
                    <td>
                        <button style="text-decoration: none;" class="text-primary bg-transparent" name="nameId" value="<?= $nome ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                            </svg>
                        </button>

                        <button type="button" style="text-decoration: none;" class="text-primary bg-transparent">
                            <a href="?excluir=true&nome=<?= $nome ?>" style="text-decoration: none;" class="text-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
                                    <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
                                    <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z"/>
                                </svg>
                            </a>
                        </button>

                    </td>
                </tr>
            </form>

            <?php } ?>

            <th scope="row">#</th>
            <td>Total</td>
            <td>R$ <?= $classes -> formatarValor($saldoTotal) ?></td>
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

<?php } ?>