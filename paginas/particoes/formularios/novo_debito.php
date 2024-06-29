<div class="col-auto">

    <p>
        <button class="btn btn-dark" type="button" data-bs-toggle="collapse"
                data-bs-target="#novoDebito"
                aria-expanded="false" aria-controls="collapseWidthExample">
            Novo Débito
        </button>
    </p>

    <div style="min-height: auto;" class="mb-3">
        <div class="collapse collapse-horizontal" id="novoDebito">

            <p style="font-size: medium; margin: 0;">Não sabe o valor das parcelas?
                <br/>Coloque o valor total do gasto (Com juros, se tiver), e
                no final coloque um * (Asterisco) para calcularmos para você!</p>

            <div class="card card-body border border-dark bg-secondary"
                 style="width: 90%;">
                <form action="../backEnd/InteracaoFront/novoDebito.php" method="POST"
                      class="form hstack gap-3">

                    <select class="form-select" name="bancoCorretora" required>

                        <option value="" selected>Banco | Corretora</option>
                        <?php include_once(__DIR__ . '/../loops/nomes_bancos_corretoras.php') ?>

                    </select>

                    <?php include_once(__DIR__ . '/../classificacao/tipos_gastos.php') ?>

                    <input type="date" class="container input-group-text"
                           name="dataCompraPagamento"
                           value="<?= date('Y-m-d') ?>" required>
                    <input type="text" class="container input-group-text" name="valor"
                           placeholder="Valor das Parcelas" required>
                    <input type="number" class="container input-group-text"
                           name="parcelas"
                           title="Quantidade de Parcelas" step="1" min="1" value="1"
                           required>

                    <input type="submit" class="container btn btn-dark" value="Debitar">

                </form>
            </div>
        </div>
    </div>
</div>