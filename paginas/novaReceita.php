<?php

require __DIR__ . "/../backEnd/verificacoes/VerificarLogin.php";
$login = new VerificarLogin();

if ($login -> VerificarLogin()) {
	require __DIR__ . "/../backEnd/bancoDados/ExecucaoCodigoMySql.php";
	$_SESSION['pagina_pai'] = 'receitas';

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

		<title>Orçamento Pessoal - Nova Receita</title>

	</head>

	<body>

	<?php require(__DIR__ . "/./particoes/menu/menu.php"); ?>

	<div class="box">
		<section class="banner" id="banner">
			<div class="overlay"></div>
			<div class="container chamada-banner introducao">
				<div class="row">
					<div class="row-md-12 text-center">

						<h2 class="pt-4">
							Nova Receita
						</h2>

						<form class="form-inline w-75 container" action="../backEnd/InteracaoFront/novaReceita.php" method="post">

							<div class="form-group">
								<label for="">Banco / Corretora:</label>
								<select class="form-select" name="id" required>
									<option value="" selected>Banco | Corretora</option>
									<?php include(__DIR__ . '/./particoes/loops/nomes_bancos_corretoras.php') ?>
								</select>
							</div>

							<div class="form-group">
								<label for="">Nome:</label>
								<input type="text" class="form-control input-group-text" name="nome"
								       placeholder="Nome:" >
							</div>

							<div class="form-group">
								<label for="">Valor:</label>
								<input type="text" class="form-control input-group-text" name="valor"
								       placeholder="Valor:">
							</div>

							<div class="form-group">
								<label>Classificação:</label>
								<select class="form-select text-center" name="classificacao" required>
									<option value="Salário">
										Salário
									</option>
									<option value="Rendimentos">
										Rendimentos
									</option>
									<option value="Empreendimentos">
										Empreendimentos
									</option>
									<option value="Emprestimos">
										Emprestimos
									</option>
									<option value="Reserva">
										Reserva
									</option>
									<option value="Outros">
										Outros
									</option>
									<option value="Correção do Saldo">
										Correção do Saldo
									</option>
								</select>
							</div>

							<div class="form-group">
								<label>Parcelas:</label>
								<input type="text" class="form-control input-group-text" name="parcelas"
								       placeholder="Parcelas:" step="0.01">
							</div>
							<div class="form-group">
								<label>Data do Pagamento:</label>
								<input type="date" class="form-control input-group-text text-center"
								       name="dataCompraPagamento" value="<?= date('Y-m-d') ?>">
							</div>

							<button type="submit" class="btn btn-primary">
								Nova Receita
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