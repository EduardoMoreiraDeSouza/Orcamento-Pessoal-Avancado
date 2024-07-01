<div class="col-auto">

	<p>
		<button class="btn btn-danger" type="button" data-bs-toggle="collapse"
		        data-bs-target="#novoGastoCredito" aria-expanded="false"
		        aria-controls="collapseWidthExample">
			Novo Gasto no Crédito
		</button>
	</p>

	<div style="min-height: auto;" class="mb-3">

		<div class="collapse collapse-horizontal" id="novoGastoCredito">
			<p style="font-size: medium; margin: 0;">Não sabe o valor das parcelas?
				Insira um * (Asterisco) no início e coloque o valor total do gasto (Com
				juros, se tiver) Ex.: *100,00</p>
			<div class="card card-body border border-dark bg-secondary"
			     style="width: 100%;">
				<form action="../backEnd/InteracaoFront/novoCredito.php" method="POST"
				      class="form hstack gap-3">
					<select class="form-select" name="id" required>

						<option value="" selected>Cartão</option>
						<?php include(__DIR__ . '/../loops/nomes_cartoes_credito.php') ?>

					</select>

					<?php include(__DIR__ . '/../classificacao/tipos_gastos.php') ?>

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