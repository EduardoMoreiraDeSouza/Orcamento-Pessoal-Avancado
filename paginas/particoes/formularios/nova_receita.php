<div class="col-auto">

    <p>
        <button class="btn btn-dark" type="button" data-bs-toggle="collapse"
                data-bs-target="#novaReceita"
                aria-expanded="false" aria-controls="collapseWidthExample">
            Nova Receita
        </button>
    </p>

    <div style="min-height: auto;" class="mb-3">
        <div class="collapse collapse-horizontal" id="novaReceita">

            <p style="font-size: medium; margin: 0;">Não sabe o valor das parcelas?
                Insira um * (Asterisco) no início e coloque o valor total da receita (Com
	            juros, se tiver) Ex.: *100,00</p>

            <div class="card card-body border border-dark bg-secondary"
                 style="width: 100%;">
                <form action="../backEnd/InteracaoFront/novaReceita.php" method="POST"
                      class="form hstack gap-3">

	                <input type="text" class="container input-group-text" name="nome"
	                       placeholder="Nome:"
	                       required>

	                <select class="form-select" name="id" required>
		                <option value="" selected>Banco | Corretora</option>
                        <?php include(__DIR__ . '/../loops/nomes_bancos_corretoras.php') ?>
	                </select>

                    <select class="form-select" name="classificacao" required>
                        <option value="" selected>Classificação</option>
                        <option value="Salário">Salário</option>
                        <option value="Rendimentos">Rendimentos</option>
                        <option value="Empreendimentos">Empreendimentos</option>
                        <option value="Emprestimos">Empréstimos</option>
                        <option value="Reserva">Reserva</option>
                        <option value="Outros">Outros</option>
                    </select>
                    <input type="date" class="container input-group-text"
                           name="dataCompraPagamento"
                           value="<?= date('Y-m-d') ?>" required>
                    <input type="text" class="container input-group-text" name="valor"
                           placeholder="Valor"
                           required>
                    <input type="number" class="container input-group-text"
                           name="parcelas"
                           title="Quantidade de Parcelas" step="1" min="0" value="1">
                    <input type="submit" class="container btn btn-dark"
                           value="Depositar">

                </form>
            </div>
        </div>
    </div>
</div>
