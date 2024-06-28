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
						<a class="nav-link text-light" href="#">Investimentos</a>
					</li>
					<li class="nav-item h6">
						<a class="nav-link text-light" href="#">Rendimentos</a>
					</li>
					<li class="nav-item h6">
						<a class="nav-link active text-light" aria-current="page"
						   href="./backEnd/InteracaoFront/sair.php">Sair</a>
					</li>

				</ul>

                <?php } ?>

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
					</ul>
				</div>
			</div>
		</div>

        <?php } ?>

	</section>
</div>

<footer class="bg-dark text-light">
	<div class="container-fluid py-3 text-center">
		<ul class="list-group">
			<li class="list-group-link">
				<a href="https://www.instagram.com/moreira.sza" target="_blank" style="text-decoration: none;">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
					     class="bi bi-instagram" viewBox="0 0 16 16">
						<path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
					</svg>
					Instagram
				</a>
				<a href="https://wa.me/+5531993359455" target="_blank"
				   style="text-decoration: none; margin-right: 10px; margin-left: 10px;">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
					     class="bi bi-whatsapp" viewBox="0 0 16 16">
						<path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
					</svg>
					Whatsapp
				</a>
				<a href="https://www.linkedin.com/in/eduardo-moreira-a0980a157/" target="_blank"
				   style="text-decoration: none;">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
					     class="bi bi-linkedin" viewBox="0 0 16 16">
						<path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
					</svg>
					LinkedIn
				</a>
			</li>
		</ul>
	</div>
	<div class="text-center" style="background-color: #333; padding: 10px;">
		By Eduardo Moreira
	</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>
</body>
</html>