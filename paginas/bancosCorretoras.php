<!doctype html>
<html lang="pr-br">

<head>

  <title>Bancos e Corretoras</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body class="bg-success">

  <header class="container-fluid mt-2">

    <a href="../index.php" class="btn btn-close bg-light" name="fechar"></a>
    <a href="../index.php" class="text-light" style="text-decoration: none;">Fechar</a>

  </header>
  
<main class="container">

  <h1 class="text-center">Bancos e Corretoras</h1>

    <p>
        <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
            Novo Banco/Corretora
        </button>
    </p>
        
    <div style="min-height: 160px;">
        <div class="collapse collapse-horizontal" id="collapseWidthExample">
            <div class="card card-body" style="width: 500px;">

            <form action="../backEnd/interacaoUsuario/novoBancoCorretora.php" method="post" class="form hstack gap-3">

                <label for=""></label>
                <input type="text" class="container input-group-text" id="nome" placeholder="Nome:">
                <input type="number" class="container input-group-text" id="valor" placeholder="R$:." step="0.01">

                <input type="submit" class="container btn btn-dark" value="Criar">

            </form>
            
            </div>
        </div>
    </div>
        
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