<?php

require __DIR__ . "/../backEnd/verificacoes/VerificarLogin.php";
$login = new VerificarLogin();

if ($login -> VerificarLogin()) {
	$_SESSION['pagina_pai'] = 'gastos';

	require __DIR__ . "/../backEnd/bancoDados/ExecucaoCodigoMySql.php";
	require __DIR__ . "/../backEnd/gerais/FormatacaoDados.php";

	$formatacao = new FormatacaoDados();

	?>

	<!DOCTYPE html>
	<html lang="pt-br">
	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
		      integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
		      crossorigin="anonymous">

		<link href="../css/style.css" rel="stylesheet">

		<title>Orçamento Pessoal - Editar Gasto</title>

	</head>

	<body>
	<nav class="navbar navbar-dark bg-dark fixed-top">
		<div class="container-fluid">
			<a class="navbar-brand" href="../index.php">< Orçamento Pessoal ></a>

			<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
			        data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
			        aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
			     aria-labelledby="offcanvasDarkNavbarLabel">

				<div class="offcanvas-header">
					<h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">< Receitas ></h5>
					<button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
					        aria-label="Close"></button>
				</div>

				<div class="offcanvas-body">
					<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">

						<li class="nav-item h6">
							<a class="nav-link text-light" href="../paginas/bancosCorretoras.php">Bancos/Corretoras</a>
						</li>
						<li class="nav-item h6">
							<a class="nav-link text-light" href="../paginas/gastos.php">Gastos</a>
						</li>
						<li class="nav-item h6">
							<a class="nav-link text-light" href="../paginas/cartaoCredito.php">Cartões de Crédito</a>
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
							   href="../backEnd/InteracaoFront/sair.php">Sair</a>
						</li>

					</ul>

				</div>
			</div>
		</div>
	</nav>

	<div class="box">
		<section class="banner" id="banner">
			<div class="overlay"></div>
			<div class="container chamada-banner introducao">
				<div class="row">
					<div class="row-md-12 text-center">

						<h2 class="pt-4">
							Editar Gasto
						</h2>

						<?php

						$dados = new ObterDadosGastos();

						if (isset($_POST['id']) and !empty($_POST['id'])) {
							$dados = $dados -> ObterDadosGastos($dados -> getSessao(), $_POST['id'])[0];
						}

						else {
							$dados -> Redirecionar($_SESSION['pagina_pai'], true);
						}

						?>

						<form class="form-inline w-75 container" action="../backEnd/InteracaoFront/editarGastos.php" method="post">

							<div class="form-group">
								<label for="">Banco / Corretora:</label>
								<select class="form-select text-center" name="bancoCorretoraId" required>
									<?php include(__DIR__ . "/./particoes/loops/nomes_bancos_corretoras_select.php") ?>
								</select>
							</div>

							<div class="form-group">
								<label for="">Nome:</label>
								<input type="text" class="form-control input-group-text" name="nome"
								       placeholder="Nome:"
								       value="<?= $dados['nome'] ?>">
							</div>

							<div class="form-group">
								<label for="">Valor:</label>
								<input type="text" class="form-control input-group-text" name="valor"
								       placeholder="Valor:"
								       value="R$ <?= $formatacao -> formatarValor($dados['valor']) ?>">
							</div>

							<div class="form-group">
								<label for="">Forma de Pagamento:</label>
								<select class="form-select text-center" name="formaPagamento" required>
									<option value="Débito" <?= $dados['formaPagamento'] == 'Débito' ? 'selected' : '' ?>>
										Débito
									</option>
									<option value="Crédito" <?= $dados['formaPagamento'] == 'Crédito' ? 'selected' : '' ?>>
										Crédito
									</option>
								</select>
							</div>

							<div class="form-group">
								<label>Classificação:</label>
								<select class="form-select text-center" name="classificacao" required>
									<option value="Pessoal" <?= $dados['classificacao'] == 'Pessoal' ? 'selected' : '' ?>>
										Pessoal
									</option>
									<option value="Necessário" <?= $dados['classificacao'] == 'Necessário' ? 'selected' : '' ?>>
										Necessário
									</option>
									<option value="Reserva" <?= $dados['classificacao'] == 'Reserva' ? 'selected' : '' ?>>
										Reserva
									</option>
									<option value="Dívidas" <?= $dados['classificacao'] == 'Dívidas' ? 'selected' : '' ?>>
										Dívidas
									</option>
									<option value="Investimentos" <?= $dados['classificacao'] == 'Investimentos' ? 'selected' : '' ?>>
										Investimentos
									</option>
									<option value="Boas Ações" <?= $dados['classificacao'] == 'Boas Ações' ? 'selected' : '' ?>>
										Boas
										Ações
									</option>
									<option value="Boas Ações" <?= $dados['classificacao'] == 'Correção do Saldo' ? 'selected' : '' ?>>
										Correção do Saldo
									</option>
								</select>
							</div>

							<div class="form-group">
								<label>Parcelas:</label>
								<input type="text" class="form-control input-group-text" name="parcelas"
								       placeholder="Parcelas:" step="0.01" value="<?= $dados['parcelas'] ?>">
							</div>
							<div class="form-group">
								<label>Data do Pagamento:</label>
								<input type="date" class="form-control input-group-text text-center"
								       name="dataCompraPagamento" value="<?= $dados['dataCompraPagamento'] ?>">
							</div>

							<button type="submit" class="btn btn-primary" name="id" value="<?= $dados['id_gasto'] ?>">
								Editar
							</button>
						</form>
					</div>
				</div>
			</div>
		</section>
	</div>

	<?php include(__DIR__ . "/./particoes/rodape/rodape_e_script_js.php") ?>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
	        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
	</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
	        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
	</script>
	<script src="../js/javaScript.js"></script>

	</body>
	</html>


<?php } ?>