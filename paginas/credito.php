<?php

require_once __DIR__ . "/../backEnd/verificacoes/VerificarLogin.php";
$login = new VerificarLogin();

if ($login -> VerificarLogin()) {

	require_once __DIR__ . "/../backEnd/bancoDados/ExecucaoCodigoMySql.php";
	require_once __DIR__ . "/../backEnd/gerais/FormatacaoDados.php";
	require_once __DIR__ . "/../backEnd/gerais/ValorFinal.php";

	$formatacao = new FormatacaoDados();

	if (isset($_GET['excluir']) and isset($_GET['bancoCorretora'])) {
		require_once __DIR__ . "/../backEnd/funcionalidades/ExcluirCartaoCredito.php";

		$exluir = new ExcluirCartaoCredito();
		$exluir -> ExcluirCartaoCredito($_GET['id'], $login -> getSessao());
		$exluir -> Redirecionar('credito', true);
	}

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

		<title>Orçamento Pessoal - Cartões de Crédito</title>

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
					<h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">< Cartões de Crédito ></h5>
					<button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
					        aria-label="Close"></button>
				</div>

				<div class="offcanvas-body">
					<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">

						<li class="nav-item h6">
							<a class="nav-link text-light" href="../paginas/bancosCorretoras.php">Bancos/Corretoras</a>
						</li>
						<li class="nav-item h6">
							<a class="nav-link text-light" href="../paginas/receitas.php">Receitas</a>
						</li>
						<li class="nav-item h6">
							<a class="nav-link text-light" href="../paginas/gastos.php">Gastos</a>
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
					<div class="row-md-12 text-center ">

						<?php include(__DIR__ . "/./particoes/formularios/form_data_referencia.php") ?>

						<h2 class="pt-4">
							Cartões de Crédito
						</h2>

						<main class="container mb-5">

							<div class="container row mt-5 text-start">

								<?php include(__DIR__ . "/./particoes/formularios/novo_cartao_credito.php") ?>
								<?php include(__DIR__ . "/./particoes/formularios/novo_gasto_credito.php") ?>
								<?php include(__DIR__ . "/./particoes/formularios/novo_banco_corretora.php") ?>

							</div>

							<table class="table table-dark text-center">

								<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Cartão</th>
									<th scope="col">Limite</th>
									<th scope="col">Limite Restante</th>
									<th scope="col">Fatura</th>
									<th scope="col">Fechamento</th>
									<th scope="col">Vencimento</th>
									<th scope="col">Ações</th>
								</tr>
								</thead>
								<tbody>

								<form class="form-inline" method="post">
									<tr class="form-group">
										<th>*</th>
										<td><?php include(__DIR__ . "/./particoes/filtros/select_filtrar_banco_corretora.php") ?></td>
										<td><?php include(__DIR__ . "/./particoes/filtros/select_filtrar_limite.php") ?></td>
										<td>*</td>
										<td>*</td>
										<td><?php include(__DIR__ . "/./particoes/filtros/select_filtrar_fechamento.php") ?></td>
										<td><?php include(__DIR__ . "/./particoes/filtros/select_filtrar_vencimento.php") ?></td>
										<td><?php include(__DIR__ . "/./particoes/botoes/submit_filtros.php") ?></td>
									</tr>
								</form>

								<?php

								$execucao = new ExecucaoCodigoMySql();
								$execucao -> setCodigoMySql("SELECT * FROM dbName.cartoesCredito WHERE email LIKE '" . $login -> getSessao() . "' " . $_SESSION['codigo_variante'] . ";");
								$resultadoExecucao = $execucao -> ExecutarCodigoMySql();
								$dataReferencia = $_SESSION['ano_referencia'] . "-" . $_SESSION['mes_referencia'] . "-" . $execucao -> ultimoDiaMes($_SESSION['mes_referencia'], $_SESSION['ano_referencia']);
								$quantidade = 0;
								$limiteTotal = 0;
								$faturaTotal = 0;

								while ($dadosCartoesCredito = mysqli_fetch_assoc($resultadoExecucao)) {

									$valorFinal = new ValorFinal('cartaoCredito', $dadosCartoesCredito['id'], $dataReferencia);

									$quantidade++;
									$fatura = 0;
									$gastos = $valorFinal-> ObterDadosGastos($valorFinal-> getSessao(), $dadosCartoesCredito['id']);

									$contador = 0;
									if ($gastos)
										foreach ($gastos as $ignored) {
											$parcelasPagas = $valorFinal -> parcelasPagasCredito($gastos[$contador], $dataReferencia);

											if ($parcelasPagas <= $gastos[$contador]['parcelas'] and $parcelasPagas > 0)
												$fatura += $gastos[$contador]['valor'];
											$contador++;
										}

									$limite = floatval($valorFinal -> ValorFinal('cartaoCredito', $dadosCartoesCredito['bancoCorretora'], $dataReferencia)) - $fatura;
									$limiteTotal += $limite;
									$faturaTotal += $fatura;

									?>

									<form action="../backEnd/InteracaoFront/editarCartaoCredito.php" method="POST">
										<tr>
											<th scope="row"><?= $quantidade ?>º</th>
											<td>
												<input type="text" class="container input-group-text"
												       name="bancoCorretora"
												       placeholder="Nome:"
												       value="<?= $dadosCartoesCredito['bancoCorretora'] ?>" required>
											</td>
											<td>
												<input type="text" class="container input-group-text" name="valor"
												       placeholder="Limite:"
												       value="R$ <?= $formatacao -> formatarValor($dadosCartoesCredito['limite']) ?>">
											</td>
											<td>
												<input type="text" class="container input-group-text" name=""
												       placeholder=""
												       value="R$ <?= $formatacao -> formatarValor($limite) ?>" disabled>
											</td>
											<td>
												<input type="text" class="container input-group-text" name=""
												       placeholder=""
												       value="R$ <?= $formatacao -> formatarValor($fatura) ?>" disabled>
											</td>
											<td style="width: 8%;">
												<input type="number" class="container input-group-text"
												       name="fechamento"
												       placeholder="Fechamento:" step="1" max="31" min="1"
												       value="<?= $dadosCartoesCredito['fechamento'] ?>">
											</td>
											<td style="width: 8%;">
												<input type="number" class="container input-group-text"
												       name="vencimento"
												       placeholder="Vencimento:" step="0.01" min="1"
												       value="<?= $dadosCartoesCredito['vencimento'] ?>">
											</td>
											<td>
												<button style="text-decoration: none; width: 4vh; height: 4vh;"
												        class="text-primary bg-transparent rounded-circle border border-primary"
												        name="bancoCorretoraId"
												        value="<?= $dadosCartoesCredito['id'] ?>">
													<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
													     fill="currentColor"
													     class="bi bi-pen" viewBox="0 0 16 16">
														<path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
													</svg>
												</button>

												<a href="?excluir=true&id=<?= $dadosCartoesCredito['id'] ?>"
												   style="text-decoration: none; margin-left: 0.8vh; width: 4vh; height: 4vh;"
												   class="text-danger rounded-circle border border-danger">
													<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
													     fill="currentColor" class="bi bi-trash"
													     viewBox="0 0 16 16">
														<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
														<path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
													</svg>
												</a>

											</td>
										</tr>
									</form>

									<?php
								} ?>

								<th scope="row">#</th>
								<td>Total</td>
								<td></td>
								<td>R$ <?= $formatacao -> formatarValor($limiteTotal) ?></td>
								<td>R$ <?= $formatacao -> formatarValor($faturaTotal) ?></td>
								<td></td>
								<td></td>
								<td></td>

								</tbody>
							</table>

						</main>

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