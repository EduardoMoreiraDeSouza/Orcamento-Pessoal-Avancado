<!doctype html>
<html lang="pr-br">

<head>

    <title>Cadastrar</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body class="bg-success d-grid vh-100">

<header class="container-fluid mt-2 h-50">

    <a href="../index.php" class="btn btn-close bg-light"></a>
    <a href="../index.php" class="text-light" style="text-decoration: none;">Fechar</a>

</header>

<main class="container w-50 bg-light p-5 rounded border border-secondary shadow-lg d-grid">

    <h1 class="text-center">Cadastrar</h1>

    <form class="mt-5" action="../backEnd/InteracaoFront/cadastrar.php" method="POST">

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Seu Email:</label>
            <input type="text" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Sua Senha:</label>
            <input type="password" name="senha" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary container-fluid">Cadastrar</button>

    </form>

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