<?php

require_once __DIR__ . "/../backEnd/verificacoes/VerificarLogin.php";
$login = new VerificarLogin();

if ($login->VerificarLogin()) {

    require_once __DIR__ . "/../backEnd/bancoDados/ExecucaoCodigoMySql.php";
    require_once __DIR__ . "/../backEnd/gerais/FormatacaoDados.php";
    require_once __DIR__ . "/../backEnd/gerais/ValorFinal.php";

    $formatacao = new FormatacaoDados();
    $execucao = new ExecucaoCodigoMySql();

    $execucao->timezone();

    if (isset($_GET['excluir']) and isset($_GET['bancoCorretora'])) {
        require_once __DIR__ . "/../backEnd/funcionalidades/ExcluirCartaoCredito.php";

        $exluir = new ExcluirCartaoCredito();
        $exluir->ExcluirCartaoCredito($_GET['bancoCorretora'], $login->getSessao());
        $exluir->Redirecionar('credito', true);
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

						<h2 class="pt-4">
							Cartões de Crédito
						</h2>

						<main class="container mb-5">
							<div class="container row mt-5 text-start">
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

											<div class="card card-body border border-dark bg-secondary"
											     style="width: 100%;">

												<form action="../backEnd/InteracaoFront/novoCartaoCredito.php"
												      method="POST"
												      class="form hstack gap-3">

													<select class="form-select" name="bancoCorretora" required>
														<option value="" selected> Banco | Corretora</option>

                                                        <?php

                                                        $execucao->setCodigoMySql("SELECT * FROM dbName.bancosCorretoras WHERE email LIKE '" . $login->getSessao() . "';");
                                                        $resultadoExecucao = $execucao->ExecutarCodigoMySql();

                                                        while ($dadosBancosCorretoras = mysqli_fetch_assoc($resultadoExecucao)) {
                                                            $bancoCorretora = $dadosBancosCorretoras['bancoCorretora'];

                                                            ?>

															<option value="<?= $bancoCorretora ?>"><?= $bancoCorretora ?></option>

                                                            <?php
                                                        } ?>

													</select>

													<input type="number" class="container input-group-text" name="valor"
													       placeholder="Limite:" step="0.01" required>
													<input type="number" class="container input-group-text"
													       name="fechamento"
													       placeholder="fechamento" max="31" min="1" step="1" required>
													<input type="number" class="container input-group-text"
													       name="vencimento"
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
											<p style="font-size: medium; margin: 0;">Não sabe o valor das parcelas?
												<br/>Coloque o valor total do gasto (Com juros, se tiver), e
												no final coloque um * (Asterisco) para calcularmos para você!</p>
											<div class="card card-body border border-dark bg-secondary"
											     style="width: 100%;">
												<form action="../backEnd/InteracaoFront/novoCredito.php" method="POST"
												      class="form hstack gap-3">
													<select class="form-select" name="cartaoCredito" required>
														<option value="" selected>Cartão</option>

                                                        <?php

                                                        $execucao->setCodigoMySql("SELECT * FROM dbName.cartoesCredito WHERE email LIKE '" . $login->getSessao() . "';");
                                                        $resultadoExecucao = $execucao->ExecutarCodigoMySql();
                                                        while ($dadosCartoesCredito = mysqli_fetch_assoc($resultadoExecucao)) {

                                                            $bancoCorretora = $dadosCartoesCredito['bancoCorretora'];

                                                            ?>

															<option value="<?= $bancoCorretora ?>"><?= $bancoCorretora ?></option>


                                                            <?php
                                                        } ?>
													</select>

													<select class="form-select" name="classificacao" required>
														<option value="" selected>Classificação</option>
														<option value="Pessoal">Pessoal</option>
														<option value="Necessário">Necessário</option>
														<option value="Reserva">Reserva</option>
														<option value="Dívidas">Dívidas</option>
														<option value="Investimentos">Investimentos</option>
														<option value="Boas Ações">Boas Ações</option>
													</select>

													<input type="date" class="container input-group-text"
													       name="dataCompraPagamento"
													       value="<?= date('Y-m-d') ?>" required>
													<input type="text" class="container input-group-text" name="valor"
													       placeholder="Valor"
													       step="0.01" value="" required>
													<input type="number" class="container input-group-text"
													       name="parcelas"
													       title="Quantidade de Parcelas" step="1" min="1" value="1"
													       required>

													<input type="submit" class="container btn btn-dark"
													       value="Creditar">

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

                                $execucao->setCodigoMySql("SELECT * FROM dbName.cartoesCredito WHERE email LIKE '" . $login->getSessao() . "';");
                                $resultadoExecucao = $execucao->ExecutarCodigoMySql();

                                $quantidade = 0;
                                $limiteTotal = 0;

                                while ($dadosCartoesCredito = mysqli_fetch_assoc($resultadoExecucao)) {

                                    $valorFinal = new ValorFinal('cartaoCredito', $dadosCartoesCredito['bancoCorretora']);

                                    $quantidade++;
                                    $bancoCorretora = $dadosCartoesCredito['bancoCorretora'];
                                    $fechamento = $dadosCartoesCredito['fechamento'];
                                    $vencimento = $dadosCartoesCredito['vencimento'];
                                    $limite = floatval($valorFinal->ValorFinal('cartaoCredito', $dadosCartoesCredito['bancoCorretora']));
                                    $limiteTotal += $limite;


                                    ?>

									<form action="../backEnd/InteracaoFront/editarCartaoCredito.php" method="POST">
										<tr>
											<th scope="row"><?= $quantidade ?>º</th>
											<td>
												<input type="text" class="container input-group-text" name="bancoCorretora"
												       placeholder="Nome:"
												       value="<?= $bancoCorretora ?>" required>
											</td>
											<td>
												<input type="text" class="container input-group-text" name="valor"
												       placeholder="Limite:"
												       value="R$ <?= $formatacao->formatarValor($dadosCartoesCredito['limite']) ?>">
											</td>
											<td>
												<input type="text" class="container input-group-text" name=""
												       placeholder="Limite:"
												       value="R$ <?= $formatacao->formatarValor($limite) ?>" disabled>
											</td>
											<td>
												<input type="number" class="container input-group-text"
												       name="fechamento"
												       placeholder="Fechamento:" step="1" max="31" min="1"
												       value="<?= $fechamento ?>">
											</td>
											<td>
												<input type="number" class="container input-group-text"
												       name="vencimento"
												       placeholder="Vencimento:" step="0.01" min="1"
												       value="<?= $vencimento ?>">
											</td>
											<td>
												<button style="text-decoration: none; width: 4vh; height: 4vh;"
												        class="text-primary bg-transparent rounded-circle border border-primary"
												        name="bancoCorretoraId"
												        value="<?= $bancoCorretora ?>">
													<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
													     fill="currentColor"
													     class="bi bi-pen" viewBox="0 0 16 16">
														<path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
													</svg>
												</button>

												<a href="?excluir=true&bancoCorretora=<?= $bancoCorretora ?>"
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
								<td>R$ <?= $formatacao->formatarValor($limiteTotal) ?></td>
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
	<script src="../js/javaScript.js"></script>
	<script>
        window.addEventListener('DOMContentLoaded', (event) => {
            setMinHeight()
        });

        window.addEventListener('resize', (event) => {
            setMinHeight()
        });
	</script>
	</body>
	</html>


<?php } ?>