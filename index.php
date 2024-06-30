<?php

require_once __DIR__ . "/./backEnd/site/Globais.php";
$globais = new Globais;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
	      integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
	      crossorigin="anonymous">

	<link href="./css/style.css" rel="stylesheet">

	<title>Orçamento Pessoal</title>

</head>
<body>

<nav class="navbar navbar-dark bg-dark fixed-top">
	<div class="container-fluid">
		<a class="navbar-brand" href="./index.php">< Orçamento Pessoal ></a>

        <?php if (!empty($globais->getSessao())) { ?>

			<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
			        data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
			        aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

        <?php } ?>

		<div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
		     aria-labelledby="offcanvasDarkNavbarLabel">

			<div class="offcanvas-header">
				<h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">< Orçamento Pessoal ></h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
				        aria-label="Close"></button>
			</div>

			<div class="offcanvas-body">
				<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">

                    <?php if (!empty($globais->getSessao())) { ?>

					<li class="nav-item h6">
						<a class="nav-link text-light" href="./paginas/bancosCorretoras.php">Bancos/Corretoras</a>
					</li>
					<li class="nav-item h6">
						<a class="nav-link text-light" href="./paginas/receitas.php">Receitas</a>
					</li>
					<li class="nav-item h6">
						<a class="nav-link text-light" href="./paginas/gastos.php">Gastos</a>
					</li>
					<li class="nav-item h6">
						<a class="nav-link text-light" href="./paginas/credito.php">Cartões de Crédito</a>
					</li>
                    <li class="nav-item h6">
	                    <a class="nav-link text-light" href="#">Reserva de Emergência (Em Breve)</a>
                    </li>
					<li class="nav-item h6">
						<a class="nav-link text-light" href="#">Investimentos (Em Breve)</a>
					</li>
					<li class="nav-item h6">
						<a class="nav-link text-light" href="#">Rendimentos (Em Breve)</a>
					</li>
					<li class="nav-item h6">
						<a class="nav-link active text-light" aria-current="page"
						   href="./backEnd/InteracaoFront/sair.php">Sair</a>
					</li>

                    <?php } ?>

					<li class="nav-item h6">
						<a class="nav-link text-light" href="dev/index.php">Desenvolvedor</a>
					</li>

				</ul>

			</div>
		</div>
	</div>
</nav>

<div class="box">
	<section class="banner">
		<div class="overlay"></div>

		<?php if (empty($globais->getSessao())) { ?>

		<div class="container chamada-banner introducao">
			<div class="row">
				<div class="row-md-12 text-center ">
					<h2 class="pt-4">
						Orçamento Pessoal
					</h2>
					<p>Para que você tenha uma melhor vida financeira.</p>
					<ul class="container" style="list-style-type: none;">
						<li class="pt-3">
							<a class="nav-link active text-light entrar" aria-current="page"
							   href="./paginas/entrar.php">
								Entrar
							</a>
						</li>
						<li class="pt-2 mb-5">
							<a class="nav-link active text-light cadastrar" aria-current="page"
							   href="./paginas/cadastrar.php">
								Cadastrar
							</a>
						</li>
						<li class="pt-2 mb-5">
							<a class="nav-link active text-light cadastrar" aria-current="page"
							   href="dev/index.php">
								Desenvolvedor
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>

        <?php } ?>

	</section>
</div>

<?php include(__DIR__ . "/./paginas/particoes/rodape/rodape_e_script_js.php") ?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>
</body>
</html>