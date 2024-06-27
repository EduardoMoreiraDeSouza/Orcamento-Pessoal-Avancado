<?php

require_once __DIR__ . "/./backEnd/site/Globais.php";
$globais = new Globais;

?>

<!doctype html>
<html lang="pt-br">

<head>

    <title>Orçamento Pessoal</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body class="bg-success">

<header class="container">

    <nav class="navbar navbar-expand-lg bg-body-tertiary text-secondary">

        <div class="container">

            <p class="navbar-brand text-light mt-0 h4">Orçamento Pessoal</p>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav">

                    <?php
                    if (empty($globais -> getSessao())) { ?>

                        <li class="nav-item h6">
                            <a class="nav-link active text-light" aria-current="page" href="paginas/cadastrar.php">Cadastrar</a>
                        </li>
                        <li class="nav-item h6">
                            <a class="nav-link active text-light" aria-current="page"
                               href="./paginas/entrar.php">Entrar</a>
                        </li>

                    <?php
                    } else { ?>

                        <li class="nav-item h6">
                            <a class="nav-link text-light" href="./paginas/bancosCorretoras.php">Bancos e Corretoras</a>
                        </li>
                        <li class="nav-item h6">
                            <a class="nav-link text-light" href="paginas/receitas.php">Receitas</a>
                        </li>
                        <li class="nav-item h6">
                            <a class="nav-link text-light" href="./paginas/gastos.php">Gastos</a>
                        </li>
                        <li class="nav-item h6">
                            <a class="nav-link text-light" href="./paginas/credito.php">Cartões de Crédito</a>
                        </li>
                        <li class="nav-item h6">
                            <a class="nav-link text-light" href="#">Investimentos</a>
                        </li>
                        <li class="nav-item h6">
                            <a class="nav-link text-light" href="#">Rendimentos</a>
                        </li>
                        <li class="nav-item h6">
                            <a class="nav-link active text-light" aria-current="page"
                               href="backEnd/InteracaoFront/sair.php">Sair</a>
                        </li>

                    <?php
                    } ?>

                    <li class="nav-item h6">
                        <a class="nav-link text-light" href="./dev/index.html">Desenvolvedor</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

</header>

<main>

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